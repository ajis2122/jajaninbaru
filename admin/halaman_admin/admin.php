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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
                        <a class="nav-link active" href="Admin.php">Admin</a>
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
    <div class="container table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Admin</h2>
            <!-- Formulir pencarian -->
            <form method="post" action="" class="search-form">
                <input type="text" name="keyword" class="form-control" placeholder="Cari Admin...">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
            </form>
        </div>
        <!-- Tombol "Tambah Data" -->
        <div class="mb-2">
            <a href="tambah_data_admin.php" class="btn btn-success">Tambah Data</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksiuser.php';
                $no = 1;

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $rowsPerPage = 5;
                $startIndex = ($currentPage - 1) * $rowsPerPage;

                if (isset($_POST['keyword'])) {
                    $keyword = $_POST['keyword'];
                    $query = "SELECT * FROM admin WHERE nama LIKE '%$keyword%' LIMIT $startIndex, $rowsPerPage";
                    $select = mysqli_query($conn, $query);
                    // Tampilkan tombol "Kembali" saat melakukan pencarian
                    echo '<style>.back-button { display: block; }</style>';
                } else {
                    $query = "SELECT * FROM admin LIMIT $startIndex, $rowsPerPage";
                }

                $select = mysqli_query($conn, $query);

                while ($hasil = mysqli_fetch_array($select)) {
                ?>
                    <tr>
                        <th><?php echo $no++ ?></th>
                        <td><?php echo $hasil['nama'] ?></td>
                        <td><?php echo $hasil['username'] ?></td>
                        <td><?php echo $hasil['password'] ?></td>
                        <td><?php echo $hasil['jenis_kelamin'] ?></td>
                        <td class="action-buttons">
                            <a href="hapus_data_admin.php?id=<?php echo $hasil['id']; ?>" class="btn btn-danger delete" title="Hapus" onclick="return confirmDelete();">Hapus</a>
                            <a href="edit_data_admin.php?id=<?php echo $hasil['id']; ?>" class="btn btn-primary edit" title="Edit">Edit</a>
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
        <a class="btn btn-secondary back-button" href="Admin.php">Kembali</a>
    </div>

    <div class="pagination-container">
        <ul class= "pagination justify-content-center">
            <?php
            // Hitung jumlah total halaman
            $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin"));
            $totalPages = ceil($totalRows / $rowsPerPage);

            // Menampilkan tombol "Previous"
            if ($currentPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
            } else {
                echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
            }

            // Menampilkan nomor halaman
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }

            // Menampilkan tombol "Next"
            if ($currentPage < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
            } else {
                echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
            }
            ?>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</body>
</html>
