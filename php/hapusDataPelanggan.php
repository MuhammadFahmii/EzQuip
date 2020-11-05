<?php 
    require "koneksi.php";
    $id=$_GET["id"];
    if(hapus($id)>0){
        echo "
            <script>
            alert('Data berhasil Dihapus');
            document.location.href='data-Pelanggan.php';
            </script>  
        ";
    }else{
        echo "
            <script>
            alert('Data Gagal Dihapus');
            document.location.href='data-Pelanggan.php';
            </script>  
        ";
    }
    function hapus($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM pelanggan WHERE idPelanggan=$id");
        return mysqli_affected_rows($conn);
    }
?>