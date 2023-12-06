<?php
// index.php

// Mulai sesi (pastikan ini ada di awal halaman)
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika tidak, redirect ke halaman login
    header("Location: ../loginadmin.php");
    exit();
}

// Include file koneksi ke database
include 'koneksiuser.php';

// Fungsi untuk mendapatkan nama pengguna yang login
function getLoggedInUsername($conn)
{
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $query = "SELECT nama FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['nama'];
        }
    }
    return 'ADMIN'; // Jika pengguna tidak login, tampilkan pesan untuk admin
}

// Mendapatkan nama pengguna yang login
$namaPengguna = getLoggedInUsername($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: transparent;
            box-shadow: none;
            position: absolute;
            width: 100%;
        }

        .navbar-brand {
    color: #31304D !important; /* Warna teks untuk tautan */
    font-weight: bold; 
}


        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
    color: #31304D !important; /* Warna teks untuk tautan */
}


        .chart-container {
            display: flex;
            flex-wrap: wrap;
            /* Memungkinkan untuk wrap ke baris baru */
            justify-content: space-evenly;
            /* Membuat jarak yang merata antar chart */
            align-items: center;
        }

        .chart {
            width: 80%;
            /* Lebar chart */
            max-width: 300px;
            /* Maksimum lebar chart */
            padding: 15px;
            margin: 10px;
            /* Jarak antar chart */
        }

        .home {
            background-image: url('../../img/4.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #31304D;
            text-align: center;
        }
        .home h1 {
        animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .additional-text{
            animation: fadeInUp 1s ease-out;
        } 
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-container .chart {
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .additional-text {
            margin-top: 20px;
            max-width: 600px;
        }

        .btn-custom {
            margin-top: 20px;
        }

        .diagram {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: fadeInUp 1s ease-out;
        }

        /* Percantik Card */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(33, 156, 144, 0.5); /* Ubah warna shadow sesuai kebutuhan */
        }

        .card-body {
            padding: 20px;
        }
        .navbar,
.navbar-brand,
.navbar-nav .nav-item,
.navbar-nav .nav-link {
    font-family: 'Roboto', sans-serif;
}

    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../img/profl_admin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                Hai, <?php echo $namaPengguna; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_user.php">Data User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stok_barang.php">Data Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="home">
        <h1>Selamat Datang, ADMIN!</h1>
        <div class="additional-text">
            <p>"Anda sekarang memiliki kontrol penuh atas halaman admin kami. Mari mulai dan jadikan pengelolaan sistem ini lebih efisien dan aman. Terima kasih atas dedikasi Anda sebagai admin kami. Selamat bekerja!"</p>
        </div>
    </div>

    <?php
    // Include file koneksi ke database
    include 'koneksiuser.php';

    // Query untuk mengambil jumlah data pengguna
    $queryUser = "SELECT COUNT(*) as totalUser FROM user";
    $resultUser = mysqli_query($conn, $queryUser);
    $dataUser = mysqli_fetch_assoc($resultUser);

    // Query untuk mengambil jumlah data admin
    $queryAdmin = "SELECT COUNT(*) as totalAdmin FROM admin";
    $resultAdmin = mysqli_query($conn, $queryAdmin);
    $dataAdmin = mysqli_fetch_assoc($resultAdmin);

    // Query untuk mengambil jumlah data barang
    $queryBarang = "SELECT COUNT(*) as totalBarang FROM barang";
    $resultBarang = mysqli_query($conn, $queryBarang);
    $dataBarang = mysqli_fetch_assoc($resultBarang);

    // Cek apakah query berhasil
    if ($resultUser && $resultAdmin && $resultBarang) {
        echo '<div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card animated">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Jumlah Data User</h5>
                        <p class="card-text">Total data user: ' . $dataUser['totalUser'] . '</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card animated">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-shield"></i> Jumlah Data Admin</h5>
                        <p class="card-text">Total data admin: ' . $dataAdmin['totalAdmin'] . '</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card animated">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Jumlah Data Barang</h5>
                        <p class="card-text">Total data barang: ' . $dataBarang['totalBarang'] . '</p>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } else {
        echo "Gagal mengambil data.";
    }

    // Tutup koneksi database
    mysqli_close($conn);
    ?>

    <div class="diagram">
        <h1>Diagram</h1>
        <p>"Selamat datang di toko online JAJANIN, tempat di mana Anda dapat menjelajahi berbagai makanan dan minuman lezat!"</p>
    </div>

    <div class="container chart-container">
        <div class="chart">
            <canvas id="chart1" width="400" height="400"></canvas>
        </div>
        <div class="chart">
            <canvas id="chart2" width="400" height="400"></canvas>
        </div>
        <div class="chart">
            <canvas id="chart3" width="400" height="400"></canvas>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.js"></script>
    <script>
        var ctx1 = document.getElementById('chart1').getContext('2d');
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var ctx3 = document.getElementById('chart3').getContext('2d');

        // Data untuk chart 1 (Line Chart)
        var data1 = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', ],
            datasets: [{
                label: 'Penjualan Bulanan 1',
                data: [10, 20, 30, 40, 50, 60],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        };

        // Data untuk chart 2 (Pie Chart)
        var data2 = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Penjualan Bulanan 2',
                data: [50, 40, 30, 20, 10, 5],
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 206, 86, 1)', 'rgba(54, 162, 235, 1)', 'rgba(153, 102, 255, 1)'],
            }]
        };

        // Data untuk chart 3 (Bar Chart)
        var data3 = {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            datasets: [{
                label: 'Penjualan Kuartalan',
                data: [150, 180, 120, 90],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        };

        var config1 = {
            type: 'line',
            data: data1,
        };

        var config2 = {
            type: 'pie',
            data: data2,
        };

        var config3 = {
            type: 'bar',
            data: data3,
        };

        var chart1 = new Chart(ctx1, config1);
        var chart2 = new Chart(ctx2, config2);
        var chart3 = new Chart(ctx3, config3);
    </script>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Ikuti Kami Di Sosial Media:</h5>
                    <a href="https://instagram.com/jajanin106?igshid=OGQ5ZDc2ODk2ZA==" target="_blank" class="text-white mr-2">
                        <img src="../../img/logoig.png" alt="Instagram" width="24" height="24">
                        Instagram
                    </a>
                    <a href="mailto:info@jajanin.com" class="text-white">
                        <img src="../../img/logoemail.png" alt="Email" width="24" height="24">
                        Email
                    </a>
                </div>
                <div class="col-md-6">
                    <p>&copy; 2023 JAJANIN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>