-- Praktikum 9: PHP Modular (lanjutan database Praktikum 8)
-- Import lewat phpMyAdmin (tab SQL / Import). Aman dijalankan ulang.

CREATE DATABASE IF NOT EXISTS latihan1;
USE latihan1;

CREATE TABLE IF NOT EXISTS data_barang (
    id_barang int(10) auto_increment PRIMARY KEY,
    kategori varchar(30),
    nama varchar(50),
    gambar varchar(100),
    harga_beli decimal(10,0),
    harga_jual decimal(10,0),
    stok int(4)
);

-- Data awal: hanya dimasukkan kalau tabel masih kosong
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
SELECT * FROM (
    SELECT 'Elektronik' AS kategori, 'HP Samsung Android' AS nama, 'hp_samsung.jpg' AS gambar, 2000000 AS harga_beli, 2400000 AS harga_jual, 5 AS stok
    UNION ALL SELECT 'Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5
    UNION ALL SELECT 'Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5
) AS awal
WHERE NOT EXISTS (SELECT 1 FROM data_barang);

-- Tabel pengguna untuk fitur login (Tantangan Mandiri 3)
CREATE TABLE IF NOT EXISTS users (
    id_user int(10) auto_increment PRIMARY KEY,
    username varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    nama varchar(100) NOT NULL
);

-- Akun awal -> username: admin | password: admin123 (disimpan sebagai hash bcrypt, bukan teks asli)
INSERT IGNORE INTO users (username, password, nama)
VALUES ('admin', '$2y$10$89NL9f9crJCPF0jtd2yJpeaBFw6QY.y9pkzqN/lAQwvKeOivx1zN.', 'Administrator');
