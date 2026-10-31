-- PERTEMUAN 13 - Form input data mahasiswa
-- Database: db_mahasiswa (dipakai koneksi-tutor.php), tabel: mahasiswa

CREATE DATABASE IF NOT EXISTS db_mahasiswa;
USE db_mahasiswa;

CREATE TABLE IF NOT EXISTS mahasiswa (
  id_mahasiswa varchar(6) NOT NULL,
  nama varchar(30),
  jurusan varchar(30),
  alamat varchar(30),
  telepon varchar(12),
  PRIMARY KEY (id_mahasiswa)
);
