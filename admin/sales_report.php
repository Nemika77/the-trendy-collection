<?php
require_once '../config.php';
require_once '../includes/functions.php';
requireAdmin();
$stmt = $conn->query(
    "SELECT
        COUNT(*) AS total_orders,
        COALESCE(SUM(total_amount),0) AS revenue
     FROM orders
     WHERE status IN ('Confirmed','Delivered')"
);
$report = $stmt->fetch();
?>
<h2>Sales Report</h2>
<h4>
Total Orders: <?php echo $report['total_orders']; ?>
</h4>
<h4>
Total Revenue: Rs.
<?php echo number_format($report['revenue'], 2); ?>
</h4>
