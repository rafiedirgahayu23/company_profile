<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare('SELECT * FROM galeri WHERE id_galeri = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$galeri = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$galeri) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');

    if ($judul === '') {
        $error = 'Judul foto wajib diisi.';
    } else {
        $upload = uploadGambar($_FILES['foto'] ?? null, 'galeri');

        if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
            $error = $upload['pesan'];
        } else {
            $nama_foto = $galeri['foto'];
            if ($upload['sukses']) {
                hapusGambarLama($galeri['foto']);
                $nama_foto = $upload['nama_file'];
            }

            $stmt = $koneksi->prepare('UPDATE galeri SET judul = ?, foto = ? WHERE id_galeri = ?');
            $stmt->bind_param('ssi', $judul, $nama_foto, $id);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?sukses=Foto berhasil diperbarui.');
            exit;
        }
    }
}

$page_title  = 'Edit Foto Galeri';
$active_menu = 'galeri';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:600px;">
  <h5 class="fw-bold mb-4">Edit Foto Galeri</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label fw-medium">Judul Foto</label>
      <input type="text" name="judul" class="form-control"
             value="<?= htmlspecialchars($_POST['judul'] ?? $galeri['judul']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Foto Saat Ini</label>
      <div>
        <img src="/company-profile/assets/img/<?= htmlspecialchars($galeri['foto']) ?>"
             style="width:120px;height:120px;object-fit:cover;border-radius:8px;"
             onerror="this.src='https://via.placeholder.com/120?text=No+Img'">
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Ganti Foto (opsional)</label>
      <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
