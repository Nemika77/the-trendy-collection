<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$message = "";
if(isset($_POST['add'])) {
    verifyCsrf();
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $image = trim($_POST['image']);
    $stmt = $conn->prepare(
        "INSERT INTO products
        (name,category,description,price,stock,image_url)
        VALUES(?,?,?,?,?,?)"
    );
    $stmt->execute([
        $name,
        $category,
        $description,
        $price,
        $stock,
        $image
    ]);
    $message = "Product added successfully.";
}
?>
<h2>Add New Product</h2>
<p><?php echo clean($message); ?></p>
<form method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="text"
name="name"
placeholder="Product Name"
required>
<input type="text"
name="category"
placeholder="Category"
required>
<textarea name="description"
placeholder="Description"></textarea>
<input type="number"
name="price"
placeholder="Price"
min="0.01"
step="0.01"
required>
<input type="number"
name="stock"
placeholder="Stock"
min="0"
required>
<input type="url"
name="image"
placeholder="Image URL"
required>
<button name="add">Add Product</button>
</form>
