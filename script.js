// By: xLemonVN 
// LH: 0904801291 Settup Website

// ==========================================
// 1. KHO DỮ LIỆU ESIGN (13 CHỨNG CHỈ)
// ==========================================
const esignData = [
    { name: "Ksign✅", info: "XL AXIATA, PT TBK", link: "https://api.khoindvn.io.vn/JnAsbd" },
    { name: "Esign", info: "BOC International (China) Limited", link: "https://api.khoindvn.io.vn/XHJQcD" },
    { name: "Esign", info: "National Oilwell Varco, Inc", link: "https://api.khoindvn.io.vn/l5zzBs" },
    { name: "Esign", info: "VIETNAM AIRLINES JSC", link: "https://api.khoindvn.io.vn/l0drnJ" },
    { name: "Esign", info: "PowerChina International Group Limited", link: "https://api.khoindvn.io.vn/HdZnCj" },
    { name: "Esign", info: "Qingdao Rural Commercail Bank Co.,Ltd", link: "https://api.khoindvn.io.vn/U7fGrl" },
    { name: "Esign", info: "Commission on Elections", link: "https://api.khoindvn.io.vn/PnrQnK" },
    { name: "Esign", info: "Luoyang Postal Administration", link: "https://api.khoindvn.io.vn/j7ugho" },
    { name: "Esign", info: "China National Heavy Duty Truck Group", link: "https://api.khoindvn.io.vn/bYA0i6" },
    { name: "Esign", info: "China Telecommunications Corpration", link: "https://api.khoindvn.io.vn/cTiFFB" },
    { name: "Esign", info: "CHIBA INSTITUTE OF TECHNOLOGY", link: "https://api.khoindvn.io.vn/TPaVIt" },
    { name: "Esign", info: "VIETCOMBANK JSC", link: "https://api.khoindvn.io.vn/4h9whC" },
    { name: "Esign", info: "GLOBAL TAKEOFF, INC", link: "https://api.khoindvn.io.vn/aKk6vi" }
];

// ==========================================
// 2. KHO DỮ LIỆU GAME (THÊM/SỬA LINK NHANH TẠI ĐÂY)
// ==========================================
const gameData = {
    'cfl': {
        title: "Crossfire Legends",
        items: [
            { name: "Crossfire Raven ", info: "Bản crack no key", link: "https://tumadam.io.vn/autoup/cfmravencrackios" },
            { name: "Crossfire SKY", info: "esp,aim , antiban", link: "https://drive.google.com/file/d/1mvMDZh4w3oPfddrcOW08IxLVvhaWF-x9/view?usp=drivesdk" },
            { name: "Crossfire External ", info: "Chỉ hỗ trợ ios dưới 17.0", link: "https://drive.google.com/file/d/1X7SBpaMu7ubRrZeeEX5QjK_gnTwJN9AR/view?usp=drivesdk" },
        ]
    },
    'lq': {
        title: "Liên Quân Mobile",
        items: [
            { name: "Liên Quân SKYCHEAT", info: "máp sáng, mod skin, hiện rank", link: "https://drive.google.com/file/d/1zsJ9WHw5iTkvOkAoDWakOKycoh5-wM6R/view?usp=drivesdk" },
        ]
    },
    'pu': {
        title: "PUBG MOBILE",
        items: [
            { name: "PUBG VIP", info: "Auto aim, esp ,mod skin", link: "https://drive.google.com/file/d/1ZQzn_XcxHdJlWdVBLBl1eoPDtQy4eolg/view?usp=drivesdk" },
        ]
    },
    'ff': {
        title: "Free Fire External",
        items: [
            { name: "Free Fire ", info: "Chỉ hỗ trợ ios dưới 17.0", link: "https://drive.google.com/file/d/1uu9Scjb8RN4B16d9VUdjxjmPoAuy4xCK/view?usp=drivesdk" },
        ]
    },
    'esign': {
        title: "ESign Bypass Revoke",
        items: esignData 
    }
};

