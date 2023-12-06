<?php
// Mulai sesi (pastikan ini ada di awal halaman)
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika tidak, redirect ke halaman login
    header("Location: ../loginadmin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .card {
            margin-top: 20px;
        }

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
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Tambah Data Admin</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
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
                            <option value=""></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary btn-block">Tambah</button>
                    <a class="btn btn-danger btn-block" href="admin.php">Batal</a>
                </form>
                <?php
                include 'koneksiuser.php';
                if (isset($_POST['simpan'])) {
                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                    $insert = mysqli_query($conn, "INSERT INTO admin (nama, username, password, jenis_kelamin) VALUES 
                        ('$nama', '$username', '$password', '$jenis_kelamin')");
                    if ($insert) {
                        echo "<meta http-equiv=refresh content=0;URL='admin.php'>";
                    } else {
                        echo 'Gagal menyimpan data: ' . mysqli_error($conn);
                    }
                }
                ?>
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
