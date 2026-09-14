<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../includes/upload_helper.php';
require_once __DIR__ . '/../../config/koneksi.php';

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
            $nama_gambar = $upload['sukses'] ? $upload['nama_file'] : 'default-artikel.jpg';

            $stmt = $koneksi->prepare('INSERT INTO artikel (judul, thumbnail, tanggal, ringkasan, isi_artikel) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $judul, $nama_gambar, $tanggal, $ringkasan, $isi_artikel);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?sukses=Artikel berhasil ditambahkan.');
            exit;
        }
    }
}

$page_title  = 'Tambah Artikel';
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
      <input type="text" name="judul" class="form-control"
             value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Tanggal</label>
      <input type="date" name="tanggal" class="form-control"
             value="<?= htmlspecialchars($_POST['tanggal'] ?? date('Y-m-d')) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Ringkasan Singkat</label>
      <textarea name="ringkasan" class="form-control" rows="2" maxlength="300" required><?= htmlspecialchars($_POST['ringkasan'] ?? '') ?></textarea>
      <div class="form-text">Ditampilkan di halaman daftar artikel. Maksimal 300 karakter.</div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Isi Artikel Lengkap</label>
      <textarea name="isi_artikel" class="form-control" rows="6" required><?= htmlspecialchars($_POST['isi_artikel'] ?? '') ?></textarea>
      <div class="form-text">Ditampilkan saat pengunjung klik "Baca Selengkapnya".</div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Thumbnail</label>
      <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png,.webp">
      <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB.</div>
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Artikel
    </button>
    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
