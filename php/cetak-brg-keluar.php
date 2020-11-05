<?php 
    require_once '../vendor/autoload.php';
    require "functionBarang.php";
    $query="SELECT * FROM barang INNER JOIN barang_keluar ON barang.idBarang = barang_keluar.idBarang";
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
        <h1 style="font-family:monospace;">Daftar Barang Keluar</h1>
        <table border="1" cellpadding="10" cellspacing="5" style="margin-left:50px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Keluar</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                </tr>';
            $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $html.='
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row["tglKeluar"].'</td>
                    <td>'.$row["namaBarang"].'</td>
                    <td>'.$row["hargaJual"].'</td>
                    <td>'.$row["jumlah"].'</td>
                </tr>
                ';
            }
    $html.='</thead>
        </table>
    </body>
    </html>';
    $mpdf->WriteHTML($html);
    $mpdf->Output("daftar-barang-keluar.pdf","I");
?>