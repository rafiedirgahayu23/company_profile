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
  $judul = trim($_POST['judul'] ?? '');
  $kategori = trim($_POST['kategori'] ?? '');
  $penulis = trim($_POST['penulis'] ?? '');
  $waktu_baca = trim($_POST['waktu_baca'] ?? '');
  $tanggal = $_POST['tanggal'] ?? '';
  $ringkasan = trim($_POST['ringkasan'] ?? '');
  $konten = trim($_POST['konten'] ?? '');

  if ($judul === '' || $tanggal === '' || $ringkasan === '' || $konten === '') {
    $error = 'Semua field wajib diisi.';
  } else {
    $upload = uploadGambar($_FILES['gambar'] ?? null, 'artikel');

    if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
      $error = $upload['pesan'];
    } else {
      $nama_gambar = $artikel['gambar'];
      if ($upload['sukses']) {
        hapusGambarLama($artikel['gambar']);
        $nama_gambar = $upload['nama_file'];
      }

      $stmt = $koneksi->prepare('UPDATE artikel SET judul = ?, kategori = ?, penulis = ?, waktu_baca = ?, gambar = ?, tanggal = ?, ringkasan = ?, konten = ? WHERE id_artikel = ?');
      $stmt->bind_param('ssssssssi', $judul, $kategori, $penulis, $waktu_baca, $nama_gambar, $tanggal, $ringkasan, $konten, $id);
      $stmt->execute();
      $stmt->close();

      header('Location: index.php?sukses=Artikel berhasil diperbarui.');
      exit;
    }
  }
}

$page_title = 'Edit Artikel';
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

    <div class="row">
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Kategori</label>
        <input type="text" name="kategori" class="form-control"
          value="<?= htmlspecialchars($_POST['kategori'] ?? $artikel['kategori']) ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Penulis</label>
        <input type="text" name="penulis" class="form-control"
          value="<?= htmlspecialchars($_POST['penulis'] ?? $artikel['penulis']) ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Waktu Baca</label>
        <input type="text" name="waktu_baca" class="form-control"
          value="<?= htmlspecialchars($_POST['waktu_baca'] ?? $artikel['waktu_baca']) ?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Tanggal</label>
      <input type="date" name="tanggal" class="form-control"
        value="<?= htmlspecialchars($_POST['tanggal'] ?? $artikel['tanggal']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Ringkasan Singkat</label>
      <textarea name="ringkasan" class="form-control" rows="2" maxlength="300"
        required><?= htmlspecialchars($_POST['ringkasan'] ?? $artikel['ringkasan']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Isi Konten Lengkap</label>
      <textarea name="konten" class="form-control" rows="6"
        required><?= htmlspecialchars($_POST['konten'] ?? $artikel['konten']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Gambar Saat Ini</label>
      <div>
        <?php
        $img_src = $artikel['gambar'];
        if (!str_starts_with($img_src, 'http')) {
          $img_src = '/company-profile/assets/img/' . $img_src;
        }
        ?>
        <img src="<?= htmlspecialchars($img_src) ?>"
          style="width:100px;height:100px;object-fit:cover;border-radius:8px;"
          onerror="this.src='https://via.placeholder.com/100?text=No+Img'">
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Ganti Gambar (opsional)</label>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>