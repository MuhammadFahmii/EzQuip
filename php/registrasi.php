<?php
require "koneksi.php";
if (isset($_POST["registrasi"])) {
  if (registrasi($_POST) > 0) {
    echo
      "
        <script>
          alert('Akun berhasil ditambahkan');
          document.location.href='login.php';
        </script>
      ";
  } else {
    echo mysqli_error($conn);
  }
}

function registrasi($data)
{
  global $conn;
  $username = stripslashes($data["username"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password_con = mysqli_real_escape_string($conn, $data["password_con"]);

  if ($username == '') {
    return false;
  } else if ($password == '') {
    return false;
  } elseif ($password_con == '') {
    return false;
  }

  // cek username tersedia
  $result = mysqli_query($conn, "SELECT username FROM petugas WHERE username='$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Username Sudah terdaftar');</script>";
    return false;
  }

  // cek konfirmasi password
  if ($password !== $password_con) {
    echo "<script>alert('Password tidak sesuai');</script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "INSERT INTO petugas VALUES ('','$username','$password')");
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
  <link rel="stylesheet" href="../css/login.css">
  <title>Registrasi</title>
</head>

<body>
  <div class="container mt-5 bg-light pb-3 pt-3">
    <h2 class="text-center">Registrasi</h2>
    <?php if (isset($error)) : ?>
      <h2>Username sudah tersedia</h2>
    <?php endif; ?>
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="username" class="form-control" name="username" id="username" placeholder="Input Username" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" name="password" id="password" placeholder="Input Password">
        </div>
      </div>
      <div class="form-group">
        <label for="password">Konfirmasi Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" name="password_con" id="password_con" placeholder="Input Password">
        </div>
      </div>
      <button type="submit" name="registrasi" class="btn btn-primary">Registrasi</button>
      <button type="submit" class="btn btn-danger" formaction="login.php">Batal</button>
    </form>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>

</html>