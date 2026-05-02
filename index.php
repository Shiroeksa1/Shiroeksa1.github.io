<?php
session_start();
require_once 'config.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (isset($_POST['register'])) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password, linh_khi_can) VALUES (?, ?, 100)");
            $stmt->execute([$username, $hashed_password]);
            $message = "<p style='color:#00ffcc;'>Đăng ký thành công! Đăng nhập ngay.</p>";
        } catch (Exception $e) {
            $message = "<p style='color:#ff3333;'>Tài khoản đã tồn tại!</p>";
        }
    } elseif (isset($_POST['login'])) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "<p style='color:#ff3333;'>Sai tài khoản hoặc mật khẩu!</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tu Tiên Giới - Đăng Nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <div class="container" style="max-width: 400px; text-align: center;">
        <h2>🔮 Đăng Nhập / Đăng Ký</h2>
        <?=$message?>
        <form method="POST" style="display:flex; flex-direction:column; gap:15px; margin-top: 20px;">
            <input type="text" name="username" placeholder="Tên Đạo Hữu" required style="padding: 10px; border-radius: 5px; border: 1px solid #00ffcc; background: rgba(0,0,0,0.5); color: #fff;">
            <input type="password" name="password" placeholder="Mật Khẩu" required style="padding: 10px; border-radius: 5px; border: 1px solid #00ffcc; background: rgba(0,0,0,0.5); color: #fff;">
            <button type="submit" name="login" class="action-btn">Đăng Nhập</button>
            <button type="submit" name="register" class="action-btn" style="background: #003366;">Đăng Ký</button>
        </form>
    </div>
</body>
</html>
