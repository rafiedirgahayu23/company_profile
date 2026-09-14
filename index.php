<?php
include 'includes/header.php';
require 'config/koneksi.php';

// Ambil 3 artikel terbaru dari database
$query_artikel = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 3");
?>

<!-- Hero Section -->
<section class="hero-video-section">
    <video class="hero-video-bg" autoplay muted loop playsinline poster="assets/img/hero-poster.jpg">
        <source src="assets/video/backgroundhero.mp4" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-4 text-white">Solusi Digital Inovatif untuk Bisnis Anda</h1>
                <p class="lead mb-5 text-white-50">Kami menghadirkan layanan TI profesional mulai dari pengembangan
                    website, infrastruktur jaringan, hingga konsultasi IT untuk mengakselerasi transformasi digital
                    perusahaan Anda.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="produk.php" class="btn btn-primary btn-lg">Lihat Layanan Kami</a>
                    <a href="kontak.php" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-soft">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <h3 class="count-up" data-count="150">0</h3>
                    <p class="mb-0 fw-medium">Proyek Selesai</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <h3 class="count-up" data-count="50">0</h3>
                    <p class="mb-0 fw-medium">Klien Aktif</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <h3 class="count-up" data-count="10">0</h3>
                    <p class="mb-0 fw-medium">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                <img src="assets/img/tentangdsn.jpg" alt="Tentang DSN" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-up">
                <div class="section-title">
                    <span class="subtitle">Tentang DSN</span>
                    <h2 class="fw-bold mb-4">Mitra Teknologi Terpercaya untuk Masa Depan</h2>
                </div>
                <p class="mb-4">PT Digital Solusi Nusantara didirikan dengan dedikasi penuh untuk memajukan industri
                    teknologi di Indonesia. Kami menyediakan ekosistem digital yang komprehensif, disesuaikan dengan
                    kebutuhan unik setiap bisnis.</p>
                <p class="mb-4">Dengan tim yang terdiri dari para profesional berpengalaman, kami berkomitmen untuk
                    memberikan kualitas terbaik dalam setiap layanan, memastikan infrastruktur IT Anda berjalan optimal,
                    aman, dan efisien.</p>
                <a href="profil.php" class="btn btn-outline-primary mt-2">Pelajari Lebih Lanjut <i
                        class="fa-solid fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="section-padding bg-soft">
    <div class="container">
        <div class="text-center section-title" data-aos="fade-up">
            <span class="subtitle">Layanan Kami</span>
            <h2 class="fw-bold">Solusi End-to-End untuk Anda</h2>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom h-100">
                    <div class="card-custom-body">
                        <div class="icon-box">
                            <i class="fa-solid fa-code"></i>
                        </div>
                        <h4 class="mb-3">Pengembangan Web</h4>
                        <p>Pembuatan website perusahaan, e-commerce, hingga web app kustom dengan performa tinggi dan
                            UI/UX yang memukau.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom h-100">
                    <div class="card-custom-body">
                        <div class="icon-box">
                            <i class="fa-solid fa-network-wired"></i>
                        </div>
                        <h4 class="mb-3">Infrastruktur Jaringan</h4>
                        <p>Desain, instalasi, dan pemeliharaan jaringan komputer yang stabil, aman, dan scalable untuk
                            kebutuhan operasional.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-custom h-100">
                    <div class="card-custom-body">
                        <div class="icon-box">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h4 class="mb-3">Konsultasi IT</h4>
                        <p>Dukungan strategis dan teknis untuk membantu Anda mengidentifikasi peluang teknologi dan
                            meminimalkan risiko IT.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="produk.php" class="btn btn-primary">Lihat Semua Layanan</a>
        </div>
    </div>
</section>

<!-- Recent Articles -->
<section class="section-padding">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end section-title mb-5" data-aos="fade-up">
            <div>
                <span class="subtitle">Wawasan Digital</span>
                <h2 class="fw-bold mb-0">Artikel Terbaru</h2>
            </div>
            <a href="artikel.php" class="btn btn-outline-primary d-none d-md-inline-block">Lihat Blog Kami</a>
        </div>

        <div class="row">
            <?php if ($query_artikel && mysqli_num_rows($query_artikel) > 0): ?>
                <?php
                $delay = 100;
                while ($art = mysqli_fetch_assoc($query_artikel)):
                    // Format tanggal (contoh: 10 Sep 2026)
                    $tanggal = date('d M Y', strtotime($art['tanggal']));
                    ?>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                        <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                            <img src="assets/img/<?= htmlspecialchars($art['gambar'] ?? 'default-blog.jpg'); ?>"
                                alt="<?= htmlspecialchars($art['judul']); ?>" class="card-img-top img-cover"
                                style="height: 220px;"
                                onerror="this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <div class="d-flex align-items-center mb-3">
                                    <span
                                        class="badge bg-primary-custom text-white me-2"><?= htmlspecialchars($art['kategori'] ?? 'Umum'); ?></span>
                                    <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i>
                                        <?= $tanggal; ?></small>
                                </div>
                                <h5 class="fw-bold mb-3">
                                    <a href="detail-artikel.php?id=<?= $art['id_artikel']; ?>"
                                        class="text-primary-custom text-decoration-none">
                                        <?= htmlspecialchars($art['judul']); ?>
                                    </a>
                                </h5>
                                <p class="text-muted small mb-0 flex-grow-1">
                                    <?= htmlspecialchars(mb_strimwidth(strip_tags($art['ringkasan'] ?? $art['isi']), 0, 100, "...")); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay += 100;
                endwhile;
                ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-4">
                    <p>Belum ada artikel yang diterbitkan.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4 d-md-none">
            <a href="artikel.php" class="btn btn-outline-primary">Lihat Blog Kami</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>