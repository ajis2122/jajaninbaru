<?php
// Mulai sesi (pastikan ini ada di awal halaman)
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika tidak, redirect ke halaman login
    header("Location:loginuser.php");
    exit();
}
include 'koneksi.php';

// Mendapatkan id_barang dari URL
$id_barang = isset($_GET['id']) ? $_GET['id'] : die('ID barang tidak ditemukan dalam URL.');

// Query ambil data barang
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
$detail = $ambil->fetch_assoc();

// Pastikan data barang ditemukan
if (!$detail) {
    die('Data barang tidak ditemukan.');
}

// Mendapatkan nomor WhatsApp penjual dari data yang diambil
$nomorWhatsAppPenjual = $detail['no_telpone'];

// Tentukan path ke gambar QR Code Dana penjual
$gambarQRDanaPath = 'dana/' . $detail['dana'];

// Tambahkan logika untuk menampilkan gambar atau pesan kesalahan
if (file_exists($gambarQRDanaPath)) {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>QR Code Dana Penjual</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container {
                max-width: 1200px;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .image-container {
                max-width: 100%;
                overflow: hidden;
                text-align: center;
            }

            .image-container img {
                max-width: 100%;
                height: auto;
            }
            .beli{
                background-color: #4C7068;
            }
            .card {
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }
            
            .card:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 8px rgba(33, 156, 144, 0.5); /* Ubah warna shadow sesuai kebutuhan */
            }
        </style>
    </head>
    <body>
    <div class="product-card">
    <div class="row">
        <div class="col-md-6">
            <div class="product-image">
                <img src="' . $gambarQRDanaPath . '" alt="QR Code Dana Penjual" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Formulir Pembelian -->
                    <form id="form-pembelian" enctype="multipart/form-data">
                        <!-- Tambahkan elemen formulir seperti yang sudah Anda berikan -->
                        <!-- Pastikan untuk menyesuaikan atribut "for" dan "id" pada label dan input -->

                        <!-- Jumlah yang dibeli -->
                        <div class="form-group">
                            <label for="jumlah">Jumlah yang dibeli:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah yang dibeli" oninput="hitungTotal()">
                        </div>

                        <!-- Total Harga -->
                        <div class="form-group">
                            <label for="total">Total Harga:</label>
                            <input type="text" class="form-control" id="total" name="total" readonly>
                        </div>

                        <!-- Nama Pembeli -->
                        <div class="form-group">
                            <label for="nama_pembeli">Nama Pembeli:</label>
                            <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" placeholder="Masukkan nama Anda">
                        </div>

                        <!-- Alamat Pembeli -->
                        <div class="form-group">
                            <label for="alamat_pembeli">Alamat Pembeli:</label>
                            <input type="text" class="form-control" id="alamat_pembeli" name="alamat_pembeli" placeholder="Masukkan alamat Anda">
                        </div>

                        <!-- Nomor Telepon Pembeli -->
                        <div class="form-group">
                            <label for="no_telp_pembeli">Nomor Telepon Pembeli:</label>
                            <input type="text" class="form-control" id="no_telp_pembeli" name="no_telp_pembeli" placeholder="Masukkan nomor telepon Anda">
                        </div>

                        <!-- Tombol "Beli Sekarang" untuk metode pembayaran "Cod" -->
                        <button class="btn btn-primary beli" type="button" onclick="beliSekarang()">Hubungi Penjual</button>
                        <!-- Tombol "Batal" -->
                        <a class="btn btn-danger btn-beli" href="javascript:history.go(-1)">Batal</a>
                    </form>

                    <!-- Peringatan -->
                    <div id="peringatan" class="alert alert-danger mt-3" style="display: none;">Silakan lengkapi semua data dengan benar.</div>
                </div>
            </div>
        </div>
    </div>
</div>


        <script>
            function hitungTotal() {
                var jumlah = document.getElementById("jumlah").value;
                var harga = ' . $detail["harga_jual"] . ';
                var total = jumlah * harga;
                document.getElementById("total").value = "Rp. " + formatNumber(total);
            }

            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function beliSekarang() {
                var namaPembeli = document.getElementById("nama_pembeli").value;
                var nomorTelpPembeli = document.getElementById("no_telp_pembeli").value;
                var alamatPembeli = document.getElementById("alamat_pembeli").value;
                var jumlah = document.getElementById("jumlah").value;
                var total = document.getElementById("total").value;
        
                // Validasi formulir pembelian
                if (!namaPembeli || !nomorTelpPembeli || !alamatPembeli || !jumlah) {
                    document.getElementById("peringatan").style.display = "block";
                    return;
                }
        

                // Pesan untuk ditampilkan di WhatsApp
                var pesan = "Halo, saya ingin memesan:\n" +
                    "Nama Barang: ' . $detail['nama_barang'] . '\n" +
                    "Jumlah: " + jumlah + "\n" +
                    "Total Harga: " + total + "\n" +
                    "Nama Pembeli: " + namaPembeli + "\n" +
                    "Alamat Pembeli: " + alamatPembeli + "\n" +
                    "Nomor Telepon Pembeli: " + nomorTelpPembeli + "\n\n" +
                    "Silakan sertakan bukti pembayaran dalam pesan ini.";

                // Encode pesan untuk URL
                var encodedPesan = encodeURIComponent(pesan);

                // Redirect ke WhatsApp penjual dengan format link yang sesuai
                window.location.href = "https://wa.me/' . $nomorWhatsAppPenjual . '?text=" + encodedPesan;
            }
        </script>
    </body>
    </html>';

} else {
    echo 'Gambar QR Code Dana tidak ditemukan.';
}
?>
