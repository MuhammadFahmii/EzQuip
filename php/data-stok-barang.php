<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

require "functionBarang.php";
$barang = query('SELECT * FROM barang');

if (isset($_POST["search"])) {
  $barang = cari($_POST["cariBarang"]);
}
function cari($cari)
{
  $query = "SELECT*FROM barang WHERE namaBarang LIKE '%$cari%' OR jenisBarang LIKE '%$cari%'";
  return query($query);
}

// pagination
$jumlahDataHalaman = 3;
$jumlahData = count(query("SELECT * FROM barang"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;

// query untuk mengambil data
$barang = query("SELECT*FROM barang LIMIT $awalData,$jumlahDataHalaman");
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
                <i class="fas fa-file-invoice-dollar mr-2 ml-1 "></i><span class="ml-1">Data Pembayaran</span>
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
    <div class="col-lg pr-5">
      <h2>
        <i class="fas fa-box-open mr-2 p-4 mt-5 ml-5"></i><span>Data Stok Barang</span></a>
      </h2>
      <a href="tambahDataBarang.php"><button type="button" class="btn btn-primary tambah"><i class="fas fa-plus-circle mr-2"></i>Tambah Barang Baru</button></a>
      <a href="cetak-brg.php" target="_blank"><button type="button" class="btn btn-success">Cetak</button></a>

      <!-- pagination -->
      <nav class="mt-2" aria-label="...">
        <ul class="pagination">
          <?php if ($halamanAktif <= 1) : ?>
            <li class="page-item disabled">
              <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" tabindex="-1">Previous</a>
            </li>
          <?php endif; ?>
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" tabindex="-1">Previous</a>
            </li>
          <?php endif; ?>
          <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else : ?>
              <li class="page-item" aria-current="page">
                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a>
            </li>
          <?php endif; ?>
          <?php if ($halamanAktif >= $jumlahHalaman) : ?>
            <li class="page-item disabled">
              <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Next</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      <table class="table table-hover mt-2">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jenis Barang</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = $awalData + 1; ?>
          <?php foreach ($barang as $b) : ?>
            <tr>
              <td><?= $i; ?></td>
              <td><img src="../img/<?= $b["gambar"]; ?>" alt="" class="rounded-circle"></td>
              <td><?= $b["namaBarang"]; ?></td>
              <td><?= $b["jenisBarang"]; ?></td>
              <td><?= "Rp " . $b["hargaJual"]; ?></td>
              <td><?= $b["jumlah"]; ?></td>
              <td>
                <a href="editDataBarang.php?idBarang=<?= $b["idBarang"]; ?>" class="btn btn-success text-white p-1"><i class="fas fa-edit"></i></a>
                <a href="hapusDataBarang.php?idBarang=<?= $b["idBarang"]; ?>" class="btn btn-danger text-white p-1" onclick="return confirm('Apakah anda yakin')"><i class="fas fa-trash-alt"></i></a>
              </td>
              <?php $i++; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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