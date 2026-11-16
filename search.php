<?php
include 'includes/header.php';
$search = trim($_GET['search'] ?? '');
$stmt = $conn->prepare(
    "SELECT * FROM products
     WHERE is_active = 1
     AND (name LIKE ? OR category LIKE ?)"
);
$stmt->execute([
    "%$search%",
    "%$search%"
]);
$products = $stmt->fetchAll();
?>
<h2>Search Results</h2>
<?php foreach($products as $product): ?>
<div class="card mb-3 p-3">
<h5><?php echo clean($product['name']); ?></h5>
<p>Rs. <?php echo $product['price']; ?></p>
<a href="product.php?id=<?php echo $product['id']; ?>">
View Product
</a>
</div>
<?php endforeach; ?>
<?php include 'includes/footer.php'; ?>
