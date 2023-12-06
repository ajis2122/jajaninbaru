<?php
session_start();
include 'koneksi.php';

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

// Fungsi untuk menampilkan pesan alert dan redirect
function showAlertAndRedirect($message, $location) {
    echo '<script>';
    echo 'alert("' . $message . '");';
    echo 'window.location.href = "' . $location . '";';
    echo '</script>';
}
?>

<!-- Sisanya dari kode HTML Anda -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .navbar {
            background-color: transparent;
            box-shadow: none;
            position: absolute;
            width: 100%;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        .navbar-brand:hover {
            color: #86A789;
            transition: color 0.3s;
        }


        .navbar-toggler-icon {
            font-size: 28px;
            color: #fff;
        }

        .navbar-toggler-icon:hover {
            color: #86A789;
            transition: color 0.3s;
        }

        .navbar-nav .nav-item {
            margin-right: 20px;
        }

        .navbar-nav .nav-item a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav .nav-item a:hover {
            color: #86A789;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link {
            color: #fff; /* Warna teks untuk item menu */
        }


        .home {
            background-image: url('img/1.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .centered-text {
            text-align: center;
        }

        .orange-underline {
            border-bottom: 3px solid #86A789;
            display: inline-block;
            padding: 0 2px;
        }

        .category-menu {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .category-menu li {
            margin: 0 15px;
        }

        .category-menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .category-menu a:hover {
            color: #4C7068;
        }

        .caousel-inner {
            text-align: center;
        }

        .carousel-item img {
            width: 100%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev,
        .carousel-control-next,
        .carousel-control-next:focus,
        .carousel-control-prev:focus {
            outline: none;
        }

        /* Tombol "Lihat Lebih Banyak" */
        .see-more-button {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .see-more-button a {
            background-color: #219C90;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .see-more-button a i {
            margin-left: 10px;
        }

        .see-more-button a:hover {
            background-color: #4C7068;
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #4C7068;
            border-color: #4C7068;
        }
                /* Warna teks untuk item menu pada dropdown */
        .navbar-nav .nav-item .dropdown-menu .admin {
            color: black; /* Ganti dengan warna yang diinginkan untuk admin */
        }

        .navbar-nav .nav-item .dropdown-menu .user {
            color: black; /* Ganti dengan warna yang diinginkan untuk user */
        }
        .founders {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            max-width: 600px; /* Ganti dengan lebar maksimum yang Anda inginkan */
            margin: 0 auto;
        }
        /* Tambahkan styling baru untuk kartu founders */
.founders .card {
    border: 2px solid #86A789;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    margin-bottom: 20px; /* Beri jarak antar kartu */
}

.founders .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.founders .card-body {
    padding: 15px;
}

.founders .card-title {
    color: #333;
    font-size: 18px;
    font-weight: bold;
}

.founders .card-subtitle {
    color: #555;
    font-size: 14px;
}

.founders .card-text {
    color: #777;
    font-size: 14px;
}

.founders .social-media img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

/* Tambahkan styling untuk mengatur ukuran kartu */
@media (min-width: 576px) {
    .founders .col-md-6 {
        flex: 0 0 50%; /* Atur lebar kartu menjadi 50% saat layar lebih besar dari 576px */
    }
}

       
        .home h1,
        .home .additional-text p {
            animation: fadeInUp 1s ease-in-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .see-more-button a {
            animation: scaleIn 0.5s ease-in-out;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0.8);
            }
            100% {
                transform: scale(1);
            }
        }
        .card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(33, 156, 144, 0.5); /* Ubah warna shadow sesuai kebutuhan */
}
        .carousel-item img {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .container h1 {
    animation: slideInLeft 1s ease-in-out;
}

@keyframes slideInLeft {
    0% {
        opacity: 0;
        transform: translateX(-20px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}
.category-menu li {
    animation: fadeInRight 1s ease-in-out;
}

@keyframes fadeInRight {
    0% {
        opacity: 0;
        transform: translateX(20px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}
.card-body {
    animation: scaleIn 1s ease-in-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0.8);
    }
    100% {
        transform: scale(1);
    }
}
.founders h1, .founders p {
    animation: fadeInUp 1s ease-in-out;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}



    </style>
</head>

    <body>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <img src="img/logo_jajanin.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                JAJANIN
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars navbar-toggler-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="#" onclick="handleProdukClick()">Produk</a>
</li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about-section" >About Us</a>
                        <li class="nav-item">
                        <?php
                        if (isUserLoggedIn()) {
                            // Jika pengguna sudah login, tampilkan tombol logout dengan peringatan
                            echo '<a class="nav-link" href="#" onclick="showLogoutConfirmation()">Logout</a>';
                        } else {
                            // Jika pengguna belum login, tampilkan tombol login
                            echo '<a class="nav-link" href="loginuser.php">Login</a>';
                        }
                        ?>
        </li>

                </ul>
            </div>
         
        </nav>

        <div class="home">
            <h1>Selamat Datang di JAJANIN</h1>
            <div class="additional-text">
                <p>"Rasakan Kelezatan Dalam Genggaman Anda."</p>
            </div>
        </div>

        <div class="container mb-4 mt-5">
            <div>
                <h2 class="centered-text mb-3">
                    <span class="orange-underline">
                        <h1>Produk</h1>
                    </span>
                </h2>
            </div>
            <div class="see-more-button mb-3">
    <a class="btn btn-primary mt-3 col-lg-3" href="#" onclick="lihatLebihBanyak()">Lihat Lebih Banyak <i class="fas fa-chevron-right"></i></a>
</div>


<div class="row">
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM barang LIMIT 4");
    
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <div class="col-md-3">
            <div class="card mb-4">
                <img src="gambar/<?= $row['gambar_produk'] ?>" class="card-img-top" alt="Produk 1">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
                    <p class="card-text">Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
                    <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a type="button" class="btn btn-outline-success" onclick="beliSekarang(<?php echo $row['id_barang']; ?>)">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>



        <div class="container">
            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/baner1.png" alt="Image 1" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="img/baner2.png" alt="Image 2" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="img/baner3.png" alt="Imager 3" class="d-block w-100">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="container mb-2 mt-5" id="about-section">
            <h2 class="centered-text mb-3">
                <span class="orange-underline">
                    <h1>About Us</h1>
                </span>
            </h2>
            <div class="container">
                <ul class="category-menu">
                    <li>
                        <a href="#">Cerita kami</a>
                    </li>
                    <li>
                        <a href="#">Apa Yang Kami Tawarkan?</a>
                    </li>
                    <li>
                        <a href="#">Pesan Kami</a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-2 justify-content-center">
                    <div class="col mb-4"> <!-- Tambahkan class col dan mb-4 untuk memberikan jarak samping dan atas-bawah -->
                        <div class="card border-dark h-100"> <!-- Tambahkan class h-100 untuk mengatur tinggi kartu -->
                            <div class="card-body text-center"> <!-- Tambahkan class text-center untuk konten dalam kartu -->
                                <h5 class="card-title">Cerita Kami</h5>
                                <p class="card-text">JAJANIN berawal dari ide brilian para siswa/i jurusan Rekayasa Perangkat Lunak (RPL) SMKN 1 Gunungputri pada tahun 2023. Kami memiliki tekad untuk memberikan peluang kepada teman-teman sekolah kami untuk menjual makanan dan minuman favorit mereka secara online. Di sini, siswa/i kami dapat mengembangkan keterampilan bisnis mereka sambil menjelajahi dunia kuliner.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4"> <!-- Tambahkan class col dan mb-4 untuk memberikan jarak samping dan atas-bawah -->
                        <div class="card border-dark h-100"> <!-- Tambahkan class h-100 untuk mengatur tinggi kartu -->
                            <div class="card-body text-center"> <!-- Tambahkan class text-center untuk konten dalam kartu -->
                                <h5 class="card-title">Apa yang Kami Tawarkan</h5>
                                <p class="card-text">Kami menyediakan platform yang mudah digunakan yang memungkinkan siswa/i untuk memasarkan produk makanan mereka kepada teman-teman sekolah dan masyarakat luas. Anda dapat menjelajahi berbagai pilihan makanan dan minuman yang lezat, mulai dari makanan penutup manis hingga makanan berat yang gurih.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4"> <!-- Tambahkan class col dan mb-4 untuk memberikan jarak samping dan atas-bawah -->
                        <div class="card border-dark h-100"> <!-- Tambahkan class h-100 untuk mengatur tinggi kartu -->
                            <div class="card-body text-center"> <!-- Tambahkan class text-center untuk konten dalam kartu -->
                                <h5 class="card-title">Pesan Kami</h5>
                                <p class="card-text">Kami percaya bahwa berbagi makanan adalah cara yang istimewa untuk menciptakan ikatan di antara komunitas kami. Dengan JAJANIN, kami ingin mendukung semangat berwirausaha siswa/i kami dan menyediakan sarana bagi semua orang untuk menikmati hidangan istimewa yang kami tawarkan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4"> <!-- Tambahkan class col dan mb-4 untuk memberikan jarak samping dan atas-bawah -->
                        <div class="card border-dark h-100"> <!-- Tambahkan class h-100 untuk mengatur tinggi kartu -->
                            <div class="card-body text-center"> <!-- Tambahkan class text-center untuk konten dalam kartu -->
                                <h5 class="card-title">Bergabunglah Dengan Kami</h5>
                                <p class="card-text">Jangan ragu untuk bergabung dengan kami di JAJANIN. Anda dapat menjelajahi berbagai hidangan lezat dan mendukung pengusaha muda kami. Kami sangat berterima kasih atas dukungan Anda dan berharap Anda menikmati pengalaman kuliner Anda bersama kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1>Founders</h1>
            <p>"Kami adalah siswa SMKN 1 Gunungputri yang penuh semangat dalam menciptakan JAJANIN, platform kuliner berbasis online. Kami menggabungkan teknologi dan semangat berwirausaha untuk menjalani mimpi kami."</p>
        </div>

        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/faizal.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Muhamad Faizal Fikri</h5>
                    <h6 class="card-title">Leader & Back End</h6>
                    <p class="card-text">"Jadilah baik untuk menjadi terbaik."</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/fikri.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Muhammad Fikri Ramadhani</h5>
                    <h6 class="card-title">Back End & projek plan </h6>
                    <p class="card-text">"berbuat baiklah tanpa alasan."</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/aji.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Muhamad Aji Saputra</h5>
                    <h6 class="card-title">UI/UX Design & Front End</h6>
                    <p class="card-text">"Lakukan Apa yang ingin di lakukan."</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/nadia.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Nadia Salma</h5>
                    <h6 class="card-title">System Analyst dan Database</h6>
                    <p class="card-text">"Kamu sempurna dengan caramu sendiri"</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/tika.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Cartika Dwi Ramadania</h5>
                    <h6 class="card-title">System analyst dan Database</h6>
                    <p class="card-text">"Jangan hidup untuk ekspektasi orang lain dan jangan pedulikan tatapan orang lain. Yakinlah dengan diri sendiri"</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-md-4 mb-4">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="img/valen.png" class="card-img-top" alt="Gambar Anda" style="width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">Valentin Neza Pebriana Putri</h5>
                    <h6 class="card-title">Database dan QA Tester</h6>
                    <p class="card-text">"Jika mencari satu orang yang bisa mengubah hidupmu, lihatlah di cermin"</p>
                    <div class="social-media">
                        <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                        <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Testimoni Section -->
<div class="container mt-5 mb-3">
<h2 class="centered-text mb-3">
                <span class="orange-underline">
                    <h1>Testimoni</h1>
                </span>
            </h2>

    <div class="row justify-content-center">
        <!-- Testimoni 1 -->
        <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card border-0 text-center">
                <div class="card-img-top mb-3">
                    <img src="img/testi3.png" class="img-fluid img-thumbnail" alt="Testimonial 1" style="max-width: 200px; max-height: 150px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <p class="card-text">"Jajanin membantu bisnis kecil saya tumbuh. Jualan makin luas, kelola stok jadi mudah. Dukungan buat penjual kecil keren banget. Solusi hebat buat kembangkan bisnis makanan."</p>
                </div>
            </div>
        </div>

        <!-- Testimoni 2 -->
        <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card border-0 text-center">
                <div class="card-img-top mb-3">
                    <img src="img/testi1.png" class="img-fluid img-thumbnail" alt="Testimonial 2" style="max-width: 200px; max-height: 150px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Jane Smith</h5>
                    <p class="card-text">"Awalnya skeptis, tapi Jajanin bikin saya suka beli makanan online. Pesanan datang cepat, kemasan rapi. Pilihan makanan unik dari penjual lokal. Praktis buat nikmatin kuliner tanpa keluar rumah. Recomended!"</p>
                </div>
            </div>
        </div>

        <!-- Testimoni 3 -->
        <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card border-0 text-center">
                <div class="card-img-top mb-3">
                    <img src="img/testi2.png" class="img-fluid img-thumbnail" alt="Testimonial 3" style="max-width: 200px; max-height: 150px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Anna Johnson</h5>
                    <p class="card-text">"Suka banget belanja di Jajanin! Gampang cari jajanan favorit, transaksi simpel, dan barang selalu sesuai. Layanan pelanggan juga oke. Udah beberapa kali belanja, pasti terus pakai Jajanin!"</p>
                </div>
            </div>
        </div>
    </div>
</div>



        <footer class="bg-dark text-white text-center py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Ikuti Kami Di Sosial Media:</h5>
                        <a href="https://www.instagram.com/jajanin106/" target="_blank" class="text-white mr-2">
                            <img src="img/logoig.png" alt="Instagram" width="24" height="24">
                            Instagram
                        </a>
                        <a href="mailto:info@jajanin.com" class="text-white">
                            <img src="img/logoemail.png" alt="Email" width="24" height="24">
                            Email
                        </a>
                    </div>
                    <div class="col-md-6">
                        <p>&copy; 2023 JAJANIN. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Script jQuery, Popper.js, dan Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
    // Fungsi untuk melakukan pembelian
    function beliSekarang(id_barang) {
        <?php
        if (isUserLoggedIn()) {
            // Logika pembelian jika pengguna sudah login
        ?>
            // Redirect ke halaman detail.php dengan ID produk yang dipilih
            window.location.href = "detail.php?id=" + id_barang;
        <?php
        } else {
            // Jika pengguna belum login, tampilkan pesan
        ?>
            alert("Silakan login terlebih dahulu untuk melakukan pembelian.");
        <?php
        }
        ?>
    }

    // Fungsi untuk logout
    function logout() {
        <?php
        // Logika logout di sini
        echo 'window.location.href = "logout.php";';
        ?>
    }

    // Fungsi untuk melihat lebih banyak produk
    function lihatLebihBanyak() {
    <?php
    if (isUserLoggedIn()) {
        // Jika pengguna sudah login, redirect ke halaman produk.php
        echo 'window.location.href = "produk.php";';
    } else {
        // Jika pengguna belum login, tampilkan pesan dan redirect ke halaman loginuser.php
        echo 'alert("Silakan login terlebih dahulu untuk melihat lebih banyak produk.");';
    }
    ?>
}
</script>
<script>
    // Fungsi untuk menampilkan peringatan login
    function tampilkanPeringatanLogin() {
        alert("Silakan login terlebih dahulu untuk melihat produk.");
    }

    // Fungsi untuk menangani klik tombol "Produk"
    function handleProdukClick() {
        <?php
        if (isUserLoggedIn()) {
            // Jika pengguna sudah login, redirect ke halaman produk.php
            echo 'window.location.href = "produk.php";';
        } else {
            // Jika pengguna belum login, tampilkan peringatan login
            echo 'tampilkanPeringatanLogin();';
        }
        ?>
    }
</script>
<script>
    function showLogoutConfirmation() {
        // Tampilkan peringatan sebelum logout menggunakan konfirmasi JavaScript
        var isConfirmed = confirm("Anda yakin ingin logout?");
        
        // Jika pengguna mengonfirmasi logout, arahkan ke halaman logout
        if (isConfirmed) {
            window.location.href = "logout.php";
        }
    }
</script>

    </body>

</html>