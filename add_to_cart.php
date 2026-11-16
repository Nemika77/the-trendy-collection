<?php
require_once 'config.php';
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: products.php");
    exit();
}
verifyCsrf();
$id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

$stmt = $conn->prepare(
    "SELECT id, stock FROM products
     WHERE id = ? AND is_active = 1"
);
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product || !$quantity || $quantity < 1 ||
    $quantity > $product['stock']) {
    exit("Invalid product or quantity.");
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$_SESSION['cart'][$id] =
    min(
        $product['stock'],
        ($_SESSION['cart'][$id] ?? 0) + $quantity
    );
header("Location: cart.php");
exit();
?>
