<?php 
    require_once '../vendor/autoload.php';
    require "functionBarang.php";
    $barang=query('SELECT * FROM barang');

    $mpdf = new \Mpdf\Mpdf();
    $html='
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <h1 style="font-family:monospace;">Daftar Barang</h1>
        <table border="1" cellpadding="10" cellspacing="5" style="margin-left:50px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>';
            $i=1;
            foreach($barang as $row){
                $html.='
                <tr>
                    <td>'.$i++.'</td>
                    <td><img src="../img/'.$row["gambar"].'" width="50"></td>                   
                    <td>'.$row["namaBarang"].'</td>
                    <td>'.$row["jenisBarang"].'</td>
                    <td>'."Rp ".$row["hargaJual"].'</td>
                    <td>'.$row["jumlah"].'</td>
                </tr>
                ';
            }
    $html.='</thead>
        </table>
    </body>
    </html>';
    $mpdf->WriteHTML($html);
    $mpdf->Output("daftar-barang.pdf","I");
?>