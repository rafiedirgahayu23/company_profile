<?php
include 'includes/header.php';
require_once __DIR__ . '/config/koneksi.php';

// Ambil seluruh data galeri dari database
$query_galeri = $koneksi->query("SELECT * FROM galeri ORDER BY id_galeri ASC");
?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Galeri Kami</h1>
        <p class="lead mb-0">Dokumentasi kegiatan, suasana kerja, dan pencapaian dari tim DSN.</p>
    </div>
</section>

<!-- Galeri Grid -->
<section class="section-padding">
    <div class="container">
        <div class="row" id="gallery-masonry">

            <?php if ($query_galeri && $query_galeri->num_rows > 0): ?>
                <?php
                $delay = 0;
                while ($row = $query_galeri->fetch_assoc()):
                    ?>
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="gallery-item position-relative shadow-sm">
                            <img src="/company-profile/assets/img/<?= htmlspecialchars($row['foto']) ?>"
                                alt="<?= htmlspecialchars($row['judul']) ?>" class="img-fluid gallery-img w-100"
                                onerror="this.src='https://via.placeholder.com/600x400?text=Foto+Galeri'">
                            <div class="gallery-caption p-3">
                                <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['judul']) ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay = ($delay + 100) % 400; // Rotasi delay animasi AOS
                endwhile;
                ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-5">
                    <p class="lead">Belum ada foto galeri yang diunggah.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Masonry + imagesLoaded -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script>
    (function () {
        var grid = document.getElementById('gallery-masonry');
        if (!grid) return;
        imagesLoaded(grid, function () {
            new Masonry(grid, {
                itemSelector: '.col-sm-6',
                columnWidth: '.col-sm-6',
                percentPosition: true,
                gutter: 0
            });
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>