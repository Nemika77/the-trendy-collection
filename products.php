<?php
include 'includes/header.php';
$stmt = $conn->query(
    "SELECT * FROM products
     WHERE is_active = 1"
);
$products = $stmt->fetchAll();
?>
<h2>Our Collection</h2>
<div class="row">
<?php foreach($products as $product): ?>
<div class="col-md-3 mb-4">
<div class="card">
<img src="<?php echo clean($product['image_url']); ?>"
class="card-img-top">
<div class="card-body">
<h5><?php echo clean($product['name']); ?></h5>
<p>Rs. <?php echo $product['price']; ?></p>
<a href="product.php?id=<?php echo $product['id']; ?>"
class="btn btn-dark">
View Details
</a>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>
