<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Hubungi Kami</h1>
        <p class="lead mb-0">Jangan ragu untuk menghubungi kami. Kami siap membantu setiap kebutuhan teknologi Anda.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="section-title mb-4">
                    <span class="subtitle">Informasi Kontak</span>
                    <h2 class="fw-bold">Mari Berkolaborasi!</h2>
                </div>
                <p class="mb-5">Tim kami selalu sedia menjawab pertanyaan Anda. Isi form di samping atau hubungi kami
                    langsung melalui informasi di bawah ini.</p>

                <div class="card-custom card-contact mb-4 p-4 d-flex flex-row align-items-center">
                    <div class="icon-box mb-0 me-4" style="min-width: 60px;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Alamat Kantor</h5>
                        <p class="text-muted mb-0">Jl. Teknologi Inovasi No. 88,<br>Jakarta Selatan, DKI Jakarta 12345
                        </p>
                    </div>
                </div>

                <div class="card-custom card-contact mb-4 p-4 d-flex flex-row align-items-center">
                    <div class="icon-box mb-0 me-4" style="min-width: 60px;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Telepon</h5>
                        <p class="text-muted mb-0">+62 21 1234 5678</p>
                    </div>
                </div>

                <div class="card-custom card-contact p-4 d-flex flex-row align-items-center">
                    <div class="icon-box mb-0 me-4" style="min-width: 60px;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Email</h5>
                        <p class="text-muted mb-0">info@dsn.co.id</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="card-custom p-4 p-md-5 h-100">
                    <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                    <form action="#" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg bg-soft border-0" id="nama"
                                    placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">Alamat Email</label>
                                <input type="email" class="form-control form-control-lg bg-soft border-0" id="email"
                                    placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="col-12">
                                <label for="subjek" class="form-label fw-medium">Subjek</label>
                                <input type="text" class="form-control form-control-lg bg-soft border-0" id="subjek"
                                    placeholder="Subjek pesan" required>
                            </div>
                            <div class="col-12">
                                <label for="pesan" class="form-label fw-medium">Pesan</label>
                                <textarea class="form-control form-control-lg bg-soft border-0" id="pesan" rows="5"
                                    placeholder="Tuliskan pesan Anda di sini" required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Kirim Pesan <i
                                        class="fa-solid fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Maps -->
<section class="pb-5 mb-4" data-aos="fade-up">
    <div class="container">
        <div class="map-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24056262424!2d106.75936881519782!3d-6.229740131460395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1709230588145!5m2!1sid!2sid"
                width="100%" height="420" style="border:0; filter: grayscale(40%); display:block;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>