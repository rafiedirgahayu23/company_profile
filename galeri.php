<?php include 'includes/header.php'; ?>
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

            <!-- LOOP GALERI DI SINI -->
            <!-- Contoh Galeri 1 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Team Meeting" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Sesi Diskusi Tim</h6>
                    </div>
                </div>
            </div>
            <!-- Contoh Galeri 2 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=800&q=80"
                        alt="Coding Session" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Proses Development</h6>
                    </div>
                </div>
            </div>
            <!-- Contoh Galeri 3 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Presentasi Klien" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Presentasi Klien</h6>
                    </div>
                </div>
            </div>
            <!-- Contoh Galeri 4 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=800&q=80"
                        alt="Server Room" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Instalasi Server</h6>
                    </div>
                </div>
            </div>

            <!-- Contoh Galeri 5 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1556745757-8d76bdb6984b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Dukungan Pelanggan" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Dukungan Pelanggan</h6>
                    </div>
                </div>
            </div>
            <!-- Contoh Galeri 6 -->
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-item position-relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Workshop" class="img-fluid gallery-img w-100">
                    <div class="gallery-caption p-3">
                        <h6 class="fw-bold mb-0">Workshop Internal</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Masonry + imagesLoaded: layout dihitung ulang setelah SEMUA gambar selesai dimuat -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script>
(function () {
    var grid = document.getElementById('gallery-masonry');
    if (!grid) return;
    imagesLoaded(grid, function () {
        new Masonry(grid, {
            itemSelector: '.col-sm-6',
            columnWidth:  '.col-sm-6',
            percentPosition: true,
            gutter: 0
        });
    });
})();
</script>
<?php include 'includes/footer.php'; ?>