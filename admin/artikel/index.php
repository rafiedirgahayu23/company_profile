<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

$data_artikel = $koneksi->query('SELECT * FROM artikel ORDER BY tanggal DESC');

$page_title  = 'Artikel';
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

  <?php if (isset($_GET['sukses'])): ?>
    <div class="alert alert-success py-2 small"><?= htmlspecialchars($_GET['sukses']) ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr class="text-muted small text-uppercase">
          <th style="width:80px;">Thumbnail</th>
          <th>Judul</th>
          <th style="width:120px;">Tanggal</th>
          <th style="width:140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($data_artikel->num_rows === 0): ?>
          <tr><td colspan="4" class="text-center text-muted py-4">Belum ada artikel.</td></tr>
        <?php else: ?>
          <?php while ($row = $data_artikel->fetch_assoc()): ?>
            <tr>
              <td>
                <img src="/company-profile/assets/img/<?= htmlspecialchars($row['thumbnail']) ?>"
                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;"
                     onerror="this.src='https://via.placeholder.com/60?text=No+Img'">
              </td>
              <td class="fw-medium"><?= htmlspecialchars($row['judul']) ?></td>
              <td class="text-muted small"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id_artikel'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </a>
                <a href="hapus.php?id=<?= $row['id_artikel'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus"
                   onclick="return confirm('Yakin ingin menghapus artikel ini?');">
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
