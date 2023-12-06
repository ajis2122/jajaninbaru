<?php
include 'koneksi.php';

// Ambil keyword dari URL
$keyword = $_GET['keyword'];

// Query untuk mencari produk berdasarkan keyword
$query = "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .centered-text {
            text-align: center;
        }

        .orange-underline {
            border-bottom: 3px solid #86A789;
            display: inline-block;
            padding: 0 2px;
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

        .card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(33, 156, 144, 0.5); /* Ubah warna shadow sesuai kebutuhan */
}
.animation {
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
@media (max-width: 576px) {
            h2.display-4 {
                font-size: 2rem;
            }
        }     
    </style>
</head>

<body>
    <div class="container mb-2 mt-5">
        <div class="animation">
        <h2 class="centered-text mb-3">
            <span class="orange-underline">
                <h1>Hasil Pencarian</h1>
            </span>
        </h2>
        </div>
        <div class="kembali mb-3">
            <a class="btn btn-primary" href="javascript:history.go(-1)"><i class="fas fa-chevron-left"></i> Kembali</a>
        </div>

        <div class="row">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="gambar/<?= $row['gambar_produk'] ?>" class="card-img-top" alt="<?= $row['nama_barang'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
                            <p class="card-text">Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
                            <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a type="button" class="btn btn-outline-success" href="detail.php?id=<?php echo $row['id_barang']; ?>">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
