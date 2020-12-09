<?php
// koneksi database 
require "koneksi.php";

// ambil data gudang
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// tambah data barang
function tambah($data)
{
  global $conn;
  $namaBarang = htmlspecialchars($data["namaBarang"]);
  $jenisBarang = htmlspecialchars($data["jenisBarang"]);
  $hargaBarang = htmlspecialchars($data["hargaBarang"]);
  $jumlah = htmlspecialchars($data["jumlah"]);
  $gambar = upload();
  if ($gambar == false) {
    echo "<script>document.location.href='tambahDataBarang.php';</script>";
    return false;
  }

  $tambah = "INSERT INTO barang VALUES(
            '', '$namaBarang', '$jenisBarang', '$hargaBarang', '$jumlah','$gambar')
        ";
  mysqli_query($conn, $tambah);
  return mysqli_affected_rows($conn);
}

// upload gambar
function upload()
{
  $namaFile = $_FILES["gambar"]["name"];
  $tmpName = $_FILES["gambar"]["tmp_name"];
  $error = $_FILES["gambar"]["error"];
  $size = $_FILES["gambar"]["size"];

  // cek apakah gambar sudah dimasukkan
  if ($error === 4) {
    echo "<script>alert('Anda belum memasukkan foto');</script>";
    return false;
  }

  // cek apakah yang diupload == gambar
  $tipeValid = ['jpg', 'jpeg', 'png'];
  $tipeFile = explode('.', $namaFile);
  $tipeFile = strtolower(end($tipeFile));

  if (in_array($tipeFile, $tipeValid) === false) {
    echo "<script>alert('Yang anda masukkan bukan gambar!');</script>";
    return false;
  }

  // membatasi ukuran upload
  if ($size > 1000000) {
    echo "<script>alert('Ukuran gambar maksimal 1MB');</script>";
    return false;
  }

  // membuat nama gambar baru agar berbeda
  $namaFileBaru = uniqid();
  $namaFileBaru .= $tipeFile;
  move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
  return $namaFileBaru;
}

// hapus data barang
function hapus($idBarang)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM barang WHERE idBarang='$idBarang'");
  return mysqli_affected_rows($conn);
}

// edit data barang
function edit($data)
{
  global $conn;
  $idBarang = ($data["idBarang"]);
  $namaBarang = htmlspecialchars($data["namaBarang"]);
  $jenisBarang = htmlspecialchars($data["jenisBarang"]);
  $hargaBarang = htmlspecialchars($data["hargaBarang"]);
  $jumlah = htmlspecialchars($data["jumlah"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);
  if ($_FILES["gambar"]["error"] == 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }
  $edit = "UPDATE barang SET namaBarang='$namaBarang', jenisBarang='$jenisBarang', hargaJual='$hargaBarang', jumlah='$jumlah',        gambar='$gambar' WHERE idBarang=$idBarang;";
  mysqli_query($conn, $edit);
  return mysqli_affected_rows($conn);
}
