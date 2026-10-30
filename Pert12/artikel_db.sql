-- PERTEMUAN 12 - Menambah, mengedit dan menghapus artikel
-- Database yang dipakai koneksi.php ($dbname = "artikel_db")

CREATE DATABASE IF NOT EXISTS artikel_db;
USE artikel_db;

CREATE TABLE IF NOT EXISTS artikel (
  id_artikel int NOT NULL AUTO_INCREMENT,
  judul varchar(100) NOT NULL,
  isi text,
  tanggal date,
  PRIMARY KEY (id_artikel)
);

INSERT INTO artikel (judul, isi, tanggal) VALUES
('Artikel Pertama', 'Ini isi artikel pertama.', '2026-01-01'),
('Artikel Kedua',   'Ini isi artikel kedua.',   '2026-01-02');
