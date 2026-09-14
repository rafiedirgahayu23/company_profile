<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul = trim($_POST['judul'] ?? '');
  $kategori = trim($_POST['kategori'] ?? 'Umum');
  $penulis = trim($_POST['penulis'] ?? 'Admin DSN');
  $waktu_baca = trim($_POST['waktu_baca'] ?? '5 Menit Baca');
  $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
  $ringkasan = trim($_POST['ringkasan'] ?? '');
  $konten = trim($_POST['konten'] ?? '');

  if ($judul === '' || $tanggal === '' || $ringkasan === '' || $konten === '') {
    $error = 'Semua field wajib diisi.';
  } else {
    $upload = uploadGambar($_FILES['gambar'] ?? null, 'artikel');

    if (!$upload['sukses'] && $upload['pesan'] !== 'no_file') {
      $error = $upload['pesan'];
    } else {
      $nama_gambar = $upload['sukses'] ? $upload['nama_file'] : 'default-artikel.jpg';

      // Query disesuaikan persis dengan kolom database
      $stmt = $koneksi->prepare('INSERT INTO artikel (judul, kategori, penulis, tanggal, waktu_baca, gambar, ringkasan, konten) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
      $stmt->bind_param('ssssssss', $judul, $kategori, $penulis, $tanggal, $waktu_baca, $nama_gambar, $ringkasan, $konten);
      $stmt->execute();
      $stmt->close();

      header('Location: index.php?sukses=Artikel berhasil ditambahkan.');
      exit;
    }
  }
}

$page_title = 'Tambah Artikel';
$active_menu = 'artikel';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:750px;">
  <h5 class="fw-bold mb-4">Tambah Artikel Baru</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label fw-medium">Judul Artikel</label>
      <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>"
        required>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Kategori</label>
        <input type="text" name="kategori" class="form-control" placeholder="misal: Web Dev, Cloud"
          value="<?= htmlspecialchars($_POST['kategori'] ?? '') ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Penulis</label>
        <input type="text" name="penulis" class="form-control"
          value="<?= htmlspecialchars($_POST['penulis'] ?? 'Admin DSN') ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label fw-medium">Waktu Baca</label>
        <input type="text" name="waktu_baca" class="form-control" placeholder="misal: 5 Menit Baca"
          value="<?= htmlspecialchars($_POST['waktu_baca'] ?? '5 Menit Baca') ?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Tanggal</label>
      <input type="date" name="tanggal" class="form-control"
        value="<?= htmlspecialchars($_POST['tanggal'] ?? date('Y-m-d')) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Ringkasan Singkat</label>
      <textarea name="ringkasan" class="form-control" rows="2" maxlength="300"
        required><?= htmlspecialchars($_POST['ringkasan'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Isi Konten Artikel</label>
      <textarea name="konten" class="form-control" rows="6"
        required><?= htmlspecialchars($_POST['konten'] ?? '') ?></textarea>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Gambar Artikel</label>
      <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Artikel
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>