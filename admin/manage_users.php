<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$stmt = $conn->query(
    "SELECT id,name,email,created_at
     FROM users
     WHERE role='customer'
     ORDER BY id DESC"
);
$users = $stmt->fetchAll();
?>
<h2>Manage Customers</h2>
<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Registered Date</th>
</tr>
<?php foreach($users as $user): ?>
<tr>
<td><?php echo $user['id']; ?></td>
<td><?php echo clean($user['name']); ?></td>
<td><?php echo clean($user['email']); ?></td>
<td><?php echo clean($user['created_at']); ?></td>
</tr>
<?php endforeach; ?>
</table>
