<?php 
    $conn=mysqli_connect("localhost","root","","gudang");
    $id=$_GET["id"];
    if(hapus($id)>0){
        echo "
            <script>
            alert('Data berhasil Dihapus');
            document.location.href='barang-masuk.php';
            </script>  
        ";
    }else{
        echo "
            <script>
            alert('Data Gagal Dihapus');
            document.location.href='barang-masuk.php';
            </script>  
        ";
    }
    function hapus($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM barang_masuk WHERE idMasuk=$id");
        return mysqli_affected_rows($conn);
    }
?>