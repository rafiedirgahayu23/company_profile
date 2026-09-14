<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

// Ambil dulu nama gambarnya sebelum data dihapus, supaya file-nya bisa ikut dihapus
$stmt = $koneksi->prepare('SELECT gambar FROM produk WHERE id_produk = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$produk = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($produk) {
    $stmt = $koneksi->prepare('DELETE FROM produk WHERE id_produk = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    // Hapus juga file gambarnya dari folder assets/img, kecuali gambar default
    if ($produk['gambar'] !== 'default-produk.jpg') {
        hapusGambarLama($produk['gambar']);
    }
}

header('Location: index.php?sukses=Produk berhasil dihapus.');
exit;
