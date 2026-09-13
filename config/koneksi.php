<?php
/**
 * File Koneksi Database
 * Digunakan oleh seluruh halaman (front-end & admin) untuk terhubung
 * ke database db_companyprofile.
 *
 * Cukup panggil: require_once __DIR__ . '/../config/koneksi.php';
 * lalu gunakan variabel $koneksi di halaman yang membutuhkan.
 */

// --- Konfigurasi Database ---
// Sesuaikan jika username/password MySQL di komputer kamu berbeda
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_companyprofile';

// --- Membuat Koneksi ---
$koneksi = new mysqli($db_host, $db_user, $db_pass, $db_name);

// --- Penanganan Error Koneksi ---
if ($koneksi->connect_error) {
    // Hentikan eksekusi & tampilkan pesan yang jelas jika koneksi gagal
    die('Koneksi database gagal: ' . $koneksi->connect_error);
}

// Set karakter set agar teks (termasuk simbol/aksen) tampil dengan benar
$koneksi->set_charset('utf8mb4');
