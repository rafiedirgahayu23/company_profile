<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_layanan = trim($_POST['nama_layanan'] ?? '');
  $icon = trim($_POST['icon'] ?? 'fa-solid fa-laptop-code');
  $deskripsi = trim($_POST['deskripsi'] ?? '');
  $deskripsi_lengkap = trim($_POST['deskripsi_lengkap'] ?? '');
  $fitur = trim($_POST['fitur'] ?? '');

  if ($nama_layanan === '' || $deskripsi === '') {
    $error = 'Nama layanan dan deskripsi wajib diisi.';
  } else {
    $upload = uploadGambar($_FILES['gambar'] ?? null, 'produk');

    if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
      $error = $upload['pesan'];
    } else {
      $nama_gambar = $upload['sukses'] ? $upload['nama_file'] : 'default-produk.jpg';

      $stmt = $koneksi->prepare('INSERT INTO produk (nama_layanan, icon, deskripsi, deskripsi_lengkap, fitur, gambar) VALUES (?, ?, ?, ?, ?, ?)');
      $stmt->bind_param('ssssss', $nama_layanan, $icon, $deskripsi, $deskripsi_lengkap, $fitur, $nama_gambar);
      $stmt->execute();
      $stmt->close();

      header('Location: index.php?sukses=Produk berhasil ditambahkan.');
      exit;
    }
  }
}

$page_title = 'Tambah Produk';
$active_menu = 'produk';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:750px;">
  <h5 class="fw-bold mb-4">Tambah Produk / Layanan Baru</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-8 mb-3">
        <label class="form-label fw-medium">Nama Layanan</label>
        <input type="text" name="nama_layanan" class="form-control"
          value="<?= htmlspecialchars($_POST['nama_layanan'] ?? '') ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Class Icon (FontAwesome)</label>
        <input type="text" name="icon" class="form-control" placeholder="fa-solid fa-laptop-code"
          value="<?= htmlspecialchars($_POST['icon'] ?? '') ?>">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Deskripsi Singkat</label>
      <textarea name="deskripsi" class="form-control" rows="2"
        required><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Deskripsi Lengkap</label>
      <textarea name="deskripsi_lengkap" class="form-control"
        rows="5"><?= htmlspecialchars($_POST['deskripsi_lengkap'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Fitur Utama (Pisahkan dengan koma)</label>
      <input type="text" name="fitur" class="form-control" placeholder="Responsive UI, Fast Speed, Secure"
        value="<?= htmlspecialchars($_POST['fitur'] ?? '') ?>">
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Gambar Produk</label>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Produk
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>