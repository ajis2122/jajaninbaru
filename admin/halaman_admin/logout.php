<?php
session_start();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
header("Location: ../../index.php");
exit;
?>