<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phó Bản & Đánh Boss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>⚔️ Phó Bản & Độ Kiếp</h1>
        <p>Thử thách bản thân để nhận thêm linh thạch và rèn luyện.</p>
        <hr style="border-color:#00ffcc; margin: 15px 0;">
        
        <div class="actions-panel">
            <button class="action-btn" onclick="danhBoss('Thuong')">☠️ Đánh Yêu Thú Thường</button>
            <button class="action-btn" onclick="danhBoss('Boss')">👹 Khiêu chiến Ác Ma Cấp Cao</button>
            <button class="action-btn" onclick="doKiep()">🌩️ Độ Kiếp (Mỗi 9 cấp)</button>
            <button class="action-btn" onclick="location.href='dashboard.php'">⬅️ Trở về</button>
        </div>
        <div class="log-panel">
            <h3>Chiến Báo</h3>
            <div id="logBox" class="log-box">Chưa có trận chiến nào...</div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
