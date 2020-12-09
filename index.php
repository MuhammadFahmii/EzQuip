<?php
session_start();
require "php/koneksi.php";
if (!isset($_SESSION["login"])) {
  header("location: php/login.php");
  exit;
}
$jumlahBarang = mysqli_num_rows(mysqli_query($conn, "SELECT idBarang FROM barang"));
$jumlahPelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT idPelanggan FROM pelanggan"));
$jumlahMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT idMasuk FROM barang_masuk"));
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">

  <title>Inventaris Gudang</title>
</head>

<body id="home">

  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark">
      <ul class="list-unstyled">
        <li>
          <a href="index.php" class="bg-dark text-white">
            <i class="fas fa-tachometer-alt mr-2"></i><span class="ml-1">Beranda</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark text-white"><i class="fas fa-table mr-2"></i><span class="ml-1">Data Master</span>
            <hr class="bg-secondary mb-0"></a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              <a class="bg-dark text-white" href="php/data-stok-barang.php">
                <i class="fas fa-box-open mr-2"></i><span>Data Stok Barang</span>
              </a>
            </li>
            <li>
              <a class="bg-dark text-white mt-2" href="php/data-pelanggan.php">
                <i class="fas fa-users mr-2"></i><span>Data Pelanggan</span>
              </a>
            </li>
            <li>
              <a class="bg-dark text-white mt-2" href="php/data-pembayaran.php">
                <i class="fas fa-file-invoice-dollar mr-2 ml-1"></i><span class="ml-1">Data Pembayaran</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a class="bg-dark text-white" href="php/barang-masuk.php">
            <i class="fas fa-file-invoice mr-2 ml-1"></i><span class="ml-1">Barang Masuk</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a class="bg-dark text-white" href="php/barang-keluar.php">
            <i class="fas fa-dolly-flatbed mr-1"></i><span class="ml-1">Barang Keluar</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a class="bg-dark text-white" href="php/pengaturan.php">
            <i class="fas fa-cogs mr-1"></i><span class="ml-1">Pengaturan</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
      </ul>
    </nav>

    <!-- Content -->
    <div id="content">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand justift-align-content" href="#home">Aplikasi Inventori Barang</a>
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fas fa-align-left"></i>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user mr-2"></i><span><?= $_SESSION["username"]; ?></span>
              </a>
              <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                <a href="php/logout.php" class="dropdown-item bg-dark text-white">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="col-12 pr-5 ml-3">
      <h2>
        <i class="fas fa-tachometer-alt mr-2 p-4 mt-5 ml-5"></i>Beranda</a>
      </h2>
      <div class="row ml-3">
        <div class="card mr-3 bg-success mb-2">
          <div class="card-body text-white">
            <i class="fas fa-box-open"></i>
            <h5 class="card-title">Data Stok Barang</h5>
            <div class="display-4"><?= $jumlahBarang; ?></div>
          </div>
          <div class="list-group text-center">
            <a href="php/data-stok-barang.php" class="text-white">Lihat Detail<i class="ml-2 fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="card mr-3 bg-primary mb-2">
          <div class="card-body text-white">
            <i class="fas fa-file-invoice"></i>
            <h5 class="card-title">Barang Masuk</h5>
            <div class="display-4"><?= $jumlahMasuk; ?></div>
          </div>
          <div class="list-group text-center">
            <a href="php/barang-masuk.php" class="text-white">Lihat Detail<i class="ml-2 fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="card mr-3 bg-danger mb-2">
          <div class="card-body text-white">
            <i class="fas fa-users"></i>
            <h5 class="card-title">Data Pelanggan</h5>
            <div class="display-4"><?= $jumlahPelanggan; ?></div>
          </div>
          <div class="list-group text-center">
            <a href="php/data-pelanggan.php" class="text-white">Lihat Detail<i class="ml-2 fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>