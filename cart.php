<?php
include 'includes/header.php';
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<h2>Shopping Cart</h2>
<?php
if(empty($cart)) {
    echo "<p>Your cart is empty.</p>";
} else {
    foreach($cart as $id => $quantity) {
        $stmt = $conn->prepare(
            "SELECT * FROM products
             WHERE id = ? AND is_active = 1"
        );
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        if (!$product) {
            continue;
        }
        $quantity = min(
            (int)$quantity,
            (int)$product['stock']
        );
        $subtotal = $product['price'] * $quantity;
        $total += $subtotal;
?>
<div class="card p-3 mb-3">
<h5><?php echo clean($product['name']); ?></h5>
<p>Price: Rs. <?php echo $product['price']; ?></p>
<p>Quantity: <?php echo $quantity; ?></p>
<p>Subtotal: Rs. <?php echo $subtotal; ?></p>
<a href="remove_from_cart.php?id=<?php echo $id; ?>">
Remove
</a>
</div>
<?php
    }
}
?>
<h3>Total: Rs. <?php echo number_format($total, 2); ?></h3>
<a href="checkout.php" class="btn btn-dark">
Checkout
</a>
<?php include 'includes/footer.php'; ?>
