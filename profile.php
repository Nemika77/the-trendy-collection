<?php
require_once 'config.php';
require_once 'includes/functions.php';
requireLogin();
$stmt = $conn->prepare(
    "SELECT name,email FROM users WHERE id = ?"
);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
include 'includes/header.php';
?>
<h2>My Profile</h2>
<p>
Name: <?php echo clean($user['name']); ?>
</p>
<p>
Email: <?php echo clean($user['email']); ?>
</p>
<?php include 'includes/footer.php'; ?>
