<?php
include('koneksi.php');

    if (isset($_POST["daftar"])) {
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $no_telepon = $_POST['no_telepon'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "INSERT INTO user (nama, tempat_lahir, tanggal_lahir, no_telepon, jenis_kelamin, alamat, username, password)  
        VALUES('$nama', '$tempat_lahir', '$tanggal_lahir', '$no_telepon', '$jenis_kelamin', '$alamat', '$username', '$password')";
            $result = mysqli_query($koneksi, $query);
    
            if(!$result) {
                die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
            } else {
                 echo "<script>alert('Data berhasil ditambahkan!');document.location.href = 'loginuser.php';</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-image: url('img/4.png');
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        /* Gambar hanya terlihat pada perangkat web/laptop */
        @media (max-width: 767px) {
            .hidden-on-mobile {
                display: none;
            }
        }
        .img-center {
            display: block;
            margin: 0 auto;
            margin-top: 150px; /* Sesuaikan dengan jarak ke bawah yang Anda inginkan */
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
    <div class="row">
        <!-- Gambar hanya terlihat pada perangkat web/laptop -->
        <div class="col-md-6 hidden-on-mobile">
            <img src="img/logo_jajanin.png" alt="Gambar" class="img-fluid img-center">
        </div>
        <div class="col-md-6">
            <h2 class="text-center mb-4">Daftar User</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir"  required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"  required>
                </div>
                <div class="form-group">
                    <label for="nama">No.Telepon</label>
                    <input type="text" class="form-control" name="no.telepon" id="nama" placeholder="Masukan No.Telepon"  required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" required>
                        <option value=""></option>
                        <option value="laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan Alamat"  required></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
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
                <button type="submit" class="btn btn-primary btn-block" name="daftar">Daftar</button>
                <a class="btn btn-danger btn-block" href="index.php">Batal</a>
                <p class="text-center mt-3">Apakah sudah mempunyai akun? <a href="loginuser.php">Klik disini</a></p>
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
