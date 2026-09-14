<?php
include 'config/koneksi.php';
include 'includes/header.php';

// Ambil data profil dari database
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);
?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Profil Perusahaan</h1>
        <p class="lead mb-0">Mengenal lebih dekat perjalanan, visi, dan nilai-nilai PT Digital Solusi Nusantara.</p>
    </div>
</section>

<!-- Sejarah Section -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <img src="assets/img/sejarahsingkat.jpg" alt="Tim DSN" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <div class="section-title">
                    <span class="subtitle">Sejarah Singkat</span>
                    <h2 class="fw-bold mb-4">Berawal dari Visi untuk Mendigitalisasi Indonesia</h2>
                </div>
                <div>
                    <?= nl2br(htmlspecialchars($profil['sejarah'] ?? '')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi Section -->
<section class="section-padding bg-soft" id="visi-misi">
    <div class="container">
        <div class="text-center section-title mb-5" data-aos="fade-up">
            <span class="subtitle">Arah Perjalanan Kami</span>
            <h2 class="fw-bold">Visi & Misi</h2>
        </div>
        <div class="row g-4">
            <!-- Visi -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom h-100 p-4 p-md-5">
                    <div class="icon-box mb-4">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-4">Visi Kami</h3>
                    <p class="fs-5 lh-base">
                        <?= htmlspecialchars($profil['visi'] ?? ''); ?>
                    </p>
                </div>
            </div>
            <!-- Misi -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom h-100 p-4 p-md-5">
                    <div class="icon-box mb-4">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="fw-bold mb-4">Misi Kami</h3>
                    <ul class="list-unstyled mb-0">
                        <?php
                        if (!empty($profil['misi'])) {
                            // Pecah string misi berdasarkan baris baru
                            $misi_items = explode("\n", str_replace("\r", "", $profil['misi']));
                            foreach ($misi_items as $item) {
                                // Bersihkan penomoran (misal: "1. ", "2. ") jika ada
                                $item_clean = preg_replace('/^\d+\.\s*/', '', trim($item));
                                if (!empty($item_clean)) {
                                    ?>
                                    <li class="d-flex mb-3">
                                        <i class="fa-solid fa-check text-accent mt-1 me-3"></i>
                                        <span><?= htmlspecialchars($item_clean); ?></span>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center section-title mb-5" data-aos="fade-up">
            <span class="subtitle">Budaya Kerja Kami</span>
            <h2 class="fw-bold">Nilai-Nilai Perusahaan</h2>
        </div>
        <div class="row mt-5 justify-content-center">
            <?php
            if (!empty($profil['nilai_perusahaan'])) {
                // Ikon bawaan untuk card nilai perusahaan
                $icons = [
                    'fa-lightbulb',
                    'fa-shield-halved',
                    'fa-handshake-angle',
                    'fa-medal',
                    'fa-chart-line',
                    'fa-users'
                ];

                $nilai_items = explode("\n", str_replace("\r", "", $profil['nilai_perusahaan']));
                $index = 0;

                foreach ($nilai_items as $item) {
                    $item_clean = trim($item);
                    if (empty($item_clean))
                        continue;

                    // Pemisahan Judul: Deskripsi jika menggunakan format titik dua
                    $parts = explode(':', $item_clean, 2);
                    $judul = trim($parts[0]);
                    $deskripsi = isset($parts[1]) ? trim($parts[1]) : '';

                    $icon = $icons[$index % count($icons)];
                    $delay = 100 + ($index * 100);
                    ?>
                    <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                        <div class="text-center">
                            <div class="icon-box mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                                <i class="fa-solid <?= $icon; ?>"></i>
                            </div>
                            <h4 class="fw-bold"><?= htmlspecialchars($judul); ?></h4>
                            <?php if ($deskripsi): ?>
                                <p class="small text-muted"><?= htmlspecialchars($deskripsi); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $index++;
                }
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>