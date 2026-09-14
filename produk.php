<?php
include 'includes/header.php';
include 'config/koneksi.php';

// Ambil semua data dari tabel produk
$query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk ASC");
?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Layanan & Produk</h1>
        <p class="lead mb-0">Eksplorasi ragam solusi teknologi yang kami rancang khusus untuk kemajuan bisnis Anda.</p>
    </div>
</section>

<!-- Produk/Layanan Grid -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">

            <?php
            if (mysqli_num_rows($query) > 0) {
                $delay = 0; // Delay animasi AOS agar muncul bergantian
                while ($item = mysqli_fetch_assoc($query)) {

                    // Handling Gambar (Dari folder uploads/ atau Fallback Unsplash)
                    if (!empty($item['gambar']) && file_exists('assets/img/' . $item['gambar'])) {
                        $img_src = 'assets/img/' . $item['gambar'];
                    } elseif (!empty($item['gambar']) && file_exists('uploads/' . $item['gambar'])) {
                        $img_src = 'uploads/' . $item['gambar'];
                    } else {
                        $img_src = 'assets/img/problem.jpg';
                    }

                    // Handling Icon
                    $icon_class = !empty($item['icon']) ? $item['icon'] : 'fa-solid fa-laptop-code';
                    ?>
                    <!-- Loop Card Produk Dinamis -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                        <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                            <img src="<?= htmlspecialchars($img_src); ?>" alt="<?= htmlspecialchars($item['nama_layanan']); ?>"
                                class="card-img-top img-cover" style="height: 200px; object-fit: cover;">

                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <div class="icon-box mb-3" style="width: 50px; height: 50px; font-size: 20px;">
                                    <i class="<?= htmlspecialchars($icon_class); ?>"></i>
                                </div>
                                <h4 class="fw-bold mb-3"><?= htmlspecialchars($item['nama_layanan']); ?></h4>
                                <p class="text-muted small mb-4 flex-grow-1">
                                    <?= htmlspecialchars($item['deskripsi']); ?>
                                </p>
                                <a href="detail-layanan.php?id=<?= $item['id_produk']; ?>"
                                    class="btn btn-outline-primary w-100 mt-auto">
                                    Lihat Detail Layanan
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay += 100; // Tambah delay 100ms per item untuk efek animasi AOS
                }
            } else {
                ?>
                <!-- Jika data di database kosong -->
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Belum ada layanan atau produk yang ditambahkan.</p>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>