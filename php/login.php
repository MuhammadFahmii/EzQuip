<?php 
    session_start();
    require "koneksi.php";

    // cek cookie
    if(isset($_COOKIE["id"])&&isset($_COOKIE["key"])){
        $id=$_COOKIE["id"];
        $key=$_COOKIE["key"];

        // ambil username berdasarkan id
        $result = mysqli_query($conn,"SELECT username FROM petugas WHERE idPetugas = '$id'");
        $row=mysqli_fetch_assoc($result);

        // cek cookie dan username
        if($key===hash('sha256',$row['username'])){
            $_SESSION['login']=true;
        }
    }

    // login
    if(isset($_POST["login"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $result=mysqli_query($conn,"SELECT * FROM petugas WHERE username='$username'");
        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
            // verifikasi password
            if(password_verify($password,$row["password"])){
                // set session
                $_SESSION["login"]=true;
                $_SESSION["username"]=$username;
                // set cookie
                if(isset($_POST["remember"])){
                    setcookie('id',$row["idPetugas"],time()+60);
                    setcookie('key',hash('sha256',$row["username"]) ,time()+60);
                }
                header("location: ../index.php");
                exit;
            }else{
                $error=true;
            }
        }
    }
    if(isset($_SESSION["login"])){
        header("location: ../index.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../bootstrap-4.4.1/bootstrap-4.4.1/dist/css/bootstrap.css">
        <link rel="stylesheet" href="../fontawesome-free-5.13.0-web/css/all.min.css">
        <link rel="stylesheet" href="../css/login.css">
        <title>Login</title>
    </head>
    <body>
        <div class="container mt-5 bg-light pb-3 pt-3">
            <h2 class="text-center">LOGIN</h2>
            <?php if(isset($error)): ?>
                <h2>Username / password salah</h2>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div> 
                        <input type="username" class="form-control" name="username" id="username" placeholder="Input Username" autofocus="on" autocomplete="off">
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
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <div class="form-group form-check">
                    <label>Belum punya akun?</label>
                    <a href="registrasi.php">daftar disini</a>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Masuk</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../bootstrap-4.4.1/bootstrap-4.4.1/dist/js/jquery-3.4.1.min.js"></script>
        <script src="../bootstrap-4.4.1/bootstrap-4.4.1/dist/js/bootstrap.js"></script>
        <script src="../javascript/script.js"></script>
    </body>
</html>