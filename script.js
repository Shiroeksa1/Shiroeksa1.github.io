// Hệ thống 25 cảnh giới tu tiên
const levelTitles = [
    "Luyện Thể", "Luyện Khí", "Trúc Cơ", "Kết Đan", "Nguyên Anh", 
    "Hóa thần", "Luyện Hư", "Động Hư", "Hợp thể", "Đại Thừa", 
    "Độ Kiếp", "Phi Thăng", "Nhân Tiên", "Địa Tiên", "Tiên Thiên", 
    "Chân Tiên", "Thái Ất Kim Tiên", "Đại La Tiên", "Đại La Kim Tiên", 
    "Chuẩn Thánh", "Thánh Nhân", "Hỗn Nguyên Đại La Kim Tiên", 
    "Đạo Tổ", "Hồng Mông Thánh Nhân", "Hỗn Nguyên Hồng Mông Đạo Tổ"
];

let currentTitleIndex = 0; // Bắt đầu ở cảnh giới 0 (Luyện Thể)

function log(text) {
    let logBox = document.getElementById('logBox');
    logBox.innerHTML = `> ${text} <br>` + logBox.innerHTML;
}

function tuLuyen() {
    fetch('action_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'tuluyen'})
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('linh-khi').textContent = data.linh_khi;
            document.getElementById('linh-khi-can').textContent = data.linh_khi_can;
            log(data.message);
        }
    });
}

function dotPha() {
    fetch('action_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'dotpha'})
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            document.getElementById('linh-khi').textContent = data.linh_khi;
            document.getElementById('linh-khi-can').textContent = data.linh_khi_can;
            document.getElementById('tuvi').textContent = data.tuvi;
            log(data.message);
        } else {
            log(data.message);
        }
    });
}

function nhanNhiemVu(type) {
    let actionType = (type === 1) ? 'nhiemvu_linhkhi' : 'nhiemvu_linhthach';
    fetch('action_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: actionType})
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.linh_khi) document.getElementById('linh-khi').textContent = data.linh_khi;
            if (data.linh_thach) document.getElementById('linh-thach').textContent = data.linh_thach;
            log(data.message);
        }
    });
}

function danhBoss(type) {
    fetch('action_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'danhboss', type: type})
    })
    .then(res => res.json())
    .then(data => {
        log(data.message);
        setTimeout(function() {
            location.reload();
        }, 1500);
    });
}

function doKiep() {
    fetch('action_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({action: 'dokiep'})
    })
    .then(res => res.json())
    .then(data => {
        log(data.message);
    });
}

function batDauAuto() {
    if (!window.isAuto) {
        window.isAuto = true;
        log("Hệ thống Treo máy (Auto) đã BẬT!");
        window.autoInterval = setInterval(function() {
            tuLuyen();
        }, 3000); // Lặp lại sau mỗi 3 giây
    } else {
        window.isAuto = false;
        clearInterval(window.autoInterval);
        log("Hệ thống Treo máy đã TẮT!");
    }
}
