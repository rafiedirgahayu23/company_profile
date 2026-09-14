<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare('SELECT thumbnail FROM artikel WHERE id_artikel = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$artikel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($artikel) {
    $stmt = $koneksi->prepare('DELETE FROM artikel WHERE id_artikel = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    if ($artikel['thumbnail'] !== 'default-artikel.jpg') {
        hapusGambarLama($artikel['thumbnail']);
    }
}

header('Location: index.php?sukses=Artikel berhasil dihapus.');
exit;
