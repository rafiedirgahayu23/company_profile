<?php
require_once __DIR__ . '/../includes/cek_login.php';
require_once __DIR__ . '/../../config/koneksi.php';

$data_galeri = $koneksi->query('SELECT * FROM galeri ORDER BY created_at DESC');

$page_title  = 'Galeri';
$active_menu = 'galeri';
require_once __DIR__ . '/../includes/admin_header.php';
?>

<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Foto Galeri</h5>
    <a href="tambah.php" class="btn btn-sm text-white" style="background:var(--color-primary);">
      <i class="fa-solid fa-upload me-1"></i> Upload Foto
    </a>
  </div>

  <?php if (isset($_GET['sukses'])): ?>
    <div class="alert alert-success py-2 small"><?= htmlspecialchars($_GET['sukses']) ?></div>
  <?php endif; ?>

  <div class="row g-3">
    <?php if ($data_galeri->num_rows === 0): ?>
      <div class="col-12 text-center text-muted py-4">Belum ada foto di galeri.</div>
    <?php else: ?>
      <?php while ($row = $data_galeri->fetch_assoc()): ?>
        <div class="col-md-3 col-sm-4 col-6">
          <div class="border rounded-3 overflow-hidden h-100">
            <img src="/company-profile/assets/img/<?= htmlspecialchars($row['foto']) ?>"
                 style="width:100%;height:140px;object-fit:cover;"
                 onerror="this.src='https://via.placeholder.com/200?text=No+Img'">
            <div class="p-2">
              <div class="fw-medium small mb-2"><?= htmlspecialchars($row['judul']) ?></div>
              <div class="d-flex gap-1">
                <a href="edit.php?id=<?= $row['id_galeri'] ?>" class="btn btn-sm btn-outline-primary flex-fill">
                  <i class="fa-solid fa-pen"></i>
                </a>
                <a href="hapus.php?id=<?= $row['id_galeri'] ?>" class="btn btn-sm btn-outline-danger flex-fill"
                   onclick="return confirm('Yakin ingin menghapus foto ini?');">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