// ==========================================
// 3. HỆ THỐNG XỬ LÝ NHẠC NGẪU NHIÊN
// ==========================================
const myPlayList = [
    "Oggy.m4a",
    "bai1.m4a",
    "bai2.m4a",
    "bai3.m4a",
    "bai4.m4a",
    "bai6.m4a"
];

// ==========================================
// 4. HỆ THỐNG XỬ LÝ (KHÔNG CẦN THAY ĐỔI)
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    const splash = document.getElementById('splash-screen');
    const mainContent = document.getElementById('main-content');

    if (!splash) {
        if (mainContent) {
            mainContent.style.display = 'block';
            mainContent.style.opacity = '1';
            mainContent.classList.add('show-content');
        }
        document.body.style.overflowY = 'auto';
    } else {
        document.body.style.overflow = 'hidden';
    }

    setInterval(createPetal, 500); 
});

// Hàm xử lý khi nhấn vào Splash Screen (Đã cập nhật đổi bài ngẫu nhiên)
function startWeb() {
    const audio = document.getElementById('myAudio');
    const splash = document.getElementById('splash-screen');
    const mainContent = document.getElementById('main-content');

    if (audio) {
        // --- LOGIC ĐỔI BÀI NGẪU NHIÊN ---
        const randomSong = myPlayList[Math.floor(Math.random() * myPlayList.length)];
        audio.src = randomSong;
        audio.load();
        // -------------------------------
        
        audio.play().catch(() => console.log("Cần chạm màn hình để phát nhạc"));
    }

    if (splash) {
        splash.style.opacity = '0';
        splash.style.transition = 'opacity 0.8s ease';
        setTimeout(() => {
            splash.style.display = 'none';
            document.body.style.overflowY = 'auto'; 
        }, 800);
    }

    if (mainContent) {
        mainContent.style.display = 'block';
        setTimeout(() => {
            mainContent.classList.add('show-content');
            mainContent.style.opacity = '1';
        }, 10);
    }
}

// Hàm mở Bảng chọn (Modal)
function openHackModal(key) {
    const modal = document.getElementById('hack-modal');
    const title = document.getElementById('modal-game-name');
    const modalBody = document.getElementById('modal-body-list');
    const data = gameData[key];

    if (!modal || !title || !modalBody || !data) return;

    title.innerText = data.title;
    let htmlContent = `<div class="alert-info">Vui lòng chọn bản phù hợp</div><div class="hack-list">`;
    
    data.items.forEach(item => {
        htmlContent += `
            <div class="hack-item">
                <div class="hack-info">
                    <span class="hack-name">${item.name}</span>
                    <span class="hack-version">${item.info}</span>
                </div>
                <button class="btn-download" onclick="window.open('${item.link}', '_blank')">INSTALL</button>
            </div>`;
    });

    htmlContent += `</div>`;
    modalBody.innerHTML = htmlContent;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeHackModal() {
    const modal = document.getElementById('hack-modal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflowY = 'auto';
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('hack-modal');
    if (event.target === modal) {
        closeHackModal();
    }
};

function createPetal() {
    const petal = document.createElement('div');
    petal.className = 'cherry-blossom'; 
    const randomLeft = Math.random() * 100;
    petal.style.left = randomLeft + 'vw';
    const size = (Math.random() * 8 + 8) + 'px';
    petal.style.width = size;
    petal.style.height = size;
    const colors = ['#ffb7c5', '#ffc0cb', '#ffd1dc', '#ff91a4'];
    petal.style.background = colors[Math.floor(Math.random() * colors.length)];
    const randomRotation = Math.random() * 360;
    petal.style.transform = `rotate(${randomRotation}deg)`;
    petal.style.opacity = Math.random() * 0.5 + 0.5;
    const fallDuration = (Math.random() * 5 + 8) + 's';
    const shakeDuration = (Math.random() * 2 + 2) + 's';
    petal.style.animationDuration = `${fallDuration}, ${shakeDuration}`;
    document.body.appendChild(petal);
    setTimeout(() => { petal.remove(); }, 12000);
}
