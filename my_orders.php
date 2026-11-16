<?php
require_once 'config.php';
require_once 'includes/functions.php';
requireLogin();
include 'includes/header.php';
$stmt = $conn->prepare(
    "SELECT * FROM orders
     WHERE user_id = ?
     ORDER BY created_at DESC"
);
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();
?>
<h2>My Orders</h2>
<table class="table">
<tr>
<th>Order ID</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
</tr>
<?php foreach($orders as $order): ?>
<tr>
<td>#<?php echo $order['id']; ?></td>
<td>Rs. <?php echo $order['total_amount']; ?></td>
<td><?php echo clean($order['payment_method']); ?></td>
<td><?php echo clean($order['status']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php include 'includes/footer.php'; ?>
