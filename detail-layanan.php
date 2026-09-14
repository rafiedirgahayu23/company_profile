<?php
$services = [
    1 => [
        'nama' => 'Custom Web Application',
        'icon' => 'fa-solid fa-laptop-code',
        'gambar' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'deskripsi' => 'Pengembangan aplikasi berbasis web yang disesuaikan dengan alur bisnis internal perusahaan, lengkap dengan sistem manajemen data yang aman.',
        'paragraf' => [
            'Kami memahami bahwa setiap bisnis memiliki keunikan dan alur kerja yang berbeda. Oleh karena itu, solusi off-the-shelf seringkali tidak cukup untuk memenuhi kebutuhan spesifik perusahaan Anda. Layanan Custom Web Application kami dirancang untuk membangun sistem dari nol yang 100% selaras dengan proses bisnis Anda.',
            'Dengan menggunakan teknologi modern dan best practices dalam software engineering, tim kami mengembangkan aplikasi web yang cepat, responsif, dan mudah digunakan. Mulai dari sistem ERP kustom, portal CRM, hingga dashboard analitik kompleks, kami memastikan setiap fitur berfungsi secara optimal.',
            'Keamanan dan skalabilitas adalah prioritas utama kami. Setiap aplikasi yang kami bangun melewati proses pengujian keamanan yang ketat dan dirancang dengan arsitektur yang memungkinkan pertumbuhan di masa depan tanpa harus merombak sistem secara keseluruhan.'
        ],
        'fitur' => [
            'Modern Tech Stack (Laravel/React)',
            'Responsive UI & UX Design',
            'REST API Integration',
            'High Security Standard'
        ]
    ],
    2 => [
        'nama' => 'Enterprise Networking',
        'icon' => 'fa-solid fa-server',
        'gambar' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'deskripsi' => 'Perancangan dan implementasi topologi jaringan skala enterprise, instalasi server, dan sistem keamanan firewall.',
        'paragraf' => [
            'Infrastruktur jaringan yang andal adalah tulang punggung dari setiap operasional bisnis modern. Layanan Enterprise Networking kami berfokus pada penyediaan fondasi yang kuat, cepat, dan aman agar seluruh tim Anda dapat bekerja tanpa hambatan konektivitas.',
            'Kami memulai dengan tahap audit dan desain topologi, memastikan bahwa arsitektur jaringan yang dirancang dapat menangani beban kerja tinggi serta mengantisipasi kebutuhan ekspansi di masa depan. Tim teknisi ahli kami kemudian melakukan instalasi dan konfigurasi perangkat keras standar enterprise.',
            'Tidak hanya instalasi, kami juga menyediakan dukungan purna jual dan pemantauan terus-menerus. Dengan perlindungan firewall tingkat lanjut dan load balancing cerdas, kami meminimalkan risiko downtime dan serangan siber pada jaringan internal Anda.'
        ],
        'fitur' => [
            'Network Topology Design',
            'Server & Firewall Installation',
            'Load Balancing & Failover',
            '24/7 Monitoring & Support'
        ]
    ],
    3 => [
        'nama' => 'IT Audit & Consulting',
        'icon' => 'fa-solid fa-chart-line',
        'gambar' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'deskripsi' => 'Audit sistem keamanan informasi, konsultasi migrasi cloud, dan penyusunan master plan teknologi informasi.',
        'paragraf' => [
            'Dalam dunia yang terus berubah dengan cepat, memiliki strategi teknologi informasi yang selaras dengan tujuan bisnis adalah sebuah keharusan. Layanan IT Audit & Consulting kami hadir untuk memberikan wawasan objektif mengenai status kesiapan teknologi organisasi Anda saat ini.',
            'Proses audit kami menyelidiki setiap lapisan sistem Anda—mulai dari keamanan infrastruktur fisik, kepatuhan perangkat lunak, hingga kerentanan pada perlindungan data. Kami menyajikan laporan komprehensif yang tidak hanya menyoroti kelemahan, tetapi juga rekomendasi tindakan korektif yang terukur.',
            'Bagi perusahaan yang berencana bertransisi ke era digital, konsultan kami siap menyusun IT Roadmap jangka panjang. Baik itu migrasi ke infrastruktur cloud atau implementasi kebijakan keamanan informasi terbaru, kami memandu Anda di setiap langkah transisi tersebut.'
        ],
        'fitur' => [
            'Security Risk Assessment',
            'Infrastructure Optimization',
            'Cloud Migration Strategy',
            'IT Roadmap & Compliance'
        ]
    ]
];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
if (!array_key_exists($id, $services)) {
    $id = 1;
}
$current_service = $services[$id];

include 'includes/header.php';
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
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $current_service['nama']; ?></li>
                </ol>
            </nav>
            <a href="produk.php" class="btn btn-outline-primary btn-sm">&larr; Kembali ke Layanan</a>
        </div>

        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="service-detail-card p-4 p-md-5 rounded-4 border">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3 mb-0" style="width: 60px; height: 60px; font-size: 24px;">
                            <i class="<?php echo $current_service['icon']; ?>"></i>
                        </div>
                        <h1 class="fw-bold mb-0"><?php echo $current_service['nama']; ?></h1>
                    </div>

                    <img src="<?php echo $current_service['gambar']; ?>" alt="<?php echo $current_service['nama']; ?>"
                        class="img-fluid rounded-4 mb-4 w-100 shadow-sm" style="max-height: 400px; object-fit: cover;">

                    <div class="article-content mb-5">
                        <?php foreach ($current_service['paragraf'] as $p): ?>
                            <p><?php echo $p; ?></p>
                        <?php endforeach; ?>
                    </div>

                    <h4 class="fw-bold mb-3">Fitur Utama Layanan</h4>
                    <ul class="list-unstyled mb-5">
                        <?php foreach ($current_service['fitur'] as $fitur): ?>
                            <li class="d-flex align-items-start mb-3 service-checklist">
                                <i class="fa-solid fa-circle-check text-primary-custom mt-1 me-3 fs-5 checklist-icon"></i>
                                <span class="fs-6"><?php echo $fitur; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- CTA Banner -->
                    <div class="bg-soft p-4 rounded-4 text-center border">
                        <h4 class="fw-bold mb-3">Tertarik menggunakan layanan ini?</h4>
                        <p class="text-muted mb-4">Tim konsultan kami siap memberikan solusi terbaik sesuai kebutuhan
                            bisnis Anda.</p>
                        <a href="kontak.php" class="btn btn-primary btn-lg">Konsultasi Gratis Sekarang <i
                                class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="service-sidebar-card p-4 rounded-4 border mb-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Layanan Lainnya</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php
                        foreach ($services as $other_id => $service) {
                            if ($other_id == $id)
                                continue;
                            ?>
                            <a href="detail-layanan.php?id=<?php echo $other_id; ?>"
                                class="text-decoration-none sidebar-list-item d-flex align-items-center p-3 rounded-3 border">
                                <div class="icon-box flex-shrink-0 me-3 mb-0"
                                    style="width: 45px; height: 45px; font-size: 18px;">
                                    <i class="<?php echo $service['icon']; ?>"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 title-text text-dark" style="line-height: 1.4;">
                                        <?php echo $service['nama']; ?>
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