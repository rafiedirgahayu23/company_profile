<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

// Kalau sudah login, langsung lempar ke dashboard, tidak perlu login lagi
if (isset($_SESSION['admin_id'])) {
  header('Location: /company-profile/admin/dashboard.php');
  exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($username === '' || $password === '') {
    $error = 'Username dan password wajib diisi.';
  } else {
    // Ambil data admin berdasarkan username (pakai prepared statement, aman dari SQL Injection)
    $stmt = $koneksi->prepare('SELECT id_admin, username, password, nama_lengkap FROM admin WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();

    if ($admin && password_verify($password, $admin['password'])) {
      // Login berhasil -> simpan data penting ke session
      $_SESSION['admin_id'] = $admin['id_admin'];
      $_SESSION['admin_nama'] = $admin['nama_lengkap'];

      header('Location: /company-profile/admin/dashboard.php');
      exit;
    } else {
      $error = 'Username atau password salah.';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - DSN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700&family=Inter:wght@400;500&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #0A1F44;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background: #fff;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
    }

    .login-box h1 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: #0A1F44;
    }

    .login-box .brand-icon {
      color: #C9A227;
    }

    .btn-login {
      background: #0A1F44;
      color: #fff;
      font-weight: 600;
    }

    .btn-login:hover {
      background: #123C7D;
      color: #fff;
    }
  </style>
</head>

<body>

  <div class="login-box">
    <div class="text-center mb-4">
      <i class="fa-solid fa-layer-group brand-icon fa-2x mb-2"></i>
      <h1>Login Administrator</h1>
      <p class="text-muted small mb-0">PT Digital Solusi Nusantara</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="username" class="form-label fw-medium">Username</label>
        <input type="text" class="form-control" id="username" name="username" required autofocus>
      </div>
      <div class="mb-4">
        <label for="password" class="form-label fw-medium">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-login w-100 py-2">
        <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk
      </button>
    </form>

    <div class="text-center mt-4">
      <a href="/company-profile/index.php" class="text-muted small text-decoration-none">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Website
      </a>
    </div>
  </div>

</body>

</html>