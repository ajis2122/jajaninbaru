<?php
include 'koneksiuser.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Buat perintah SQL DELETE
    $sql = "DELETE FROM admin WHERE id = $id";

    // Jalankan perintah SQL DELETE
    if (mysqli_query($conn, $sql)) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman data_user.php
        header("Location: admin.php");
        exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan pengguna
    } else {
        echo "error: " . mysqli_error($conn);
    }
} else {
    echo "error: Parameter id tidak ditemukan";
}
?>