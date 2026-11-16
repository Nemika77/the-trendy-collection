<?php
require_once '../config.php';
require_once '../includes/functions.php';
$error = "";
if(isset($_POST['login'])) {
    verifyCsrf();
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $conn->prepare(
        "SELECT * FROM users
         WHERE email = ? AND role = 'admin'"
    );
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    if (
        $admin &&
        password_verify(
            $password,
            $admin['password_hash']
        )
    ) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['role'] = 'admin';
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<h2>Admin Login</h2>
<p><?php echo clean($error); ?></p>
<form method="POST">
<input type="hidden"
name="csrf_token"
value="<?php echo clean(csrfToken()); ?>">
<input type="email"
name="email"
placeholder="Admin Email"
required>
<input type="password"
name="password"
placeholder="Password"
required>
<button name="login">Login</button>
</form>
