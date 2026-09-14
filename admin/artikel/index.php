<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

// Ambil semua artikel, urut terbaru
$data_artikel = $koneksi->query('SELECT * FROM artikel ORDER BY tanggal DESC');

$page_title = 'Artikel';
$active_menu = 'artikel';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Artikel</h5>
    <a href="tambah.php" class="btn btn-sm text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-plus me-1"></i> Tambah Artikel
    </a>
  </div>

  <!-- Notifikasi sukses -->
  <?php if (isset($_GET['sukses'])): ?>
    <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
      <i class="fa-solid fa-circle-check me-1"></i>
      <?= htmlspecialchars($_GET['sukses']) ?>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr class="text-muted small text-uppercase">
          <th style="width:80px;">Gambar</th>
          <th>Judul</th>
          <th style="width:110px;">Kategori</th>
          <th style="width:110px;">Penulis</th>
          <th style="width:120px;">Tanggal</th>
          <th style="width:130px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data_artikel->num_rows === 0): ?>
          <tr>
            <td colspan="6" class="text-center text-muted py-4">
              <i class="fa-regular fa-folder-open fa-2x mb-2 d-block"></i>
              Belum ada artikel. Klik "Tambah Artikel" untuk memulai.
            </td>
          </tr>
        <?php else: ?>
          <?php while ($row = $data_artikel->fetch_assoc()): ?>
            <tr>
              <td>
                <?php
                // Gambar bisa URL eksternal atau file lokal di assets/img/
                $src = $row['gambar'];
                if (!str_starts_with($src, 'http')) {
                  $src = '/company-profile/assets/img/' . $src;
                }
                ?>
                <img src="<?= htmlspecialchars($src) ?>" style="width:60px;height:60px;object-fit:cover;border-radius:8px;"
                  onerror="this.src='https://via.placeholder.com/60?text=No+Img'">
              </td>
              <td class="fw-medium"><?= htmlspecialchars($row['judul']) ?></td>
              <td>
                <span class="badge rounded-pill" style="background:var(--color-primary);font-size:.75rem;">
                  <?= htmlspecialchars($row['kategori']) ?>
                </span>
              </td>
              <td class="text-muted small"><?= htmlspecialchars($row['penulis']) ?></td>
              <td class="text-muted small"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id_artikel'] ?>" class="btn btn-sm btn-outline-primary me-1"
                  title="Edit Artikel">
                  <i class="fa-solid fa-pen"></i>
                </a>
                <a href="hapus.php?id=<?= $row['id_artikel'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus Artikel"
                  onclick="return confirm('Yakin ingin menghapus artikel ini? Tindakan ini tidak bisa dibatalkan.');">
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