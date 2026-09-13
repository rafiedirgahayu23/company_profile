<?php include 'includes/header.php'; ?>
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

            <!-- LOOP ARTIKEL DI SINI -->
            <!-- Contoh Card Artikel 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Cyber Security" class="card-img-top img-cover" style="height: 220px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-custom text-white me-2">Keamanan</span>
                            <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> 10 Sep 2026</small>
                        </div>
                        <h5 class="fw-bold mb-3"><a href="#" class="text-primary-custom">Pentingnya Keamanan Cyber di
                                Era Digital Saat Ini</a></h5>
                        <p class="text-muted small mb-4 flex-grow-1">Memahami ancaman siber terbaru dan bagaimana
                            perusahaan dapat melindungi data sensitif mereka dari serangan peretas.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <!-- Contoh Card Artikel 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Web Performance" class="card-img-top img-cover" style="height: 220px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-custom text-white me-2">Web Dev</span>
                            <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> 05 Sep 2026</small>
                        </div>
                        <h5 class="fw-bold mb-3"><a href="#" class="text-primary-custom">Optimasi Performa Website untuk
                                Meningkatkan Konversi</a></h5>
                        <p class="text-muted small mb-4 flex-grow-1">Kecepatan loading website adalah kunci. Pelajari
                            teknik optimasi yang terbukti berhasil meningkatkan interaksi pengguna.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <!-- Contoh Card Artikel 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-custom h-100 p-0 border-0 shadow-sm d-flex flex-column">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Cloud Computing" class="card-img-top img-cover" style="height: 220px;">
                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary-custom text-white me-2">Cloud</span>
                            <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> 28 Aug 2026</small>
                        </div>
                        <h5 class="fw-bold mb-3"><a href="#" class="text-primary-custom">Mengenal Manfaat Cloud
                                Computing bagi Bisnis UMKM</a></h5>
                        <p class="text-muted small mb-4 flex-grow-1">Bagaimana teknologi cloud dapat menghemat biaya
                            infrastruktur fisik dan meningkatkan efisiensi operasional.</p>
                        <a href="#" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination Placeholder -->
        <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                    <ul class="pagination border-0">
                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><i
                                    class="fa-solid fa-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><i
                                    class="fa-solid fa-chevron-right"></i></a></li>
                    </ul>
            </nav>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>