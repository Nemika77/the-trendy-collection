<?php
include 'includes/header.php';
$error = "";
if(isset($_POST['login'])) {
    verifyCsrf();
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email = ?"
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (
        $user &&
        password_verify(
            $password,
            $user['password_hash']
        )
    ) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        if($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<h2>Login</h2>
<p><?php echo clean($error); ?></p>
<form method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="email"
name="email"
placeholder="Email"
required
class="form-control mb-3">
<input type="password"
name="password"
placeholder="Password"
required
class="form-control mb-3">
<button type="submit"
name="login"
class="btn btn-dark">
Login
</button>
</form>
<?php include 'includes/footer.php'; 
?>
