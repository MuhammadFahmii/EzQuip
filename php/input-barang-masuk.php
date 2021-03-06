<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}
require "functionBarang.php";
$barang = query('SELECT * FROM barang');
if (isset($_POST["simpan"])) {
  if (input($_POST) > 0 && update($_POST) > 0) {
    echo "
                <script>
                alert('Data berhasil ditambahkan');
                document.location.href='barang-masuk.php';
                </script>
            ";
  } else {
    echo "
                <script>
                alert('Data gagal ditambahkan');
                </script>
            ";
  }
}
function input($data)
{
  global $conn;
  $username = $_SESSION["username"];
  $idPetugas = query("SELECT idPetugas FROM petugas WHERE username='$username'")[0]["idPetugas"];
  $tgl = htmlspecialchars($data["tgl"]);
  $namaBarang = htmlspecialchars($data["namaBarang"]);
  $harga = htmlspecialchars($data["harga"]);
  $jumlah = htmlspecialchars($data["jumlah"]);
  $idBarang = query("SELECT idBarang FROM barang WHERE namaBarang='$namaBarang'")[0]["idBarang"];

  $query = "INSERT INTO barang_masuk VALUES(
                '', '$tgl', '$idBarang', '$jumlah', '$harga', '$idPetugas')
            ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
// update jumlah di database
function update($data)
{
  global $conn;
  $namaBarang = htmlspecialchars($data["namaBarang"]);
  $idBarang = query("SELECT idBarang FROM barang WHERE namaBarang='$namaBarang'")[0]["idBarang"];
  $jumlah = htmlspecialchars($data["jumlah"]);
  $update = "UPDATE barang SET
            jumlah=jumlah+'$jumlah' WHERE idBarang=$idBarang;
        ";
  mysqli_query($conn, $update);
  return mysqli_affected_rows($conn);
}
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
  <link rel="stylesheet" href="../css/style.css">

  <title>Inventaris Gudang</title>
</head>

<body id="home">

  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark">
      <ul class="list-unstyled">
        <li>
          <a href="../index.php" class="bg-dark text-white">
            <i class="fas fa-tachometer-alt mr-2"></i><span class="ml-1">Beranda</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle bg-dark text-white"><i class="fas fa-table mr-2"></i><span class="ml-1">Data Master</span>
            <hr class="bg-secondary mb-0"></a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              <a class="bg-dark text-white" href="data-stok-barang.php">
                <i class="fas fa-box-open mr-2"></i><span>Data Stok Barang</span>
              </a>
            </li>
            <li>
              <a class="bg-dark text-white mt-2" href="data-pelanggan.php">
                <i class="fas fa-users mr-2"></i><span>Data Pelanggan</span>
              </a>
            </li>
            <li>
              <a class="bg-dark text-white mt-2" href="data-pembayaran.php">
                <i class="fas fa-file-invoice-dollar mr-2 ml-1"></i><span class="ml-1">Data Pembayaran</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a class="bg-dark text-white" href="barang-masuk.php">
            <i class="fas fa-file-invoice mr-2 ml-1"></i><span class="ml-1">Barang Masuk</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a class="bg-dark text-white" href="barang-keluar.php">
            <i class="fas fa-dolly-flatbed mr-1"></i><span class="ml-1">Barang Keluar</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
        <li>
          <a class="bg-dark text-white" href="pengaturan.php">
            <i class="fas fa-cogs mr-1"></i><span class="ml-1">Pengaturan</span>
            <hr class="bg-secondary mb-0">
          </a>
        </li>
      </ul>
    </nav>

    <!-- Content -->
    <div id="content">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#home">Aplikasi Inventori Barang</a>
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
                <a href="logout.php" class="dropdown-item bg-dark text-white">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="col-12 pr-5">
      <h2>
        <i class="fas fa-file-invoice mr-2 p-4 mt-5 ml-5"></i><span>Barang Masuk</span></a>
      </h2>
      <form action="" method="POST">
        <div class="form-group">
          <label for="exampleFormControlInput1">Tanggal Masuk</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" name="tgl">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Barang</label>
          <select class="form-control" id="exampleFormControlSelect1" name="namaBarang">
            <option>--Pilih Barang--</option>
            <?php foreach ($barang as $b) : ?>
              <option value="<?= $b["namaBarang"]; ?>"><?= $b["namaBarang"]; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="inputNumber">Harga Beli</label>
          <input type="number" class="form-control" id="inputNumber" rows="3" name="harga"></input>
        </div>
        <div class="form-group">
          <label for="inputNumber">Jumlah</label>
          <input type="number" class="form-control" id="inputNumber" rows="3" name="jumlah"></input>
        </div>
        <button type="submit" class="btn btn-danger float-right" formaction="barang-masuk.php">Batal</button>
        <button type="reset" class="btn btn-warning float-right mr-2">Reset</button>
        <button type="submit" class="btn btn-primary float-right mr-2" name="simpan">Simpan</button>
      </form>
    </div>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>

</html>