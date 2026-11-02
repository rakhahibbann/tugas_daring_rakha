CREATE DATABASE IF NOT EXISTS database_siswa;
USE database_siswa;

CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO pengguna (nama, email, username, password)
VALUES ('Admin', 'admin@gmail.com', 'admin', 'admin123')
ON DUPLICATE KEY UPDATE username = username;
