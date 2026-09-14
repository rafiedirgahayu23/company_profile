<?php
require_once __DIR__ . '/config/koneksi.php';
include 'includes/header.php';

// Ambil data artikel dari database
$query_artikel = $koneksi->query("SELECT * FROM artikel ORDER BY tanggal DESC");
?>
<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Artikel & Berita</h1>
        <p class="lead mb-0">Dapatkan wawasan terbaru seputar teknologi, tren industri, dan update dari DSN.</p>
    </div>
</section>

<!-- Artikel Grid -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">

            <?php if ($query_artikel->num_rows > 0): ?>
                <?php while ($row = $query_artikel->fetch_assoc()): ?>
                    <?php
                    // Format gambar (eksternal URL atau file lokal)
                    $src_gambar = $row['gambar'];
                    if (!str_starts_with($src_gambar, 'http')) {
                        $src_gambar = 'assets/img/' . $src_gambar;
                    }
                    $tanggal_fmt = date('d M Y', strtotime($row['tanggal']));
                    ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                            <img src="<?= htmlspecialchars($src_gambar) ?>" alt="<?= htmlspecialchars($row['judul']) ?>"
                                class="card-img-top img-cover" style="height: 220px; object-fit: cover;">
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <span
                                        class="badge bg-primary-custom text-white me-2"><?= htmlspecialchars($row['kategori'] ?? 'Umum') ?></span>
                                    <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i>
                                        <?= $tanggal_fmt ?></small>
                                </div>
                                <h5 class="fw-bold mb-3">
                                    <a href="detail-artikel.php?id=<?= $row['id_artikel'] ?>" class="text-primary-custom">
                                        <?= htmlspecialchars($row['judul']) ?>
                                    </a>
                                </h5>
                                <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($row['ringkasan']) ?></p>
                                <a href="detail-artikel.php?id=<?= $row['id_artikel'] ?>"
                                    class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-5">
                    <p class="lead">Belum ada artikel yang diterbitkan.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>