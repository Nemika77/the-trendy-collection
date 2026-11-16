<?php
require_once 'config.php';
require_once 'includes/functions.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit();
}
verifyCsrf();
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$cart = $_SESSION['cart'] ?? [];
if (empty($cart) || $address === '' || $phone === '') {
    exit("Please provide valid order details.");
}
try {
    $conn->beginTransaction();
    $total = 0;
    $products = [];
    foreach ($cart as $id => $quantity) {
        $stmt = $conn->prepare(
            "SELECT * FROM products
             WHERE id = ? AND is_active = 1
             FOR UPDATE"
        );
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        if (!$product ||
            $quantity < 1 ||
            $quantity > $product['stock']) {
            throw new Exception("Product stock unavailable.");
        }
        $total += $product['price'] * $quantity;
        $products[] = [
            'product' => $product,
            'quantity' => $quantity
        ];
    }
    $stmt = $conn->prepare(
        "INSERT INTO orders
        (user_id,total_amount,delivery_address,phone,payment_method)
        VALUES(?,?,?,?,?)"
    );
    $stmt->execute([
        $_SESSION['user_id'],
        $total,
        $address,
        $phone,
        'Cash on Delivery'
    ]);
    $order_id = $conn->lastInsertId();
    foreach ($products as $item) {
        $p = $item['product'];
        $quantity = $item['quantity'];
        $stmt = $conn->prepare(
            "INSERT INTO order_items
            (order_id,product_id,quantity,unit_price)
            VALUES(?,?,?,?)"
        );
        $stmt->execute([
            $order_id,
            $p['id'],
            $quantity,
            $p['price']
        ]);
        $stmt = $conn->prepare(
            "UPDATE products
             SET stock = stock - ?
             WHERE id = ?"
        );
        $stmt->execute([
            $quantity,
            $p['id']
        ]);
    }
    $conn->commit();
    unset($_SESSION['cart']);
    echo "Your order has been placed successfully!";
} catch (Throwable $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    exit("Unable to place order. Please try again.");
}
?>
