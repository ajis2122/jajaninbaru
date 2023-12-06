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
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        img {
            display: block;
            max-width: 120px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Tambah Data Barang</h2>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama barang" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_penjual">Nama Penjual</label>
                        <input type="text" class="form-control" name="nama_penjual" id="nama_penjual" placeholder="Nama penjual" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar_produk">Gambar Produk</label>
                        <input type="file" class="form-control" name="gambar_produk" id="gambar_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="dana">Qris Dana</label>
                        <input type="file" class="form-control" name="dana" id="dana" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telpone">No Telepon Penjual</label>
                        <input type="text" class="form-control" name="no_telpone" id="no_telpone" placeholder="No telepon penjual" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga jual" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="deksripsi_barang">Deskripsi Barang</label>
                        <textarea class="form-control" name="deksripsi_barang" id="deksripsi_barang" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary btn-block">Tambah</button>
                    <a class="btn btn-danger btn-block" href="stok_barang.php">Batal</a>
                </form>
        <?php
include 'koneksiuser.php';

if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $nama_penjual = $_POST['nama_penjual'];
    $harga_jual = $_POST['harga_jual'];
    $no_telpone = $_POST['no_telpone'];
    $stok = $_POST['stok'];
    $deksripsi_barang = $_POST['deksripsi_barang'];

    // Perbaikan format nomor telepon untuk Indonesia
    $no_telpone = preg_replace("/[^0-9]/", "", $no_telpone); // Hapus karakter selain angka
    $no_telpone = "+62" . ltrim($no_telpone, "0"); // Tambahkan kode negara (+62) jika tidak ada

    // Pengolahan QR Code Dana
    if ($_FILES['dana']['name']) {
        $nama_file_dana = $_FILES['dana']['name'];
        $ukuran_file_dana = $_FILES['dana']['size'];
        $tipe_file_dana = $_FILES['dana']['type'];
        $tmp_file_dana = $_FILES['dana']['tmp_name'];

        $ekstensi_diperbolehkan_dana = array('png', 'jpg', 'jpeg');
        $x_dana = explode('.', $nama_file_dana);
        $ekstensi_dana = strtolower(end($x_dana));

        if (in_array($ekstensi_dana, $ekstensi_diperbolehkan_dana) === true) {
            move_uploaded_file($tmp_file_dana, '../../dana/' . $nama_file_dana);
            $qris_dana = $nama_file_dana;
        } else {
            echo "<script>alert('Ekstensi QR Code Dana hanya bisa jpg, jpeg dan png!');</script>";
            exit; // Hentikan eksekusi script jika ekstensi tidak sesuai
        }
    } else {
        echo "<script>alert('Silahkan upload QR Code Dana dalam format jpg, jpeg dan png!');</script>";
        exit; // Hentikan eksekusi script jika QR Code Dana tidak diupload
    }

    // Pengolahan Gambar Produk
    if ($_FILES['gambar_produk']['name']) {
        $nama_file_produk = $_FILES['gambar_produk']['name'];
        $ukuran_file_produk = $_FILES['gambar_produk']['size'];
        $tipe_file_produk = $_FILES['gambar_produk']['type'];
        $tmp_file_produk = $_FILES['gambar_produk']['tmp_name'];

        $ekstensi_diperbolehkan_produk = array('png', 'jpg', 'jpeg',);
        $x_produk = explode('.', $nama_file_produk);
        $ekstensi_produk = strtolower(end($x_produk));

        if (in_array($ekstensi_produk, $ekstensi_diperbolehkan_produk) === true) {
            move_uploaded_file($tmp_file_produk, '../../gambar/' . $nama_file_produk);

            // Simpan data ke database
            $query = "INSERT INTO barang (nama_barang, nama_penjual, gambar_produk, dana, harga_jual, stok, deksripsi_barang, no_telpone) 
                VALUES ('$nama_barang', '$nama_penjual', '$nama_file_produk', '$qris_dana', '$harga_jual', '$stok', '$deksripsi_barang', '$no_telpone')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<script>alert('Data berhasil ditambahkan!'); window.location='stok_barang.php';</script>";
            } else {
                echo "Query Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');</script>";
        }
    } else {
        echo "<script>alert('Silahkan upload gambar ke jpg atau png!');</script>";
    }
}
?>
</div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
