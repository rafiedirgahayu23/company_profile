-- =========================================================
-- Database: db_companyprofile
-- Deskripsi: Database untuk Website Company Profile Dinamis
--            PT Digital Solusi Nusantara
-- =========================================================

CREATE DATABASE IF NOT EXISTS db_companyprofile
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE db_companyprofile;

-- ---------------------------------------------------------
-- Tabel: admin
-- Menyimpan akun administrator untuk login ke halaman CMS
-- ---------------------------------------------------------
CREATE TABLE admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL, -- disimpan dalam bentuk hash (password_hash)
  nama_lengkap VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Tabel: profil
-- Berisi data statis perusahaan (Sejarah, Visi, Misi, Nilai)
-- Tabel ini hanya diisi 1 baris data (single row config)
-- ---------------------------------------------------------
CREATE TABLE profil (
  id_profil INT AUTO_INCREMENT PRIMARY KEY,
  sejarah TEXT,
  visi TEXT,
  misi TEXT,
  nilai_perusahaan TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Tabel: produk
-- Daftar layanan / produk perusahaan (dinamis, CRUD penuh)
-- ---------------------------------------------------------
CREATE TABLE produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY,
  nama_layanan VARCHAR(150) NOT NULL,
  deskripsi TEXT,
  gambar VARCHAR(255), -- path relatif ke assets/img
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Tabel: artikel
-- Daftar artikel / berita perusahaan (dinamis, CRUD penuh)
-- ---------------------------------------------------------
CREATE TABLE artikel (
  id_artikel INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200) NOT NULL,
  thumbnail VARCHAR(255),
  tanggal DATE NOT NULL,
  ringkasan VARCHAR(300),
  isi_artikel TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Tabel: galeri
-- Dokumentasi foto kegiatan perusahaan (dinamis, CRUD penuh)
-- ---------------------------------------------------------
CREATE TABLE galeri (
  id_galeri INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  foto VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- DATA AWAL (SEED DATA)
-- Supaya website tidak kosong saat pertama kali dijalankan
-- =========================================================

-- Akun admin default -> username: admin, password: admin123
-- Hash di bawah adalah hasil password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO admin (username, password, nama_lengkap) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5by2iyVvxvfeeCoIF83MRQ4LNbaEeFprPuF/72e', 'Administrator');

INSERT INTO profil (sejarah, visi, misi, nilai_perusahaan) VALUES
('PT Digital Solusi Nusantara didirikan sebagai perusahaan yang bergerak di bidang Jasa Teknologi Informasi.',
 'Menjadi perusahaan IT terpercaya yang mendukung transformasi digital di Indonesia.',
 'Memberikan solusi teknologi yang inovatif, andal, dan berkualitas bagi setiap klien.',
 'Integritas, Inovasi, Kolaborasi, dan Profesionalisme.');

INSERT INTO produk (nama_layanan, deskripsi, gambar) VALUES
('Pengembangan Website', 'Layanan pembuatan website company profile, e-commerce, hingga aplikasi berbasis web.', 'produk-website.jpg'),
('Jaringan Komputer', 'Instalasi dan konfigurasi jaringan komputer untuk kebutuhan perkantoran maupun industri.', 'produk-jaringan.jpg'),
('Konsultasi IT', 'Konsultasi strategi teknologi informasi untuk mendukung pertumbuhan bisnis klien.', 'produk-konsultasi.jpg');

INSERT INTO artikel (judul, thumbnail, tanggal, ringkasan, isi_artikel) VALUES
('Tren Pengembangan Website Tahun Ini', 'artikel-1.jpg', CURDATE(),
 'Simak tren terbaru dalam pengembangan website yang perlu diketahui oleh pelaku bisnis.',
 'Isi lengkap artikel mengenai tren pengembangan website akan ditampilkan di sini...');

INSERT INTO galeri (judul, foto) VALUES
('Kegiatan Pelatihan Internal', 'galeri-1.jpg'),
('Kunjungan Klien ke Kantor', 'galeri-2.jpg');
