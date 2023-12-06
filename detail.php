<?php
// Mulai sesi (pastikan ini ada di awal halaman)
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika tidak, redirect ke halaman login
    header("Location:loginuser.php");
    exit();
}
include 'koneksi.php';

//mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// query ambil data barang
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$id_produk'");
$detail = $ambil->fetch_assoc();

// Mendapatkan nomor WhatsApp penjual dari data yang diambil
$nomorWhatsAppPenjual = $detail['no_telpone'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .product-card {
            display: flex;
            flex-direction: row;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            flex: 1;
            max-width: 50%;
            position: relative;
            overflow: hidden;
            border-radius: 8px 0 0 8px;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.25rem;
            color: #4C7068;
            margin-bottom: 1rem;
        }

        .product-seller {
            font-size: 1rem;
            color: #777;
            margin-bottom: 1rem;
        }

        .product-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .buy-button {
            display: block;
            background-color: #4C7068;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #219C90;
        }

        /* Tampilan mobile */
        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
            }

            .product-image {
                max-width: 100%;
                border-radius: 8px 8px 0 0;
            }
        }

        .form-section {
            flex-grow: 1;
        }

        .form-section label {
            display: block;
            margin-bottom: 5px;
        }

        .form-section select,
        .form-section input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .form-section button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        .kembali {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .kembali a {
            background-color: #219C90;
            color: #fff;
            padding: 10px 10px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .kembali a i {
            margin-left: 5px;
        }

        .kembali a:hover {
            background-color: #4C7068;
        }
        #beli-sekarang-dana-button {
            display: none;
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
<div class="container mt-5">
        <!-- Tombol Kembali -->
        <div class="kembali mb-2">
            <a class="btn btn-primary" href="produk.php"><i class="fas fa-chevron-left"></i> Kembali</a>
        </div>

        <!-- Form Pembelian -->
        <div class="product-card">
            <div class="product-image">
                <img src="gambar/<?php echo $detail["gambar_produk"]; ?>" alt="Foto Produk">
            </div>
            <div class="product-details">
                <h2 class="product-title"><?php echo $detail["nama_barang"]; ?></h2>
                <p class="product-price">Harga: Rp. <?php echo number_format($detail["harga_jual"]); ?></p>
                <p class="product-seller">Penjual : <?php echo $detail["nama_penjual"]; ?> </p>
                <p class="product-seller">Stock : <?php echo $detail["stok"]; ?> </p>
                <p class="product-description"><?php echo $detail["deksripsi_barang"]; ?></p>

                <!-- Formulir Pembelian -->
                <div class="form-section" id="form-pembelian">
                    <label for="pembayaran">Pembayaran:</label>
                    <select id="pembayaran" name="pembayaran" onchange="showForm(this.value)">
                        <option value=""></option>
                        <option value="code">Cod</option>
                        <option value="dana">Dana</option>
                    </select>

                    <!-- Formulir untuk metode pembayaran "Cod" -->
                    <div id="form-cod" style="display:none;">
                    <label for="jumlah">Jumlah:</label>
                        <input type="number" id="jumlah" name="jumlah" placeholder="Jumlah yang dibeli">

                        <label for="total">Total:</label>
                        <input type="text" id="total" name="total" readonly>

                        <label for="nama_pembeli">Nama Pembeli:</label>
                        <input type="text" id="nama_pembeli" name="nama_pembeli" placeholder="Nama Pembeli">

                        <label for="alamat_pembeli">Alamat Pembeli:</label>
                        <input type="text" id="alamat_pembeli" name="alamat_pembeli" placeholder="Alamat Pembeli">

                        <label for="no_telp_pembeli">Nomer Telepon Pembeli:</label>
                        <input type="text" id="no_telp_pembeli" name="no_telp_pembeli" placeholder="Nomor Telepon Pembeli">
                    </div>

                  <!-- ... Bagian HTML yang sudah ada ... -->

<!-- Formulir untuk metode pembayaran "Dana" -->
<div id="form-dana" style="display:none;">
    <!-- Tidak perlu menambahkan formulir di sini -->
    <!-- Tombol "Beli Sekarang" untuk metode pembayaran "Dana" -->
    <a id="beli-sekarang-dana-button" class="buy-button" href="dana_qr.php?id=<?php echo $id_produk; ?>">Beli Sekarang</a>
</div>

<!-- Tombol "Beli Sekarang" untuk metode pembayaran "Cod" -->
<button id="beli-sekarang-button" class="buy-button" style="display: none;" onclick="beliSekarang()">Beli Sekarang</button>

<!-- ... Bagian HTML yang sudah ada ... -->


                    <!-- Tombol "Beli Sekarang" untuk metode pembayaran "Cod" -->
                    <button id="beli-sekarang-button" class="buy-button" style="display: none;" onclick="beliSekarang()">Beli Sekarang</button>
                </div>
            </div>
        </div>

        <script>
           function showForm(selectedValue) {
    // Sembunyikan semua formulir terlebih dahulu
    document.getElementById("form-cod").style.display = "none";
    document.getElementById("form-dana").style.display = "none";

    // Sembunyikan tombol "Beli Sekarang" secara default
    document.getElementById("beli-sekarang-button").style.display = "none";
    document.getElementById("beli-sekarang-dana-button").style.display = "none";

    // Tampilkan formulir atau tombol yang dipilih
    if (selectedValue === "code") {
        document.getElementById("form-cod").style.display = "block";
        document.getElementById("beli-sekarang-button").style.display = "block";
    } else if (selectedValue === "dana") {
        document.getElementById("form-dana").style.display = "block";
        document.getElementById("beli-sekarang-dana-button").style.display = "block";
    }
}

            // Hitung total berdasarkan jumlah yang dibeli dan harga
            document.getElementById("jumlah").addEventListener("input", function () {
                var jumlah = document.getElementById("jumlah").value;
                var harga = <?php echo $detail["harga_jual"]; ?>;
                var total = jumlah * harga;
                document.getElementById("total").value = "Rp. " + formatNumber(total);
            });
// ... Bagian JavaScript yang sudah ada ...

function beliSekarang() {
    var namaPembeli = document.getElementById("nama_pembeli").value;
    var nomorTelpPembeli = document.getElementById("no_telp_pembeli").value;
    var alamatPembeli = document.getElementById("alamat_pembeli").value;
    var jumlah = document.getElementById("jumlah").value;
    var total = document.getElementById("total").value;

    // Validasi form
    if (!namaPembeli || !nomorTelpPembeli || !alamatPembeli || !jumlah) {
        alert('Mohon lengkapi semua data pembelian.');
        return;
    }

              // Pesan untuk ditampilkan di WhatsApp
    var pesan = "Halo, saya ingin memesan:\n" +
        "Nama Barang: <?php echo $detail['nama_barang']; ?>\n" +
        "Jumlah: " + jumlah + "\n" +
        "Total Harga: " + total + "\n" +
        "Nama Pembeli: " + namaPembeli + "\n" +
        "Alamat Pembeli: " + alamatPembeli + "\n" +
        "Nomor Telepon Pembeli: " + nomorTelpPembeli;

    // Encode pesan untuk URL
    var encodedPesan = encodeURIComponent(pesan);

    // Redirect ke WhatsApp penjual dengan format link yang sesuai
    window.location.href = "https://wa.me/<?php echo $nomorWhatsAppPenjual; ?>?text=" + encodedPesan;
}

// ... Bagian JavaScript yang sudah ada ...

            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        </script>



<!-- ... Bagian lain dari kode HTML ... -->

                    
                <!-- ... Bagian lain dari kode HTML ... -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
            } else if (metodePembayaran === 'dana') {
        // Jika metode pembayaran Dana, arahkan ke halaman dengan QR Code Dana penjual
        window.location.href = 'dana_qr.php?id=<?php echo $id_produk; ?>'; // Sertakan ID produk di URL
    } else {
        // Metode pembayaran tidak valid, tampilkan pesan kesalahan
        alert('Pilih metode pembayaran terlebih dahulu.');
    }
}
</script>    

</body>

</html>