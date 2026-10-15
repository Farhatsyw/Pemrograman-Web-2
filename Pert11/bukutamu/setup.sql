-- Soal Latihan P11: Buku Tamu
CREATE DATABASE IF NOT EXISTS bukutamu_db;
USE bukutamu_db;

CREATE TABLE IF NOT EXISTS buku_tamu (
  id        INT NOT NULL AUTO_INCREMENT,
  nama      VARCHAR(50)  NOT NULL,
  email     VARCHAR(60)  NOT NULL,
  website   VARCHAR(60),
  komentar  TEXT         NOT NULL,
  tanggal   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
