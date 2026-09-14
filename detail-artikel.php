<?php
require_once __DIR__ . '/config/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $koneksi->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$current_article = $result->fetch_assoc();

if (!$current_article) {
    $fallback_query = $koneksi->query("SELECT * FROM artikel ORDER BY id_artikel ASC LIMIT 1");
    $current_article = $fallback_query->fetch_assoc();
}

if (!$current_article) {
    die("Artikel tidak ditemukan.");
}

$tanggal_formatted = date('d M Y', strtotime($current_article['tanggal']));

// --- FUNGSIONALITAS FORMAT GAMBAR LOKAL & FALLBACK ---
function get_image_url($nama_gambar)
{
    if (empty($nama_gambar)) {
        return 'assets/img/problem.jpg'; // Default jika kosong
    }

    // Jika masih berupa URL luar (Unsplash dll.)
    if (str_starts_with($nama_gambar, 'http')) {
        return $nama_gambar;
    }

    // Cek keberadaan file di assets/img/
    if (file_exists('assets/img/' . $nama_gambar)) {
        return 'assets/img/' . $nama_gambar;
    }

    // Cek keberadaan file di uploads/
    if (file_exists('uploads/' . $nama_gambar)) {
        return 'uploads/' . $nama_gambar;
    }

    // Fallback default jika file fisik lokal tidak ditemukan
    return 'assets/img/problem .jpg';
}

$gambar_src = get_image_url($current_article['gambar']);

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
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($current_article['judul']); ?>
                    </li>
                </ol>
            </nav>
            <a href="artikel.php" class="btn btn-outline-primary btn-sm">&larr; Kembali ke Artikel</a>
        </div>

        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="article-detail-card p-4 p-md-5 rounded-4 border">
                    <span
                        class="badge bg-primary-custom text-white mb-3 px-3 py-2"><?php echo htmlspecialchars($current_article['kategori'] ?? 'Umum'); ?></span>
                    <h1 class="fw-bold mb-4"><?php echo htmlspecialchars($current_article['judul']); ?></h1>

                    <div class="d-flex flex-wrap align-items-center text-muted mb-4 gap-3">
                        <div><i
                                class="fa-solid fa-user me-2 text-accent"></i><?php echo htmlspecialchars($current_article['penulis'] ?? 'Admin'); ?>
                        </div>
                        <div><i class="fa-regular fa-calendar me-2 text-accent"></i><?php echo $tanggal_formatted; ?>
                        </div>
                        <div><i
                                class="fa-regular fa-clock me-2 text-accent"></i><?php echo htmlspecialchars($current_article['waktu_baca'] ?? '3 Menit Baca'); ?>
                        </div>
                    </div>

                    <img src="<?php echo htmlspecialchars($gambar_src); ?>"
                        alt="<?php echo htmlspecialchars($current_article['judul']); ?>"
                        class="img-fluid rounded-4 mb-5 w-100 object-fit-cover"
                        style="max-height: 400px; object-fit: cover;">

                    <div class="article-content">
                        <?php echo $current_article['konten']; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar Artikel Lainnya -->
            <div class="col-lg-4">
                <div class="sidebar-card p-4 rounded-4 border">
                    <h4 class="fw-bold mb-4 border-bottom pb-3">Artikel Lainnya</h4>
                    <div class="d-flex flex-column gap-3">
                        <?php
                        $current_id = $current_article['id_artikel'];
                        $stmt_side = $koneksi->prepare("SELECT * FROM artikel WHERE id_artikel != ? ORDER BY id_artikel DESC LIMIT 5");
                        $stmt_side->bind_param("i", $current_id);
                        $stmt_side->execute();
                        $query_side = $stmt_side->get_result();

                        while ($side_article = $query_side->fetch_assoc()) {
                            $side_tanggal = date('d M Y', strtotime($side_article['tanggal']));
                            $side_img = get_image_url($side_article['gambar']);
                            ?>
                            <a href="detail-artikel.php?id=<?php echo $side_article['id_artikel']; ?>"
                                class="text-decoration-none sidebar-list-item d-flex align-items-center p-2 rounded-3 border">
                                <img src="<?php echo htmlspecialchars($side_img); ?>"
                                    alt="<?php echo htmlspecialchars($side_article['judul']); ?>" class="rounded-3 me-3"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <div>
                                    <span class="badge bg-primary-custom text-white mb-1"
                                        style="font-size: 0.7rem;"><?php echo htmlspecialchars($side_article['kategori'] ?? 'Umum'); ?></span>
                                    <h6 class="fw-bold mb-1 title-text text-dark" style="line-height: 1.4;">
                                        <?php echo htmlspecialchars($side_article['judul']); ?>
                                    </h6>
                                    <small class="text-muted"><i
                                            class="fa-regular fa-calendar me-1"></i><?php echo $side_tanggal; ?></small>
                                </div>
                            </a>
                        <?php }
                        $stmt_side->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>