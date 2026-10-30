-- PERTEMUAN 12 - Latih 1 (UPDATE) dan Latih 2 (DELETE)
-- Database & tabel sama dengan Pert11 (lat_dbase / tbl_mhs).
-- Import lewat phpMyAdmin (tab Import) atau: mysql -u root < lat_dbase.sql
-- Catatan: tabel dikosongkan lalu diisi ulang supaya latihan bisa diulang dari awal.

CREATE DATABASE IF NOT EXISTS lat_dbase;
USE lat_dbase;

CREATE TABLE IF NOT EXISTS tbl_mhs (
  mhsID int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(mhsID),
  FirstName varchar(15),
  LastName varchar(15),
  Age int
);

TRUNCATE TABLE tbl_mhs;

INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES
('Karina', 'Suwandi', 30),  -- dipakai Latih 1 (UPDATE Age jadi 36)
('Anjar',  'Prabowo', 25),  -- dipakai Latih 2 (DELETE LastName='Prabowo')
('Budi',   'Santoso', 21),
('Siti',   'Rahma',   22);
