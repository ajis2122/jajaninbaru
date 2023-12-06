<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hapus sesi dari server
session_destroy();

// Redirect ke halaman utama atau halaman login
header('Location: index.php'); // Gantilah index.php dengan halaman tujuan setelah logout
exit();
?>
