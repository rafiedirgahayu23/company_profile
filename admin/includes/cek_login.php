<?php
/**
 * File Proteksi Halaman Admin
 * Wajib di-include di baris PALING ATAS setiap halaman admin
 * (kecuali login.php) untuk memastikan hanya admin yang sudah
 * login yang bisa mengakses halaman tersebut.
 */
session_start();

if (!isset($_SESSION['admin_id'])) {
    // Belum login -> tendang ke halaman login.
    // Pakai path absolut dari root web (bukan relatif) supaya tetap benar
    // baik file ini dipanggil dari admin/dashboard.php maupun dari
    // admin/produk/tambah.php (kedalaman folder berbeda-beda).
    header('Location: /company-profile/admin/login.php');
    exit;
}
