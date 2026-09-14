<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

// Profil perusahaan cuma 1 baris data, ambil baris pertama (kalau belum ada, insert kosong dulu)
$profil = $koneksi->query('SELECT * FROM profil LIMIT 1')->fetch_assoc();

if (!$profil) {
  $koneksi->query("INSERT INTO profil (sejarah, visi, misi, nilai_perusahaan) VALUES ('', '', '', '')");
  $profil = $koneksi->query('SELECT * FROM profil LIMIT 1')->fetch_assoc();
}

$error = '';
$sukses = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sejarah = trim($_POST['sejarah'] ?? '');
  $visi = trim($_POST['visi'] ?? '');
  $misi = trim($_POST['misi'] ?? '');
  $nilai_perusahaan = trim($_POST['nilai_perusahaan'] ?? '');

  if ($sejarah === '' || $visi === '' || $misi === '' || $nilai_perusahaan === '') {
    $error = 'Semua field wajib diisi.';
  } else {
    $stmt = $koneksi->prepare('UPDATE profil SET sejarah = ?, visi = ?, misi = ?, nilai_perusahaan = ? WHERE id_profil = ?');
    $stmt->bind_param('ssssi', $sejarah, $visi, $misi, $nilai_perusahaan, $profil['id_profil']);
    $stmt->execute();
    $stmt->close();

    // Ambil ulang data terbaru
    $profil = $koneksi->query('SELECT * FROM profil LIMIT 1')->fetch_assoc();
    $sukses = 'Profil perusahaan berhasil diperbarui.';
  }
}

$page_title = 'Profil Perusahaan';
$active_menu = 'profil';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:800px;">
  <h5 class="fw-bold mb-4">Edit Profil Perusahaan</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <?php if ($sukses): ?>
    <div class="alert alert-success py-2 small"><?= htmlspecialchars($sukses) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-4">
      <label class="form-label fw-semibold mb-1">Sejarah Perusahaan</label>
      <textarea name="sejarah" class="form-control" rows="4"
        required><?= htmlspecialchars($profil['sejarah'] ?? '') ?></textarea>
    </div>

    <div class="mb-4">
      <label class="form-label fw-semibold mb-1">Visi</label>
      <textarea name="visi" class="form-control" rows="2"
        required><?= htmlspecialchars($profil['visi'] ?? '') ?></textarea>
    </div>

    <!-- Misi Field -->
    <div class="mb-4">
      <label class="form-label fw-semibold mb-1">Misi Perusahaan</label>
      <textarea name="misi" class="form-control mb-1" rows="4"
        required><?= htmlspecialchars($profil['misi'] ?? '') ?></textarea>
      <small class="text-muted" style="font-size: 0.8rem;">* Tulis 1 poin misi per baris (tekan Enter untuk baris
        baru).</small>
    </div>

    <!-- Nilai Perusahaan Field -->
    <div class="mb-4">
      <label class="form-label fw-semibold mb-1">Nilai-Nilai Perusahaan</label>
      <textarea name="nilai_perusahaan" class="form-control mb-1" rows="4"
        required><?= htmlspecialchars($profil['nilai_perusahaan'] ?? '') ?></textarea>
      <small class="text-muted d-block" style="font-size: 0.8rem;">
        * Format per baris: <strong>Judul: Deskripsi</strong> (Contoh: <em>Inovatif: Terus belajar dan mengadopsi
          teknologi terbaru.</em>)
      </small>
    </div>

    <button type="submit" class="btn text-white fw-medium px-4 py-2 mt-2"
      style="background:var(--color-primary, #0f172a);">
      <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
    </button>
  </form>

  <?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>