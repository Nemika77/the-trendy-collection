<?php
include 'includes/header.php';
$message = "";
if(isset($_POST['register'])) {
    verifyCsrf();
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );
    $stmt = $conn->prepare(
        "INSERT INTO users
        (name,email,password_hash)
        VALUES(?,?,?)"
    );
    try {
        $stmt->execute([
            $name,
            $email,
            $password
        ]);
        $message = "Registration successful!";
    } catch(PDOException $e) {
        $message = "Email already exists.";
    }
}
?>
<h2>Customer Registration</h2>
<p><?php echo clean($message); ?></p>
<form method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="text"
name="name"
placeholder="Full Name"
required
class="form-control mb-3">
<input type="email"
name="email"
placeholder="Email Address"
required
class="form-control mb-3">
<input type="password"
name="password"
placeholder="Password"
minlength="8"
required
class="form-control mb-3">
<button type="submit"
name="register"
class="btn btn-dark">
Register
</button>
</form>
<?php include 'includes/footer.php'; 
?>
