<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>The Trendy Collection</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

<div class="container">

<a class="navbar-brand"
href="index.php">

The Trendy Collection

</a>

<div class="navbar-nav ms-auto">

<a class="nav-link" href="index.php">Home</a>

<a class="nav-link" href="products.php">Products</a>

<a class="nav-link" href="cart.php">Cart</a>

<?php if (isLoggedIn()): ?>

<a class="nav-link" href="my_orders.php">
My Orders
</a>

<a class="nav-link" href="logout.php">
Logout
</a>

<?php else: ?>

<a class="nav-link" href="login.php">
Login
</a>

<a class="nav-link" href="register.php">
Register
</a>

<?php endif; ?>

</div>

</div>

</nav>

<div class="container mt-4">
