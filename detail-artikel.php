<?php
$articles = [
    1 => [
        'kategori' => 'Keamanan',
        'judul' => 'Pentingnya Keamanan Cyber di Era Digital Saat Ini',
        'tanggal' => '10 Sep 2026',
        'gambar' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'penulis' => 'Admin DSN',
        'waktu_baca' => '5 Menit Baca',
        'konten' => '<p>Di era digital yang serba terhubung ini, keamanan cyber bukan lagi menjadi prioritas sekunder bagi perusahaan, melainkan kebutuhan mendesak yang harus segera diimplementasikan. Banyak organisasi menyadari pentingnya melindungi aset data mereka hanya setelah mengalami insiden peretasan yang merugikan baik secara finansial maupun reputasi.</p>
                     <h2>Ancaman Siber yang Semakin Canggih</h2>
                     <p>Seiring berkembangnya teknologi, metode yang digunakan oleh peretas juga semakin canggih. Mulai dari serangan ransomware, phishing yang lebih terarah, hingga eksploitasi celah keamanan zero-day. Oleh karena itu, perusahaan dituntut untuk selalu proaktif dalam mengidentifikasi kerentanan pada sistem mereka.</p>
                     <blockquote>"Keamanan siber adalah sebuah perjalanan, bukan tujuan. Anda harus terus beradaptasi dengan ancaman baru setiap harinya."</blockquote>
                     <p>Melindungi bisnis tidak cukup hanya dengan mengandalkan perangkat lunak anti-virus. Diperlukan pendekatan holistik yang mencakup keamanan jaringan, perlindungan endpoint, manajemen akses identitas, serta pelatihan kesadaran keamanan siber bagi seluruh karyawan.</p>'
    ],
    2 => [
        'kategori' => 'Web Dev',
        'judul' => 'Optimasi Performa Website untuk Meningkatkan Konversi',
        'tanggal' => '05 Sep 2026',
        'gambar' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'penulis' => 'Tim Developer DSN',
        'waktu_baca' => '4 Menit Baca',
        'konten' => '<p>Kecepatan loading sebuah website memiliki korelasi langsung terhadap tingkat konversi pengguna. Pengunjung cenderung meninggalkan halaman jika waktu tunggu melebihi 3 detik. Hal ini tentunya berdampak buruk pada tingkat pentalan (bounce rate) dan potensi penjualan.</p>
                     <h2>Strategi Optimasi yang Terbukti</h2>
                     <p>Banyak teknik yang dapat dilakukan untuk mengoptimalkan performa web, seperti melakukan kompresi gambar, memanfaatkan caching browser, serta meminimalkan ukuran file CSS dan JavaScript. Selain itu, penggunaan Content Delivery Network (CDN) dapat membantu mendistribusikan aset secara global sehingga pengguna dapat mengakses data dari server terdekat.</p>
                     <blockquote>"Setiap detik keterlambatan loading dapat menurunkan tingkat konversi hingga 7%."</blockquote>
                     <p>Penting bagi perusahaan untuk melakukan audit performa website secara berkala. Dengan memastikan pengalaman pengguna yang mulus dan responsif, Anda tidak hanya meningkatkan konversi tetapi juga peringkat SEO website di mesin pencari.</p>'
    ],
    3 => [
        'kategori' => 'Cloud',
        'judul' => 'Mengenal Manfaat Cloud Computing bagi Bisnis UMKM',
        'tanggal' => '28 Aug 2026',
        'gambar' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'penulis' => 'Consultant DSN',
        'waktu_baca' => '6 Menit Baca',
        'konten' => '<p>Cloud computing telah merevolusi cara bisnis beroperasi, memberikan akses ke sumber daya komputasi tingkat enterprise bahkan bagi bisnis berskala UMKM. Dengan model berbasis langganan (pay-as-you-go), perusahaan dapat menghindari biaya investasi awal yang besar untuk infrastruktur server fisik.</p>
                     <h2>Fleksibilitas dan Skalabilitas Tanpa Batas</h2>
                     <p>Salah satu keuntungan utama dari komputasi awan adalah skalabilitas. Ketika bisnis Anda mengalami lonjakan trafik atau membutuhkan kapasitas penyimpanan tambahan, Anda dapat dengan mudah menyesuaikan sumber daya secara instan tanpa perlu membeli perangkat keras baru.</p>
                     <blockquote>"Cloud bukan hanya tentang tempat penyimpanan, melainkan katalisator inovasi yang memungkinkan bisnis berkembang tanpa hambatan infrastruktur fisik."</blockquote>
                     <p>Selain itu, sistem berbasis cloud juga meningkatkan kolaborasi tim, memungkinkan karyawan untuk mengakses data dan bekerja dari mana saja, kapan saja, selama terhubung ke internet. Inilah mengapa adopsi cloud computing semakin meningkat di berbagai sektor industri.</p>'
    ]
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
if (!array_key_exists($id, $articles)) {
    $id = 1;
}
$current_article = $articles[$id];

include 'includes/header.php';
?>
<!-- Page Header -->
<section class="page-header text-center">
    <div class="page-header-shape"></div>
    <div class="container position-relative z-1">
        <h1 class="display-5 fw-bold mb-3">Detail Artikel</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <!-- Breadcrumb & Back button -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="artikel.php">Artikel</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $current_article['judul']; ?></li>
                </ol>
            </nav>
            <a href="artikel.php" class="btn btn-outline-primary btn-sm">&larr; Kembali ke Artikel</a>
        </div>

        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="article-detail-card p-4 p-md-5 rounded-4 border">
                    <span class="badge bg-primary-custom text-white mb-3 px-3 py-2"><?php echo $current_article['kategori']; ?></span>
                    <h1 class="fw-bold mb-4"><?php echo $current_article['judul']; ?></h1>
                    
                    <div class="d-flex flex-wrap align-items-center text-muted mb-4 gap-3">
                        <div><i class="fa-solid fa-user me-2 text-accent"></i><?php echo $current_article['penulis']; ?></div>
                        <div><i class="fa-regular fa-calendar me-2 text-accent"></i><?php echo $current_article['tanggal']; ?></div>
                        <div><i class="fa-regular fa-clock me-2 text-accent"></i><?php echo $current_article['waktu_baca']; ?></div>
                    </div>

                    <img src="<?php echo $current_article['gambar']; ?>" alt="<?php echo $current_article['judul']; ?>" class="img-fluid rounded-4 mb-5 w-100 object-fit-cover" style="max-height: 400px; object-fit: cover;">

                    <div class="article-content">
                        <?php echo $current_article['konten']; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-card p-4 rounded-4 border">
                    <h4 class="fw-bold mb-4 border-bottom pb-3">Artikel Lainnya</h4>
                    <div class="d-flex flex-column gap-3">
                        <?php 
                        foreach($articles as $other_id => $article) {
                            if ($other_id == $id) continue;
                        ?>
                        <a href="detail-artikel.php?id=<?php echo $other_id; ?>" class="text-decoration-none sidebar-list-item d-flex align-items-center p-2 rounded-3 border">
                            <img src="<?php echo $article['gambar']; ?>" alt="<?php echo $article['judul']; ?>" class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <span class="badge bg-primary-custom text-white mb-1" style="font-size: 0.7rem;"><?php echo $article['kategori']; ?></span>
                                <h6 class="fw-bold mb-1 title-text text-dark" style="line-height: 1.4;"><?php echo $article['judul']; ?></h6>
                                <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i><?php echo $article['tanggal']; ?></small>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
