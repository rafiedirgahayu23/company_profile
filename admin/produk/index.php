<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

$data_produk = $koneksi->query('SELECT * FROM produk ORDER BY created_at DESC');

$page_title  = 'Produk / Layanan';
$active_menu = 'produk';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Produk / Layanan</h5>
    <a href="tambah.php" class="btn btn-sm text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-plus me-1"></i> Tambah Produk
    </a>
  </div>

  <?php if (isset($_GET['sukses'])): ?>
    <div class="alert alert-success py-2 small"><?= htmlspecialchars($_GET['sukses']) ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr class="text-muted small text-uppercase">
          <th style="width:80px;">Gambar</th>
          <th>Nama Layanan</th>
          <th>Deskripsi</th>
          <th style="width:140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data_produk->num_rows === 0): ?>
          <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data produk.</td></tr>
        <?php else: ?>
          <?php while ($row = $data_produk->fetch_assoc()): ?>
            <tr>
              <td>
                <img src="/company-profile/assets/img/<?= htmlspecialchars($row['gambar']) ?>"
                     alt="<?= htmlspecialchars($row['nama_layanan']) ?>"
                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;"
                     onerror="this.src='https://via.placeholder.com/60?text=No+Img'">
              </td>
              <td class="fw-medium"><?= htmlspecialchars($row['nama_layanan']) ?></td>
              <td class="text-muted small"><?= htmlspecialchars(mb_strimwidth($row['deskripsi'], 0, 70, '...')) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </a>
                <a href="hapus.php?id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus"
                   onclick="return confirm('Yakin ingin menghapus produk ini?');">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
