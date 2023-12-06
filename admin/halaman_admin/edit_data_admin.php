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
$id = $nama = $jenis_kelamin = $username = $password = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM admin WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
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
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data pengguna
    $updateQuery = "UPDATE admin SET 
        nama = '$nama',  
        jenis_kelamin = '$jenis_kelamin', 
        username = '$username', 
        password = '$password' 
        WHERE id = $id";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("Location: admin.php"); // Redirect ke halaman data user setelah mengedit.
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Admin</title>
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
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h1>Edit Data Admin</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required value="<?php echo $nama; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required value="<?php echo $username; ?>" required>
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
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="Laki-Laki" <?php if ($jenis_kelamin == "Laki-Laki") echo "selected"; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected"; ?>>Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    <a class="btn btn-danger" href="admin.php">Batal</a>
                </form>
            </div>
        </div>
    </div>

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
