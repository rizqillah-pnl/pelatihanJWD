<?php

require_once '../../vendor/autoload.php';
include '../../controller/koneksi.php';


$data = mysqli_query($conn, "SELECT * FROM tb_buku");

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Daftar Buku | RZQ Perpus");
$mpdf->SetAuthor("RZQ Perpus");
$mpdf->SetCreator("RZQ Perpus");


foreach ($data as $row) {
    $mpdf->AddPage();
    $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <style>
            body, html{
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .row{
                border: 1px solid orange;
                padding: 20px;
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
        </head>
        <body>
            <div class="row">
                <h1 style="margin-bottom: 20px;">' . $row['judul'] . '</h1>
                <img src="../../public/img/buku/' . $row['gambar'] . '" width="300" loading="lazy">

                <table style="margin: auto;">
                    <tr>
                        <td>Kode Buku</td>
                        <td>:</td>
                        <td>BK' . $row['id'] . '</td>
                    </tr>
                    <tr>
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td>' . $row['judul'] . '</td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td>' . $row['pengarang'] . '</td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td>' . $row['penerbit'] . '</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>:</td>
                        <td>' . $row['isbn'] . '</td>
                    </tr>
                    <tr>
                        <td>Tahun Terbit</td>
                        <td>:</td>
                        <td>' . $row['tahun_terbit'] . '</td>
                    </tr>
                    <tr>
                        <td>Sinopsis</td>
                        <td>:</td>
                        <td>' . $row['sinopsis'] . '</td>
                    </tr>
                    <tr>
                    <td>Jumlah Halaman</td>
                    <td>:</td>
                    <td>' . $row['jumlah_halaman'] . '</td>
                </tr>
                </table>
            </div>
        </body>
        </html>';

    $mpdf->WriteHTML($html);
}

$nameFile = "Data Buku Perpus - RZQ.pdf";
$mpdf->Output($nameFile, \Mpdf\Output\Destination::INLINE);
