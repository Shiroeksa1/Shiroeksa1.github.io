<?php
session_start();
require_once 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Chưa đăng nhập.']);
    exit;
}

$userId = $_SESSION['user_id'];

// Lấy thông tin user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

// Mảng cảnh giới
$levelTitles = [
    "Luyện Thể", "Luyện Khí", "Trúc Cơ", "Kết Đan", "Nguyên Anh", 
    "Hóa Thần", "Luyện Hư", "Động Hư", "Hợp Thể", "Đại Thừa", 
    "Độ Kiếp", "Phi Thăng", "Nhân Tiên", "Địa Tiên", "Tiên Thiên", 
    "Chân Tiên", "Thái Ất Kim Tiên", "Đại La Tiên", "Đại La Kim Tiên", 
    "Chuẩn Thánh", "Thánh Nhân", "Hỗn Nguyên Đại La Kim Tiên", 
    "Đạo Tổ", "Hồng Mông Thánh Nhân", "Hỗn Nguyên Hồng Mông Đạo Tổ"
];

if ($action == 'tuluyen') {
    $tangLinhKhi = rand(15, 30);
    $newLinhKhi = $user['linh_khi'] + $tangLinhKhi;

    $stmt = $pdo->prepare("UPDATE users SET linh_khi = ? WHERE id = ?");
    $stmt->execute([$newLinhKhi, $userId]);

    echo json_encode([
        'status' => 'success', 
        'linh_khi' => $newLinhKhi,
        'linh_khi_can' => $user['linh_khi_can'],
        'message' => "Hấp thu thành công $tangLinhKhi điểm Linh Khí."
    ]);
    exit;
}

if ($action == 'dotpha') {
    if ($user['linh_khi'] >= $user['linh_khi_can']) {
        $newLinhKhi = $user['linh_khi'] - $user['linh_khi_can'];
        $newLinhKhiCan = $user['linh_khi_can'] * 2; // Yêu cầu tăng gấp đôi
        $newCapDo = $user['cap_do'] + 1;
        
        // Lấy tên cảnh giới trong mảng
        $index = ($newCapDo - 1) % count($levelTitles);
        $newTuVi = $levelTitles[$index] . " Cấp " . (floor(($newCapDo - 1) / count($levelTitles)) + 1);
        
        $stmt = $pdo->prepare("UPDATE users SET linh_khi = ?, linh_khi_can = ?, cap_do = ?, tuvi = ? WHERE id = ?");
        $stmt->execute([$newLinhKhi, $newLinhKhiCan, $newCapDo, $newTuVi, $userId]);
        
        echo json_encode([
            'status' => 'success',
            'linh_khi' => $newLinhKhi,
            'linh_khi_can' => $newLinhKhiCan,
            'tuvi' => $newTuVi,
            'message' => "Đột phá thành công! Cảnh giới đạt: $newTuVi"
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không đủ linh khí để đột phá.']);
    }
    exit;
}

if ($action == 'nhiemvu_linhkhi') {
    $reward = rand(20, 50);
    $newLinhKhi = $user['linh_khi'] + $reward;
    $stmt = $pdo->prepare("UPDATE users SET linh_khi = ? WHERE id = ?");
    $stmt->execute([$newLinhKhi, $userId]);
    echo json_encode(['status' => 'success', 'linh_khi' => $newLinhKhi, 'message' => "Hoàn thành nhiệm vụ nhận thêm $reward điểm Linh Khí!"]);
    exit;
}

if ($action == 'nhiemvu_linhthach') {
    $reward = rand(10, 30);
    $newLinhThach = $user['linh_thach'] + $reward;
    $stmt = $pdo->prepare("UPDATE users SET linh_thach = ? WHERE id = ?");
    $stmt->execute([$newLinhThach, $userId]);
    echo json_encode(['status' => 'success', 'linh_thach' => $newLinhThach, 'message' => "Hộ tống thành công, nhận được $reward Linh Thạch!"]);
    exit;
}

if ($action == 'danhboss') {
    $type = $data['type'];
    if ($type == 'Boss') {
        $chance = rand(1, 100);
        if ($chance > 40) {
            $reward = rand(50, 100);
            $newLinhThach = $user['linh_thach'] + $reward;
            $stmt = $pdo->prepare("UPDATE users SET linh_thach = ? WHERE id = ?");
            $stmt->execute([$newLinhThach, $userId]);
            echo json_encode(['status' => 'success', 'message' => "Diệt thành công Ác Ma, nhận được $reward Linh Thạch."]);
        } else {
            echo json_encode(['status' => 'fail', 'message' => "Thất bại, ác ma quá mạnh!"]);
        }
    } else {
        $reward = rand(10, 30);
        $newLinhThach = $user['linh_thach'] + $reward;
        $stmt = $pdo->prepare("UPDATE users SET linh_thach = ? WHERE id = ?");
        $stmt->execute([$newLinhThach, $userId]);
        echo json_encode(['status' => 'success', 'message' => "Diệt yêu thú thường, nhận được $reward Linh Thạch."]);
    }
    exit;
}

if ($action == 'dokiep') {
    if ($user['cap_do'] % 9 == 0) {
        $chance = rand(1, 100);
        if ($chance > 30) {
            echo json_encode(['status' => 'success', 'message' => "Vượt qua thiên kiếp an toàn. Đã sẵn sàng đột phá!"]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET linh_khi = GREATEST(0, linh_khi - 50) WHERE id = ?");
            $stmt->execute([$userId]);
            echo json_encode(['status' => 'fail', 'message' => "Thiên kiếp quá mạnh, linh khí bị hao hụt, hãy chuẩn bị lại!"]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "Chưa đến lúc độ kiếp, hãy đạt cấp độ chia hết cho 9!"]);
    }
    exit;
}
?>
