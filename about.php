<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>About Us</title>
    <style>
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
        .kembali {
            text-align: left; /* Pindahkan tulisan "Kembali" ke sebelah kiri */
            margin-left: 150px; /* Atur margin kiri agar tidak terlalu dekat dengan tepi */
            margin-top: 30px; /* Tambahkan margin-top untuk menurunkan elemen ke bawah */
        }

        .kembali a {
            padding: 8px 15px; /* Atur padding tombol sesuai kebutuhan */
        }
    </style>
</head>

<body>
<div class="kembali mb-3">
        <a class="btn btn-primary" href="index.php"><i class="fas fa-chevron-left"></i> Kembali</a>
    </div>
    <div class="container mb-2 mt-5">
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


    <!-- founder -->
    <div class="container mt-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/faizal.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
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
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/fikri.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
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
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/aji.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
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
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/nadia.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nadia Salma</h5>
                                <h6 class="card-title">System Analyst dan Database</h6>
                                <p class="card-text">"Kamu sempurna dengan caramu sendiri"</p>
                                <div class="social-media">
                                    <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                                    <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/tika.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Cartika Dwi Ramadania</h5>
                                <h6 class="card-title">System analyst dan Database</h6>
                                <p class="card-text">"Jangan hidup untuk ekspektasi orang lain dan jangan pedulikan tatapan orang lain. Yakinlah dengan diri sendiri"</p>
                                <div class="social-media">
                                    <img src="img/logoig.png" alt="Instagram" class="mr-2" style="width: 30px; height: 30px;">
                                    <img src="img/logoemail.png" alt="E-mail" class="mr-2" style="width: 30px; height: 30px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/valen.png" class="card-img" alt="Gambar Anda" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
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

        </div>
    </div>
</body>

</html>