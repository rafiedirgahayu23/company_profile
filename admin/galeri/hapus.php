<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare('SELECT foto FROM galeri WHERE id_galeri = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$galeri = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($galeri) {
    $stmt = $koneksi->prepare('DELETE FROM galeri WHERE id_galeri = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    hapusGambarLama($galeri['foto']);
}

header('Location: index.php?sukses=Foto berhasil dihapus.');
exit;
