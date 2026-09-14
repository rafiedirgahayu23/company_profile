<?php
include 'config/koneksi.php'; // 1. Sertakan koneksi database
include 'includes/header.php';

// 2. Ambil ID dari URL (Default ke ID 1 jika tidak ada / tidak valid)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;

// 3. Query data produk dari database berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = $id");
$current_service = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan di database, fallback ke produk pertama
if (!$current_service) {
    $fallback_query = mysqli_query($koneksi, "SELECT * FROM produk LIMIT 1");
    $current_service = mysqli_fetch_assoc($fallback_query);
    if ($current_service) {
        $id = $current_service['id_produk'];
    }
}

// Handling Gambar Dinamis (Cek di assets/img/ dan uploads/)
$gambar_nama = $current_service['gambar'] ?? '';

if (!empty($gambar_nama) && file_exists('assets/img/' . $gambar_nama)) {
    $img_src = 'assets/img/' . $gambar_nama;
} elseif (!empty($gambar_nama) && file_exists('uploads/' . $gambar_nama)) {
    $img_src = 'uploads/' . $gambar_nama;
} else {
    // Fallback ke gambar default lokal jika file tidak ditemukan / tidak ada di DB
    $img_src = 'assets/img/problem.jpg';
}

// Handling Icon
$icon_class = !empty($current_service['icon']) ? $current_service['icon'] : 'fa-solid fa-laptop-code';

// Handling Fitur (Memecah string fitur yang dipisahkan koma menjadi array)
$fitur_list = !empty($current_service['fitur']) ? explode(',', $current_service['fitur']) : [];
?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Detail Layanan</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <!-- Breadcrumb & Back button -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="produk.php">Layanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?= htmlspecialchars($current_service['nama_layanan']); ?>
                    </li>
                </ol>
            </nav>
            <a href="produk.php" class="btn btn-outline-primary btn-sm">&larr; Kembali ke Layanan</a>
        </div>

        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="service-detail-card p-4 p-md-5 rounded-4 border">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3 mb-0 d-flex align-items-center justify-content-center bg-primary text-white rounded"
                            style="width: 60px; height: 60px; font-size: 24px;">
                            <i class="<?= htmlspecialchars($icon_class); ?>"></i>
                        </div>
                        <h1 class="fw-bold mb-0"><?= htmlspecialchars($current_service['nama_layanan']); ?></h1>
                    </div>

                    <img src="<?= htmlspecialchars($img_src); ?>"
                        alt="<?= htmlspecialchars($current_service['nama_layanan']); ?>"
                        class="img-fluid rounded-4 mb-4 w-100 shadow-sm" style="max-height: 400px; object-fit: cover;">

                    <div class="article-content mb-5">
                        <p class="lead fw-normal text-secondary mb-3">
                            <?= htmlspecialchars($current_service['deskripsi']); ?>
                        </p>
                        <?php if (!empty($current_service['deskripsi_lengkap'])): ?>
                            <p><?= nl2br(htmlspecialchars($current_service['deskripsi_lengkap'])); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($fitur_list)): ?>
                        <h4 class="fw-bold mb-3">Fitur Utama Layanan</h4>
                        <ul class="list-unstyled mb-5">
                            <?php foreach ($fitur_list as $fitur): ?>
                                <li class="d-flex align-items-start mb-3 service-checklist">
                                    <i class="fa-solid fa-circle-check text-primary-custom mt-1 me-3 fs-5 checklist-icon"></i>
                                    <span class="fs-6"><?= htmlspecialchars(trim($fitur)); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <!-- CTA Banner -->
                    <div class="bg-soft p-4 rounded-4 text-center border">
                        <h4 class="fw-bold mb-3">Tertarik menggunakan layanan ini?</h4>
                        <p class="text-muted mb-4">Tim konsultan kami siap memberikan solusi terbaik sesuai kebutuhan
                            bisnis Anda.</p>
                        <a href="kontak.php" class="btn btn-primary btn-lg">
                            Konsultasi Gratis Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="service-sidebar-card p-4 rounded-4 border mb-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Layanan Lainnya</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php
                        // Query mengambil layanan lain selain yang sedang dibuka
                        $sidebar_query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk != $id ORDER BY id_produk ASC");

                        while ($sidebar_item = mysqli_fetch_assoc($sidebar_query)) {
                            $sb_icon = !empty($sidebar_item['icon']) ? $sidebar_item['icon'] : 'fa-solid fa-laptop-code';
                            ?>
                            <a href="detail-layanan.php?id=<?= $sidebar_item['id_produk']; ?>"
                                class="text-decoration-none sidebar-list-item d-flex align-items-center p-3 rounded-3 border">
                                <div class="icon-box flex-shrink-0 me-3 mb-0 d-flex align-items-center justify-content-center bg-light text-primary rounded"
                                    style="width: 45px; height: 45px; font-size: 18px;">
                                    <i class="<?= htmlspecialchars($sb_icon); ?>"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 title-text text-dark" style="line-height: 1.4;">
                                        <?= htmlspecialchars($sidebar_item['nama_layanan']); ?>
                                    </h6>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <!-- Contact Fast Track -->
                <div class="bg-primary-custom text-white p-4 rounded-4 text-center shadow-sm">
                    <h5 class="fw-bold mb-3 text-white">Butuh Bantuan Cepat?</h5>
                    <p class="small mb-4" style="opacity: 0.85;">Hubungi tim kami secara langsung untuk respon yang
                        lebih cepat.</p>
                    <div class="d-flex flex-column gap-3">
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="btn btn-light w-100 fw-semibold d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-whatsapp fs-5 text-success me-2"></i> WhatsApp Kami
                        </a>
                        <a href="mailto:info@dsn.co.id"
                            class="btn btn-outline-light w-100 fw-semibold d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-envelope fs-5 me-2"></i> info@dsn.co.id
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>