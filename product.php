<?php
include 'includes/header.php';
$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);
$stmt = $conn->prepare(
    "SELECT * FROM products
     WHERE id = ? AND is_active = 1"
);
$stmt->execute([$id]);
$product = $stmt->fetch();
if(!$product) {
    exit("Product not found.");
}
?>
<div class="row">
<div class="col-md-6">
<img src="<?php echo clean($product['image_url']); ?>"
class="img-fluid">
</div>
<div class="col-md-6">
<h2><?php echo clean($product['name']); ?></h2>
<p><?php echo clean($product['description']); ?></p>
<h4>Rs. <?php echo $product['price']; ?></h4>
<p>Category: <?php echo clean($product['category']); ?></p>
<p>Stock: <?php echo $product['stock']; ?></p>
<form action="add_to_cart.php" method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="hidden"
name="product_id"
value="<?php echo $product['id']; ?>">
<input type="number"
name="quantity"
value="1"
min="1"
max="<?php echo (int)$product['stock']; ?>"
required>
<button class="btn btn-dark"
type="submit">
Add to Cart
</button>
</form>
</div>
</div>
<?php include 'includes/footer.php'; ?>
