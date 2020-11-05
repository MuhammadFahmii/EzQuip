<?php 
    require_once '../vendor/autoload.php';
    require "functionBarang.php";
    $query="SELECT * FROM barang INNER JOIN barang_masuk ON barang.idBarang = barang_masuk.idBarang";
    $result=mysqli_query($conn,$query);
    

    $mpdf = new \Mpdf\Mpdf();
    $html='
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <h1 style="font-family:monospace;">Daftar Barang Masuk</h1>
        <table border="1" cellpadding="10" cellspacing="5" style="margin-left:50px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                </tr>';
            $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $html.='
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row["tglMasuk"].'</td>
                    <td>'.$row["namaBarang"].'</td>
                    <td>'.$row["hargaBeli"].'</td>
                    <td>'.$row["jumlah"].'</td>
                </tr>
                ';
            }
    $html.='</thead>
        </table>
    </body>
    </html>';
    $mpdf->WriteHTML($html);
    $mpdf->Output("daftar-barang-masuk.pdf","I");
?>