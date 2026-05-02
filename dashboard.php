<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tu Tiên Giới - Bảng Điều Khiển</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>🔮 Đô Thị Tu Tiên Giới</h1>
            <p>Chào mừng đạo hữu: <b><?=htmlspecialchars($user['username'])?></b> | Cảnh giới: <span id="tuvi"><?=$user['tuvi']?></span></p>
        </header>

        <section class="stats-panel">
            <div class="stat-box">Linh Khí <span id="linh-khi"><?=$user['linh_khi']?> / <span id="linh-khi-can"><?=$user['linh_khi_can']?></span></span></div>
            <div class="stat-box">Linh Thạch <span id="linh-thach"><?=$user['linh_thach']?></span></div>
            <div class="stat-box">Thể Lực <span id="the-luc"><?=$user['the_luc']?>/100</span></div>
        </section>

        <section class="actions-panel">
            <button class="action-btn" onclick="tuLuyen()">🧘 Bế Quan Tu Luyện</button>
            <button class="action-btn" onclick="batDauAuto()">⏱️ Treo máy (Auto Linh Khí)</button>
            <button class="action-btn" onclick="dotPha()">⚡ Đột Phá Cảnh Giới</button>
            <button class="action-btn" onclick="location.href='phoban.php'">⚔️ Phó bản & Boss</button>
            <button class="action-btn" onclick="location.href='nhiemvu.php'">📜 Làm Nhiệm vụ</button>
            <button class="action-btn" style="background:#ff3333;" onclick="location.href='index.php?logout=1'">🚪 Đăng xuất</button>
        </section>

        <div class="log-panel">
            <h3>Nhật Ký Tu Tiên</h3>
            <div id="logBox" class="log-box">Chào mừng đạo hữu bước vào tiên đồ...</div>
        </div>
    </div>

    <script>
        let userId = <?=$user['id']?>;
        let linhKhi = <?=$user['linh_khi']?>;
        let linhKhiCan = <?=$user['linh_khi_can']?>;
        let capDo = <?=$user['cap_do']?>;
        let linhThach = <?=$user['linh_thach']?>;
        let isAuto = false;
        let autoInterval;
    </script>
    <script src="script.js"></script>
</body>
</html>
