<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$total_products = $conn->query(
    "SELECT COUNT(*) FROM products"
)->fetchColumn();
$total_users = $conn->query(
    "SELECT COUNT(*) FROM users
     WHERE role = 'customer'"
)->fetchColumn();
$total_orders = $conn->query(
    "SELECT COUNT(*) FROM orders"
)->fetchColumn();
$total_sales = $conn->query(
    "SELECT COALESCE(SUM(total_amount),0)
     FROM orders
     WHERE status IN ('Confirmed','Delivered')"
)->fetchColumn();
?>
<h1>Admin Dashboard</h1>
<h3>Total Products: <?php echo $total_products; ?></h3>
<h3>Total Customers: <?php echo $total_users; ?></h3>
<h3>Total Orders: <?php echo $total_orders; ?></h3>
<h3>Revenue: Rs. <?php echo $total_sales; ?></h3>
<a href="manage_products.php">Manage Products</a><br>
<a href="manage_users.php">Manage Users</a><br>
<a href="manage_orders.php">Manage Orders</a><br>
<a href="sales_report.php">Sales Report</a><br>
<a href="../logout.php">Logout</a>
