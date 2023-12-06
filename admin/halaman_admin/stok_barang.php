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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #004c4c;
        }

        .navbar-toggler {
            border-color: #fff;
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        .table-container .table td img {
            max-width: 100px;
            max-height: 100px;
            width: auto;
            height: auto;
        }

        .table-container .table th,
        .table-container .table td {
            vertical-align: middle;
        }

        .table-container .table th {
            background-color: #30475e;
            color: #fff;
        }

        .table-container .table th:first-child,
        .table-container .table td:first-child {
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .table-container .table th:last-child,
        .table-container .table td:last-child {
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .table-container .table .action-icons i {
            cursor: pointer;
            font-size: 1.25rem;
            margin-right: 10px;
        }

        .table-container .table .action-icons i.delete {
            color: #ff5733;
        }

        .table-container .table .action-icons i.edit {
            color: #33ccff;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .search-form .form-control {
            flex: 1;
            margin-right: 10px;
        }

         /* CSS untuk tombol "Kembali" */
         .back-button {
            margin-top: 10px;
            display: none;
            color: #fff;
        }

        /* CSS untuk pagination */
        .pagination-container {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .pagination-container ul.pagination {
            justify-content: center;
        }

        .pagination-container ul.pagination li {
            display: inline-block;
            margin: 0 4px;
        }

        .pagination-container .page-link {
            padding: 8px 16px;
            color: #004c4c;
        }

        .pagination-container .page-item.active .page-link {
            background-color: #004c4c;
            border-color: #004c4c;
            color: #fff;
        }

        .pagination-container .page-link:hover {
            background-color: #ddd;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                margin-left: 0;
            }

            .navbar-toggler {
                margin-right: 0;
            }

            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-form .form-control {
                margin-bottom: 10px;
                margin-right: 0;
            }
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_user.php">Data User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="stok_barang.php">Data Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Barang</h2>
            <!-- Formulir pencarian -->
            <form method="post" action="" class="search-form">
                <input type="text" name="keyword" class="form-control" placeholder="Cari barang...">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
            </form>
        </div>
        <!-- Tombol "Tambah Data" -->
        <div class="mb-2">
            <a href="tambah_barang.php" class="btn btn-success">Tambah Data</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama_barang</th>
                    <th>Nama_penjual</th>
                    <th>Gambar_produk</th>
                    <th>Qr dana</th>
                    <th>No_telpon wa</th>
                    <th>Harga_jual</th>
                    <th>Stok</th>
                    <th>Deskripsi_barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksiuser.php';

                // Pagination
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 4;
                $offset = ($page - 1) * $limit;

                $no = $offset + 1;

                if (isset($_POST['keyword'])) {
                    $keyword = $_POST['keyword'];
                    $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%' LIMIT $offset, $limit";
                    $select = mysqli_query($conn, $query);
                    // Tampilkan tombol "Kembali" saat melakukan pencarian
                    echo '<style>.back-button { display: block; }</style>';
                } else {
                    $select = mysqli_query($conn, "SELECT * FROM barang LIMIT $offset, $limit");
                }

                while ($hasil = mysqli_fetch_array($select)) {
                ?>
                    <tr>
                        <th><?php echo $no++ ?></th>
                        <td><?php echo $hasil['nama_barang'] ?></td>
                        <td><?php echo $hasil['nama_penjual'] ?></td>
                        <td><img src="../../gambar/<?php echo $hasil['gambar_produk']; ?>"></td>
                        <td><img src="../../dana/<?php echo $hasil['dana']; ?>"></td>
                        <td><?php echo $hasil['no_telpone']; ?></td>
                        <td>Rp <?php echo number_format($hasil['harga_jual'], 0, ',', '.'); ?></td>
                        <td><?php echo number_format($hasil['stok'], 0, ',', '.'); ?></td>
                        <td><?php echo $hasil['deksripsi_barang']; ?></td>
                        <td class="action-buttons">
                            <a href="hapus_data_barang.php?id=<?php echo $hasil['id_barang']; ?>" class="btn btn-danger delete" title="Hapus" onclick="return confirmDelete();">Hapus</a>
                            <a href="edit_data_barang.php?id=<?php echo $hasil['id_barang']; ?>" class="btn btn-primary" title="Edit">Edit</a>
                        </td>
                        <script>
                            function confirmDelete() {
                                return confirm('Apakah Anda yakin ingin menghapus data ini?');
                            }
                        </script>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Tombol untuk kembali ke halaman sebelumnya -->
        <a class="btn btn-secondary back-button" href="stok_barang.php">Kembali</a>

        <!-- Pagination Links -->
         <nav class="pagination-container" aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Menghitung total halaman
            $result = mysqli_query($conn, "SELECT COUNT(id_barang) AS total FROM barang");
            $data = mysqli_fetch_assoc($result);
            $total_pages = ceil($data['total'] / $limit);

            // Tampilkan link ke halaman sebelumnya
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
            }else {
                echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
            }

            // Tampilkan link halaman
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }

            // Tampilkan link ke halaman berikutnya
            if ($page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
            }else {
                echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
            }
            ?>
        </ul>
    </nav>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
