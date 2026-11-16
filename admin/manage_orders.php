<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$stmt = $conn->query(
    "SELECT orders.*, users.name
     FROM orders
     JOIN users ON orders.user_id = users.id
     ORDER BY orders.id DESC"
);
$orders = $stmt->fetchAll();
?>
<h2>Manage Orders</h2>
<table border="1">
<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php foreach($orders as $order): ?>
<tr>
<td><?php echo $order['id']; ?></td>
<td><?php echo clean($order['name']); ?></td>
<td>Rs. <?php echo $order['total_amount']; ?></td>
<td><?php echo clean($order['payment_method']); ?></td>
<td><?php echo clean($order['status']); ?></td>
<td>
<form method="POST" action="update_order.php">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="hidden"
name="id"
value="<?php echo $order['id']; ?>">
<select name="status">
<option>Pending</option>
<option>Confirmed</option>
<option>Shipped</option>
<option>Delivered</option>
<option>Cancelled</option>
</select>
<button>Update</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
