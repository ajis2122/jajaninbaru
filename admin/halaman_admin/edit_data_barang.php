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
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
        }

        .card {
            border: 0;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            border-radius: 15px 15px 0 0;
        }

        .card-title {
            color: #495057;
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
                <h2 class="card-title">Edit Data Barang</h2>
            </div>
            <div class="card-body">
                <?php
                include 'koneksiuser.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = "SELECT * FROM barang WHERE id_barang = $id";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $data = mysqli_fetch_assoc($result);
                ?>
                        <form method="post" action="proses_edit_barang.php" enctype="multipart/form-data">
                            <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="<?php echo $data['nama_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama_penjual">Nama Penjual</label>
                                <input type="text" class="form-control" name="nama_penjual" required value="<?php echo $data['nama_penjual']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="text" class="form-control" name="harga_jual" value="<?php echo $data['harga_jual']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control" name="stok" required value="<?php echo $data['stok']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="deksripsi_barang">Deskripsi Barang</label>
                                <textarea class="form-control" name="deksripsi_barang" rows="4" required><?php echo $data['deksripsi_barang']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gambar_produk">Gambar Produk</label>
                                <img src="../../gambar/<?php echo $data['gambar_produk']; ?>" style="max-width: 120px;" alt="Current Image">
                                <input type="file" class="form-control-file" name="gambar_produk" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="dana">Qris Dana</label>
                                <img src="../../dana/<?php echo $data['dana']; ?>" style="max-width: 120px;" alt="Current Image">
                                <input type="file" class="form-control-file" name="dana" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="no_telpone">No Telepon</label>
                                <input type="text" class="form-control" name="no_telpone" required value="<?php echo $data['no_telpone']; ?>" />
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            <a class="btn btn-danger" href="stok_barang.php">Batal</a>
                        </form>
                <?php
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                } else {
                    echo "ID barang tidak valid.";
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
