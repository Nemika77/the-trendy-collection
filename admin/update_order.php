<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: manage_orders.php");
    exit();
}
verifyCsrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$status = $_POST['status'] ?? '';
$allowed = [
    'Pending',
    'Confirmed',
    'Shipped',
    'Delivered',
    'Cancelled'
];
if ($id && in_array($status, $allowed, true)) {
    $stmt = $conn->prepare(
        "UPDATE orders SET status = ? WHERE id = ?"
    );
    $stmt->execute([$status, $id]);
}
header("Location: manage_orders.php");
exit();
?>
