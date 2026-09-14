<?php
require_once __DIR__ . '/includes/cek_login.php';
require_once __DIR__ . '/../config/koneksi.php';

// Ambil jumlah data dari tiap tabel untuk ditampilkan sebagai ringkasan/statistik
function hitungData($koneksi, $nama_tabel) {
    $hasil = $koneksi->query("SELECT COUNT(*) AS total FROM {$nama_tabel}");
    $baris = $hasil->fetch_assoc();
    return (int) $baris['total'];
}

$total_produk  = hitungData($koneksi, 'produk');
$total_artikel = hitungData($koneksi, 'artikel');
$total_galeri  = hitungData($koneksi, 'galeri');

$page_title  = 'Dashboard';
$active_menu = 'dashboard';
require_once __DIR__ . '/includes/admin_header.php';
?>

<div class="row g-4">
  <div class="col-md-4">
    <div class="admin-card d-flex align-items-center gap-3">
      <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:rgba(10,31,68,0.08);">
        <i class="fa-solid fa-box fa-lg" style="color:var(--color-primary);"></i>
      </div>
      <div>
        <div class="text-muted small">Total Produk / Layanan</div>
        <div class="fs-4 fw-bold"><?= $total_produk ?></div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="admin-card d-flex align-items-center gap-3">
      <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:rgba(201,162,39,0.12);">
        <i class="fa-solid fa-newspaper fa-lg" style="color:var(--color-accent);"></i>
      </div>
      <div>
        <div class="text-muted small">Total Artikel</div>
        <div class="fs-4 fw-bold"><?= $total_artikel ?></div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="admin-card d-flex align-items-center gap-3">
      <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:rgba(10,31,68,0.08);">
        <i class="fa-solid fa-images fa-lg" style="color:var(--color-primary);"></i>
      </div>
      <div>
        <div class="text-muted small">Total Foto Galeri</div>
        <div class="fs-4 fw-bold"><?= $total_galeri ?></div>
      </div>
    </div>
  </div>
</div>

<div class="admin-card mt-4">
  <h5 class="fw-bold mb-3">Selamat Datang, <?= htmlspecialchars($_SESSION['admin_nama']) ?> 👋</h5>
  <p class="text-muted mb-0">
    Gunakan menu di samping untuk mengelola Profil Perusahaan, Produk/Layanan, Artikel, dan Galeri.
    Perubahan yang kamu simpan di sini akan langsung tampil di halaman website utama.
  </p>
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
