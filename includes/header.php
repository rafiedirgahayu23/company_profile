<?php
// Function to determine if a nav item is active
function isActive($pageName)
{
    $currentFile = basename($_SERVER['PHP_SELF']);
    return $currentFile === $pageName ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Digital Solusi Nusantara</title>

    <!-- Meta Description for SEO -->
    <meta name="description"
        content="PT Digital Solusi Nusantara - Profesional IT Consulting, Web Development, and Network Solutions.">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&family=Inter:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Page Transition Overlay / Preloader -->
    <div id="page-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="fa-solid fa-layer-group text-accent me-2 fs-3"></i>
                <span>DSN</span>
            </a>
            <button class="navbar-toggler border-0 focus-ring" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-3 text-primary-custom"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('index.php'); ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('profil.php'); ?>" href="profil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('produk.php'); ?>" href="produk.php">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('artikel.php'); ?>" href="artikel.php">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('galeri.php'); ?>" href="galeri.php">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('kontak.php'); ?>" href="kontak.php">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center mt-3 mt-lg-0">
                    <a href="admin/login.php" class="login-btn me-3" aria-label="Login Admin">
                        <i class="fa-solid fa-circle-user"></i>
                    </a>
                    <button id="theme-toggle" class="theme-toggle me-3" aria-label="Toggle Dark Mode">
                        <i id="theme-icon" class="fa-solid fa-moon"></i>
                    </button>
                    <a href="kontak.php" class="btn btn-primary d-none d-lg-block">Konsultasi Gratis</a>
                </div>
            </div>
        </div>
    </nav>