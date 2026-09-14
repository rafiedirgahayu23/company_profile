<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare('SELECT * FROM artikel WHERE id_artikel = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$artikel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$artikel) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul       = trim($_POST['judul'] ?? '');
    $tanggal     = $_POST['tanggal'] ?? '';
    $ringkasan   = trim($_POST['ringkasan'] ?? '');
    $isi_artikel = trim($_POST['isi_artikel'] ?? '');

    if ($judul === '' || $tanggal === '' || $ringkasan === '' || $isi_artikel === '') {
        $error = 'Semua field wajib diisi.';
    } else {
        $upload = uploadGambar($_FILES['thumbnail'] ?? null, 'artikel');

        if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
            $error = $upload['pesan'];
        } else {
            $nama_gambar = $artikel['thumbnail'];
            if ($upload['sukses']) {
                hapusGambarLama($artikel['thumbnail']);
                $nama_gambar = $upload['nama_file'];
            }

            $stmt = $koneksi->prepare('UPDATE artikel SET judul = ?, thumbnail = ?, tanggal = ?, ringkasan = ?, isi_artikel = ? WHERE id_artikel = ?');
            $stmt->bind_param('sssssi', $judul, $nama_gambar, $tanggal, $ringkasan, $isi_artikel, $id);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?sukses=Artikel berhasil diperbarui.');
            exit;
        }
    }
}

$page_title  = 'Edit Artikel';
$active_menu = 'artikel';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:750px;">
  <h5 class="fw-bold mb-4">Edit Artikel</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label fw-medium">Judul Artikel</label>
      <input type="text" name="judul" class="form-control"
             value="<?= htmlspecialchars($_POST['judul'] ?? $artikel['judul']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Tanggal</label>
      <input type="date" name="tanggal" class="form-control"
             value="<?= htmlspecialchars($_POST['tanggal'] ?? $artikel['tanggal']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Ringkasan Singkat</label>
      <textarea name="ringkasan" class="form-control" rows="2" maxlength="300" required><?= htmlspecialchars($_POST['ringkasan'] ?? $artikel['ringkasan']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Isi Artikel Lengkap</label>
      <textarea name="isi_artikel" class="form-control" rows="6" required><?= htmlspecialchars($_POST['isi_artikel'] ?? $artikel['isi_artikel']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Thumbnail Saat Ini</label>
      <div>
        <img src="/company-profile/assets/img/<?= htmlspecialchars($artikel['thumbnail']) ?>"
             style="width:100px;height:100px;object-fit:cover;border-radius:8px;"
             onerror="this.src='https://via.placeholder.com/100?text=No+Img'">
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Ganti Thumbnail (opsional)</label>
      <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
