<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$stmt = $conn->query(
    "SELECT * FROM products ORDER BY id DESC"
);
$products = $stmt->fetchAll();
?>
<h2>Manage Products</h2>
<a href="add_product.php">Add New Product</a>
<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Action</th>
</tr>
<?php foreach($products as $product): ?>
<tr>
<td><?php echo $product['id']; ?></td>
<td><?php echo clean($product['name']); ?></td>
<td><?php echo $product['price']; ?></td>
<td><?php echo $product['stock']; ?></td>
<td>
<a href="edit_product.php?id=<?php echo $product['id']; ?>">
Edit
</a>
<form method="POST" action="delete_product.php"
style="display:inline">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="hidden"
name="id"
value="<?php echo $product['id']; ?>">
<button type="submit">Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
