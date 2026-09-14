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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sejarah          = trim($_POST['sejarah'] ?? '');
    $visi             = trim($_POST['visi'] ?? '');
    $misi             = trim($_POST['misi'] ?? '');
    $nilai_perusahaan = trim($_POST['nilai_perusahaan'] ?? '');

    if ($sejarah === '' || $visi === '' || $misi === '' || $nilai_perusahaan === '') {
        $error = 'Semua field wajib diisi.';
    } else {
        $stmt = $koneksi->prepare('UPDATE profil SET sejarah = ?, visi = ?, misi = ?, nilai_perusahaan = ? WHERE id_profil = ?');
        $stmt->bind_param('ssssi', $sejarah, $visi, $misi, $nilai_perusahaan, $profil['id_profil']);
        $stmt->execute();
        $stmt->close();

        // Ambil ulang data terbaru supaya form menampilkan hasil yang baru disimpan
        $profil = $koneksi->query('SELECT * FROM profil LIMIT 1')->fetch_assoc();
        $sukses = 'Profil perusahaan berhasil diperbarui.';
    }
}

$page_title  = 'Profil Perusahaan';
$active_menu = 'profil';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card" style="max-width:800px;">
  <h5 class="fw-bold mb-4">Edit Profil Perusahaan</h5>

  <?php if ($error): ?>
    <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <?php if (!empty($sukses)): ?>
    <div class="alert alert-success py-2 small"><?= htmlspecialchars($sukses) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label class="form-label fw-medium">Sejarah Perusahaan</label>
      <textarea name="sejarah" class="form-control" rows="4" required><?= htmlspecialchars($profil['sejarah']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Visi</label>
      <textarea name="visi" class="form-control" rows="2" required><?= htmlspecialchars($profil['visi']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label fw-medium">Misi</label>
      <textarea name="misi" class="form-control" rows="3" required><?= htmlspecialchars($profil['misi']) ?></textarea>
    </div>

    <div class="mb-4">
      <label class="form-label fw-medium">Nilai Perusahaan</label>
      <textarea name="nilai_perusahaan" class="form-control" rows="3" required><?= htmlspecialchars($profil['nilai_perusahaan']) ?></textarea>
    </div>

    <button type="submit" class="btn text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
    </button>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
