<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html><html><head>
<meta charset="utf-8"><title>Login - RK Marriage Hall</title>
<style>
body{margin:0;font-family:Arial;background:linear-gradient(135deg,#f3e8ff,#fce1ff);display:flex;align-items:center;justify-content:center;height:100vh}
.login-box{background:#fff;padding:26px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.12);width:340px;text-align:center}
.login-box h2{margin:0 0 12px}
.login-box input{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:8px}
.login-box button{width:100%;padding:12px;border:none;border-radius:8px;background:#000;color:#fff;font-weight:bold;cursor:pointer}
</style></head><body>
<div class="login-box">
<h2>Rk halls</h2>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</div></body></html>