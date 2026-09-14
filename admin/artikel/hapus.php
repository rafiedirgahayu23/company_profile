<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Ambil data gambar sebelum dihapus (Perhatikan nama Primary Key id_artikel)
$stmt = $koneksi->prepare('SELECT gambar FROM artikel WHERE id_artikel = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$artikel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$artikel) {
    header('Location: index.php?error=Artikel tidak ditemukan.');
    exit;
}

// Hapus record dari database
$stmt = $koneksi->prepare('DELETE FROM artikel WHERE id_artikel = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

// Hapus file gambar lokal (jika bukan URL eksternal dan bukan gambar default)
$gambar = $artikel['gambar'];
if (
    !str_starts_with($gambar, 'http') &&
    $gambar !== 'default-artikel.jpg' &&
    $gambar !== ''
) {
    $path_gambar = __DIR__ . '/../../assets/img/' . $gambar;
    if (file_exists($path_gambar)) {
        unlink($path_gambar);
    }
}

header('Location: index.php?sukses=Artikel berhasil dihapus.');
exit;