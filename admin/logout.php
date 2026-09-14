<?php
/**
 * Logout Admin
 * Menghapus seluruh data session lalu mengarahkan kembali ke halaman login.
 */
session_start();
session_unset();
session_destroy();

header('Location: /company-profile/admin/login.php');
exit;
