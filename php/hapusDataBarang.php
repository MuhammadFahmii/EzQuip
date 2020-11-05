<?php 
    require "functionBarang.php";
    $barang=$_GET["idBarang"];
    if(hapus($barang)>0){
        echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href='data-stok-barang.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data tidak berhasil dihapus');
                document.location.href='data-stok-barang.php';
            </script>
        ";
    }
?>