<?php

require_once '../../vendor/autoload.php';
include '../../controller/koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='$id'"));

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetTitle("KTP | RZQ Perpus");
    $mpdf->SetAuthor("RZQ Perpus");
    $mpdf->SetCreator("RZQ Perpus");
    $jkel = ($row['jkel'] == "L") ? "Laki-laki" : "Perempuan";

    if ($row != NULL) {
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
                    border: 2px solid black;
                    padding: 20px;
                    width: 270px;
                    display: inline;
                }
                
                .col{
                    text-align: center;
                    background-color: #f0f2ff;
                    border: 2px solid red;
                    height: 100px;
                }
                
                h3{
                    text-align: center;
                    color: #333;
                }

                img{
                    border: 1px solid black;
                    padding: 5px;
                }
            </style>
            </head>
            <body>

                <div class="row">
                    <h3>Kartu Tanda Perpustakaan</h3>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div>
                                    <h2>AG0' . $row['id_anggota'] . '</h2>
                                    <img src="../../public/img/anggota/' . $row['foto'] . '" class="img-fluid rounded-start" alt="..." width="120" height="120">
                                </div>
                                <div>
                                    <div>
                                        <h4 class="card-title">' . $row['nama'] . '</h4>
                                        <span style="font-size: 12px; font-weight: 0;">' . $jkel . '</span>
                                        <p style="font-size: 12px;">' . $row['nohp'] . '</p>
                                        <p class="card-text" style="font-size: 12px;">' . $row['alamat'] . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="font-size: 10px; color: blue;">rzq-perpus.epizy.com/cek/ag0' . $row['id_anggota'] . '</span>
                </div>
            </body>
            </html>
            ';
    } else {
        $html = '
            <!DOCTYPE html>
            <html lang="en">

            <head>
            </head>

            <body>

                <div class="row" style="text-align: center;">
                    <div class="col">
                        <h1>DATA TIDAK DITEMUKAN!</h1>
                    </div>
                </div>

            </body>

            </html>
            ';
    }

    $mpdf->WriteHTML($html);
    $nameFile = $row['nama'] . " - KTP.pdf";
    $mpdf->Output($nameFile, \Mpdf\Output\Destination::INLINE);
} else {

    $data = mysqli_query($conn, "SELECT * FROM tb_anggota");

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetTitle("Daftar Anggota | RZQ Perpus");
    $mpdf->SetAuthor("RZQ Perpus");
    $mpdf->SetCreator("RZQ Perpus");
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

            tr:nth-child(even){
                background-color: #eee;
            }
        </style>
        </head>
        <body>

            <div class="row">
                <h1 style="text-align: center; margin-bottom: 50px;">Data Anggota Perpustakaan</h1>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                    </tr>
                    ';
    $no = 1;
    foreach ($data as $row) {
        $jkel = ($row['jkel'] == "L") ? "Laki-laki" : "Perempuan";
        $html .= '
            <tr>
                <td>' . $no++ . '</td>
                <td><img src="../../public/img/anggota/' . $row['foto'] . '" width="120" height="120"></td>
                <td style="text-align: center; font-weight: bold;">AG0' . $row['id_anggota'] . '</td>
                <td style="font-weight: bold;">' . $row['nama'] . '</td>
                <td style="text-align: center;">' . $jkel . '</td>
                <td>' . $row['alamat'] . '</td>
                <td>' . $row['nohp'] . '</td>
            </tr>
        ';
    }

    $html .= '</table>
            </div>
        </body>
        </html>
        ';

    $mpdf->WriteHTML($html);
    $nameFile = "Data Anggota Perpus - RZQ.pdf";
    $mpdf->Output($nameFile, \Mpdf\Output\Destination::INLINE);
}
