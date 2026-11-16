<?php
require_once 'config.php';
require_once 'includes/functions.php';
requireLogin();
include 'includes/header.php';
?>
<h2>Checkout</h2>
<form action="place_order.php" method="POST">
<input type="hidden" name="csrf_token" value="<?php echo clean(csrfToken()); ?>">
<label>Delivery Address</label>
<textarea name="address" class="form-control mb-3" required></textarea>
<label>Phone Number</label>
<input type="tel" name="phone" class="form-control mb-3" required>
<p>Payment Method: Cash on Delivery</p>
<button type="submit" class="btn btn-dark">Place Order</button>
</form>
<?php include 'includes/footer.php'; ?>
