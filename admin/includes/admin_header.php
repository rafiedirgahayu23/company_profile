<?php
/**
 * Layout Header + Sidebar Admin
 * Include file ini setelah cek_login.php dan setelah query data yang dibutuhkan.
 * Variabel $page_title (opsional) dan $active_menu wajib diisi sebelum include ini,
 * untuk menentukan judul halaman dan menu sidebar mana yang sedang aktif.
 */
if (!isset($page_title)) {
    $page_title = 'Dashboard';
}
if (!isset($active_menu)) {
    $active_menu = '';
}

// Path dasar ke folder admin, dipakai untuk link menu & asset
// supaya tetap benar walau file ini di-include dari admin/produk/, admin/artikel/, dll.
$base_admin = '/company-profile/admin';
$base_asset = '/company-profile/assets';
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?> - Admin DSN</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --color-bg: #F7F8FA;
    --color-primary: #0A1F44;
    --color-primary-light: #123C7D;
    --color-accent: #C9A227;
    --color-text: #1F2937;
  }
  body {
    font-family: 'Inter', sans-serif;
    background: var(--color-bg);
    color: var(--color-text);
  }
  h1, h2, h3, h4, h5, .brand-text { font-family: 'Plus Jakarta Sans', sans-serif; }

  /* Sidebar */
  .admin-sidebar {
    width: 260px;
    min-height: 100vh;
    background: var(--color-primary);
    position: fixed;
    top: 0; left: 0;
    padding: 24px 0;
  }
  .admin-sidebar .brand-text {
    color: #fff;
    font-weight: 700;
    font-size: 20px;
    padding: 0 24px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 16px;
  }
  .admin-sidebar .brand-text i { color: var(--color-accent); }
  .admin-sidebar .nav-link {
    color: rgba(255,255,255,0.75);
    padding: 12px 24px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
    border-left: 3px solid transparent;
    transition: 0.2s ease;
  }
  .admin-sidebar .nav-link:hover {
    background: rgba(255,255,255,0.06);
    color: #fff;
  }
  .admin-sidebar .nav-link.active {
    background: rgba(201,162,39,0.12);
    color: var(--color-accent);
    border-left-color: var(--color-accent);
  }
  .admin-sidebar .nav-link i { width: 20px; text-align: center; }

  /* Main content */
  .admin-main {
    margin-left: 260px;
    padding: 32px;
  }
  .admin-topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
  }
  .admin-card {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
  }

  @media (max-width: 768px) {
    .admin-sidebar { width: 100%; position: relative; min-height: auto; }
    .admin-main { margin-left: 0; padding: 20px; }
  }
</style>
</head>
<body>

<div class="admin-sidebar">
  <div class="brand-text"><i class="fa-solid fa-layer-group"></i> DSN Admin</div>
  <nav class="nav flex-column">
    <a href="<?= $base_admin ?>/dashboard.php" class="nav-link <?= $active_menu === 'dashboard' ? 'active' : '' ?>">
      <i class="fa-solid fa-gauge"></i> Dashboard
    </a>
    <a href="<?= $base_admin ?>/profil/edit.php" class="nav-link <?= $active_menu === 'profil' ? 'active' : '' ?>">
      <i class="fa-solid fa-building"></i> Profil Perusahaan
    </a>
    <a href="<?= $base_admin ?>/produk/index.php" class="nav-link <?= $active_menu === 'produk' ? 'active' : '' ?>">
      <i class="fa-solid fa-box"></i> Produk / Layanan
    </a>
    <a href="<?= $base_admin ?>/artikel/index.php" class="nav-link <?= $active_menu === 'artikel' ? 'active' : '' ?>">
      <i class="fa-solid fa-newspaper"></i> Artikel
    </a>
    <a href="<?= $base_admin ?>/galeri/index.php" class="nav-link <?= $active_menu === 'galeri' ? 'active' : '' ?>">
      <i class="fa-solid fa-images"></i> Galeri
    </a>
    <a href="<?= $base_admin ?>/logout.php" class="nav-link" onclick="return confirm('Yakin ingin logout?');">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </nav>
</div>

<div class="admin-main">
  <div class="admin-topbar">
    <h4 class="fw-bold mb-0"><?= htmlspecialchars($page_title) ?></h4>
    <div class="text-muted">
      <i class="fa-regular fa-user me-1"></i>
      <?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator') ?>
    </div>
  </div>
