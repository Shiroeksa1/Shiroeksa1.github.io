CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tuvi VARCHAR(50) DEFAULT 'Luyện Khí Tầng 1',
    cap_do INT DEFAULT 1,
    linh_khi INT DEFAULT 0,
    linh_khi_can INT DEFAULT 100,
    linh_thach INT DEFAULT 100,
    the_luc INT DEFAULT 100,
    inventory TEXT DEFAULT '[]',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
