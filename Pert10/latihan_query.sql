-- =====================================================
-- PEMROGRAMAN WEB 2 - PERTEMUAN 10 - BAB VII DATABASE
-- Latihan: 3 kelompok query (kelola database, satu tabel, JOIN)
-- Jalankan lewat phpMyAdmin > tab SQL
-- =====================================================

-- ========== 1. QUERY UNTUK MENGELOLA DATABASE ==========
CREATE DATABASE latihan_p10;
USE latihan_p10;

CREATE TABLE jurusan (
  kd_jurusan  INT NOT NULL AUTO_INCREMENT,
  nama_jurusan VARCHAR(30) NOT NULL,
  PRIMARY KEY (kd_jurusan)
);

CREATE TABLE mahasiswa (
  nim         VARCHAR(10) NOT NULL,
  nama        VARCHAR(30) NOT NULL,
  alamat      VARCHAR(50),
  kd_jurusan  INT,
  PRIMARY KEY (nim)
);

-- Memodifikasi tabel
ALTER TABLE mahasiswa ADD telepon VARCHAR(12);
ALTER TABLE mahasiswa MODIFY alamat VARCHAR(80);
ALTER TABLE mahasiswa DROP COLUMN telepon;

-- Menambah user, mengatur permission, menghapus user
CREATE USER 'user_p10'@'localhost' IDENTIFIED BY 'rahasia123';
GRANT SELECT, INSERT, UPDATE, DELETE ON latihan_p10.* TO 'user_p10'@'localhost';
FLUSH PRIVILEGES;
-- REVOKE INSERT, UPDATE, DELETE ON latihan_p10.* FROM 'user_p10'@'localhost';
-- DROP USER 'user_p10'@'localhost';

-- ========== 2. QUERY SATU TABEL ==========
-- INSERT
INSERT INTO jurusan (nama_jurusan) VALUES ('Teknik Informatika'), ('Sistem Informasi'), ('Teknik Elektro');

INSERT INTO mahasiswa (nim, nama, alamat, kd_jurusan) VALUES
('2021001', 'Anjar Prabowo',  'Pamulang', 1),
('2021002', 'Karina Suwandi', 'Ciputat',  1),
('2021003', 'Glenn Gandari',  'Serpong',  2),
('2021004', 'Budi Santoso',   'Bintaro',  NULL);

-- UPDATE
UPDATE mahasiswa SET alamat = 'Pondok Cabe' WHERE nim = '2021001';

-- SELECT
SELECT * FROM mahasiswa;
SELECT nim, nama FROM mahasiswa WHERE kd_jurusan = 1;

-- DELETE
DELETE FROM mahasiswa WHERE nim = '2021004';

-- ========== 3. QUERY LEBIH DARI SATU TABEL (JOIN) ==========
-- INNER JOIN: hanya data yang punya pasangan di kedua tabel
SELECT m.nim, m.nama, j.nama_jurusan
FROM mahasiswa m
INNER JOIN jurusan j ON m.kd_jurusan = j.kd_jurusan;

-- LEFT JOIN: semua mahasiswa, termasuk yang belum punya jurusan
SELECT m.nim, m.nama, j.nama_jurusan
FROM mahasiswa m
LEFT JOIN jurusan j ON m.kd_jurusan = j.kd_jurusan;

-- JOIN + agregat: jumlah mahasiswa per jurusan
SELECT j.nama_jurusan, COUNT(m.nim) AS jumlah_mhs
FROM jurusan j
LEFT JOIN mahasiswa m ON m.kd_jurusan = j.kd_jurusan
GROUP BY j.nama_jurusan;

-- ========== MENGHAPUS TABEL & DATABASE ==========
-- DROP TABLE mahasiswa;
-- DROP TABLE jurusan;
-- DROP DATABASE latihan_p10;
