<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: manage_products.php");
    exit();
}
verifyCsrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$stmt = $conn->prepare(
    "UPDATE products SET is_active = 0 WHERE id = ?"
);
$stmt->execute([$id]);
header("Location: manage_products.php");
exit();
?>
