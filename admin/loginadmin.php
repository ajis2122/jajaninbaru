<?php
session_start();
require '../koneksi.php';

$username = "";
$errorMessage = "";

if (isset($_POST['log_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($koneksi, "SELECT username, password FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($login);
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        
        // Set status login
        $_SESSION['logged_in'] = true;

        echo "<meta http-equiv=refresh content=0;URL='halaman_admin/index.php'>";
    } else {
        $errorMessage = "Username atau Password salah!";
    }
}

// Tambahkan pengecekan sesi sebelum menampilkan halaman
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    // Redirect ke halaman admin jika sudah login
    header("Location: halaman_admin/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-image: url('../img/4.png'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .input-group-text {
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .input-group-text:hover {
            color: dodgerblue;
        }

        /* Tambahkan gaya untuk pesan kesalahan */
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-container">
                <h2 class="text-center mb-4">Login Admin</h2>
                    <!-- Tampilkan pesan kesalahan di sini -->
                    <p class="error-message"><?= $errorMessage ?></p>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required>
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
                    <button type="submit" class="btn btn-primary btn-block" name="log_admin">Login</button>
                    <a class="btn btn-danger btn-block" href="../index.php">Batal</a>
                </form>
            </div>
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
