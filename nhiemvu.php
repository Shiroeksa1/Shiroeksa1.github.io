<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ Tiên Giới</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📜 Bảng Nhiệm Vụ</h1>
        <div class="actions-panel">
            <button class="action-btn" onclick="nhanNhiemVu(1)">Thu thập linh thảo (Nhận Linh Khí)</button>
            <button class="action-btn" onclick="nhanNhiemVu(2)">Hộ tống thương hội (Nhận Linh Thạch)</button>
            <button class="action-btn" onclick="location.href='dashboard.php'">⬅️ Trở về</button>
        </div>
        <div class="log-panel">
            <h3>Thông Báo</h3>
            <div id="logBox" class="log-box">Chọn một nhiệm vụ để thực hiện...</div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
