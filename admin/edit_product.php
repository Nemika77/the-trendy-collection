<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $conn->prepare(
    "SELECT * FROM products WHERE id = ?"
);
$stmt->execute([$id]);
$product = $stmt->fetch();
if(!$product) {
    exit("Product not found.");
}
if(isset($_POST['update'])) {
    verifyCsrf();
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $image = trim($_POST['image']);
    $stmt = $conn->prepare(
        "UPDATE products SET
        name=?, category=?, description=?,
        price=?, stock=?, image_url=?
        WHERE id=?"
    );
    $stmt->execute([
        $name,
        $category,
        $description,
        $price,
        $stock,
        $image,
        $id
    ]);
    header("Location: manage_products.php");
    exit();
}
?>
<h2>Edit Product</h2>
<form method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input name="name"
value="<?php echo clean($product['name']); ?>"
required>
<input name="category"
value="<?php echo clean($product['category']); ?>"
required>
<textarea name="description"><?php
echo clean($product['description']);
?></textarea>
<input name="price"
type="number"
step="0.01"
value="<?php echo $product['price']; ?>"
required>
<input name="stock"
type="number"
value="<?php echo $product['stock']; ?>"
required>
<input name="image"
type="url"
value="<?php echo clean($product['image_url']); ?>"
required>
<button name="update">Update Product</button>
</form>
