<?php include 'includes/header.php'; ?>
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

            <!-- LOOP PRODUK DI SINI -->

            <!-- Contoh Tampilan Card Produk (Untuk Dihapus/Ditimpa saat integrasi PHP) -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Web App" class="card-img-top img-cover" style="height: 200px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="icon-box mb-3" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Custom Web Application</h4>
                        <p class="text-muted small mb-4 flex-grow-1">Pengembangan aplikasi berbasis web yang disesuaikan
                            dengan alur bisnis internal perusahaan, lengkap dengan sistem manajemen data yang aman.</p>
                        <a href="detail-layanan.php?id=1" class="btn btn-outline-primary w-100 mt-auto">Lihat Detail Layanan</a>
                    </div>
                </div>
            </div>
            <!-- Contoh Tampilan Card Produk 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Network" class="card-img-top img-cover" style="height: 200px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="icon-box mb-3" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fa-solid fa-server"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Enterprise Networking</h4>
                        <p class="text-muted small mb-4 flex-grow-1">Perancangan dan implementasi topologi jaringan
                            skala enterprise, instalasi server, dan sistem keamanan firewall.</p>
                        <a href="detail-layanan.php?id=2" class="btn btn-outline-primary w-100 mt-auto">Lihat Detail Layanan</a>
                    </div>
                </div>
            </div>
            <!-- Contoh Tampilan Card Produk 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Consulting" class="card-img-top img-cover" style="height: 200px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="icon-box mb-3" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h4 class="fw-bold mb-3">IT Audit & Consulting</h4>
                        <p class="text-muted small mb-4 flex-grow-1">Audit sistem keamanan informasi, konsultasi migrasi
                            cloud, dan penyusunan master plan teknologi informasi.</p>
                        <a href="detail-layanan.php?id=3" class="btn btn-outline-primary w-100 mt-auto">Lihat Detail Layanan</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>