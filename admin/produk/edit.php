<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

// Ambil data produk yang mau diedit
$stmt = $koneksi->prepare('SELECT * FROM produk WHERE id_produk = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$produk = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$produk) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_layanan = trim($_POST['nama_layanan'] ?? '');
    $deskripsi    = trim($_POST['deskripsi'] ?? '');

    if ($nama_layanan === '' || $deskripsi === '') {
        $error = 'Nama layanan dan deskripsi wajib diisi.';
    } else {
        $upload = uploadGambar($_FILES['gambar'] ?? null, 'produk');

        if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
            $error = $upload['pesan'];
        } else {
            // Kalau ada gambar baru diupload, ganti gambar lama dan hapus yang lama
            $nama_gambar = $produk['gambar'];
            if ($upload['sukses']) {
                hapusGambarLama($produk['gambar']);
                $nama_gambar = $upload['nama_file'];
            }

            $stmt = $koneksi->prepare('UPDATE produk SET nama_layanan = ?, deskripsi = ?, gambar = ? WHERE id_produk = ?');
            $stmt->bind_param('sssi', $nama_layanan, $deskripsi, $nama_gambar, $id);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?sukses=Produk berhasil diperbarui.');
            exit;
        }
    }
}

$page_title  = 'Edit Produk';
$active_menu = 'produk';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:700px;">
  <h5 class="fw-bold mb-4">Edit Produk / Layanan</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label fw-medium">Nama Layanan</label>
      <input type="text" name="nama_layanan" class="form-control"
             value="<?= htmlspecialchars($_POST['nama_layanan'] ?? $produk['nama_layanan']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($_POST['deskripsi'] ?? $produk['deskripsi']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Gambar Saat Ini</label>
      <div>
        <img src="/company-profile/assets/img/<?= htmlspecialchars($produk['gambar']) ?>"
             style="width:100px;height:100px;object-fit:cover;border-radius:8px;"
             onerror="this.src='https://via.placeholder.com/100?text=No+Img'">
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Ganti Gambar (opsional)</label>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
      <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
