<?php

// Mulai sesi (pastikan ini ada di awal halaman)
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika tidak, redirect ke halaman login
    header("Location: ../loginadmin.php");
    exit();
}

include 'koneksiuser.php';

// Inisialisasi variabel
$id = $nama = $tempat_lahir = $tanggal_lahir = $no_telepon = $jenis_kelamin = $alamat = $username = $password = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $nama = $data['nama'];
        $tempat_lahir = $data['tempat_lahir'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $no_telepon = $data['no_telepon'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $username = $data['username'];
        $password = $data['password'];
    } else {
        echo "Query Error: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Parameter ID tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    // Ambil data yang diisi dalam form
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data pengguna
    $updateQuery = "UPDATE user SET 
        nama = '$nama', 
        tempat_lahir = '$tempat_lahir', 
        tanggal_lahir = '$tanggal_lahir', 
        no_telepon = '$no_telepon', 
        jenis_kelamin = '$jenis_kelamin', 
        alamat = '$alamat', 
        username = '$username', 
        password = '$password' 
        WHERE id = $id";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("Location: data_user.php"); // Redirect ke halaman data user setelah mengedit.
        exit;
    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        .input-group-text {
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .input-group-text:hover {
            color: dodgerblue;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Edit Data User</h1>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No. Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo $no_telepon; ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki_laki" value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'checked'; ?> required>
                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'checked'; ?> required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="4" required><?php echo $alamat; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" placeholder="Masukkan Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="showPassword" data-toggle="tooltip" data-placement="top" title="Tampilkan Password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                <a class="btn btn-danger" href="data_user.php">Batal</a>
            </form>
        </div>
    </div>
</div>
value="<?php echo $password; ?>"
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tambahkan inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Script untuk menangani tampilan atau penyembunyian password
            var showPassword = document.getElementById("showPassword");
            var passwordInput = document.getElementById("password");

            showPassword.addEventListener("click", function () {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });
        });
    </script>
</body>
</html>
