<?php
include 'includes/header.php';

$stmt = $conn->query(
    "SELECT * FROM products
     WHERE is_active = 1
     ORDER BY id DESC
     LIMIT 8"
);

$products = $stmt->fetchAll();
?>

<section class="text-center p-5">

<h1>Welcome to The Trendy Collection</h1>

<p>
Discover the beauty of traditional Nepali clothing.
</p>

<a href="products.php"
class="btn btn-dark">

Explore Collection

</a>

</section>

<div class="row">

<?php foreach($products as $product): ?>

<div class="col-md-3 mb-4">

<div class="card">

<img src="<?php echo clean($product['image_url']); ?>"
class="card-img-top"
alt="<?php echo clean($product['name']); ?>">

<div class="card-body">

<h5>
<?php echo clean($product['name']); ?>
</h5>

<p>
Rs. <?php echo number_format($product['price'], 2); ?>
</p>

<a href="product.php?id=<?php echo $product['id']; ?>"
class="btn btn-dark">

View Product

</a>

</div>
</div>
</div>

<?php endforeach; ?>

</div>

<?php include 'includes/footer.php'; ?>
