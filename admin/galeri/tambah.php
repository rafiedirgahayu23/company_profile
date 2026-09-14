<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');

    if ($judul === '') {
        $error = 'Judul foto wajib diisi.';
    } else {
        $upload = uploadGambar($_FILES['foto'] ?? null, 'galeri');

        if (!$upload['sukses']) {
            // Untuk galeri, foto WAJIB diisi (beda dengan produk/artikel yang boleh pakai default)
            $error = $upload['pesan'] === 'no_file' ? 'Foto wajib diupload.' : $upload['pesan'];
        } else {
            $stmt = $koneksi->prepare('INSERT INTO galeri (judul, foto) VALUES (?, ?)');
            $stmt->bind_param('ss', $judul, $upload['nama_file']);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?sukses=Foto berhasil diupload.');
            exit;
        }
    }
}

$page_title  = 'Upload Foto Galeri';
$active_menu = 'galeri';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:600px;">
  <h5 class="fw-bold mb-4">Upload Foto Baru</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label fw-medium">Judul Foto</label>
      <input type="text" name="judul" class="form-control"
             value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>" required>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Foto</label>
      <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
      <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB.</div>
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-upload me-1"></i> Upload
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
