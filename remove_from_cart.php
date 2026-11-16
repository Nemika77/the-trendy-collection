<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cart.php");
    exit();
}
require_once 'includes/functions.php';
verifyCsrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id && isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}
header("Location: cart.php");
exit();
?>
