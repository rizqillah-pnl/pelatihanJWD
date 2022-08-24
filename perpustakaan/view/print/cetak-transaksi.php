<?php

require_once '../../vendor/autoload.php';
include '../../controller/koneksi.php';


$data = mysqli_query($conn, "SELECT tb_pengembalian.id, tb_peminjaman.tanggal_pinjam, tb_peminjaman.keterangan, tb_peminjaman.status, tb_peminjaman.jumlah, tb_user.nama, tb_anggota.id_anggota, tb_anggota.nama as nama_member, tb_buku.id as id_buku, tb_buku.judul, tb_pengembalian.tanggal_kembali FROM tb_pengembalian LEFT JOIN tb_peminjaman ON tb_pengembalian.peminjaman_id=tb_peminjaman.id LEFT JOIN tb_buku ON tb_peminjaman.buku_id=tb_buku.id LEFT JOIN tb_anggota ON tb_anggota.id_anggota=tb_peminjaman.anggota_id LEFT JOIN tb_user ON tb_user.id=tb_peminjaman.user_id WHERE tb_peminjaman.deleted='0' AND tb_peminjaman.status='1' AND tb_pengembalian.deleted='0'");

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Daftar Transaksi | RZQ Perpus");
$mpdf->SetAuthor("RZQ Perpus");
$mpdf->SetCreator("RZQ Perpus");
$url = $_SERVER['HTTP_HOST'];
$uri = 'https://' . $url . $_SERVER['REQUEST_URI'];
$mpdf->SetHTMLFooter($uri);

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
            
            table, th {
                border: 1px solid #fff;
                border-collapse: collapse;
            }
            </style>
        </head>
        <body>
        <h1 style="text-align: center; margin-bottom: 30px;">DAFTAR TRANSAKSI</h1>

        <table style="margin: auto;">
            <tr style="background-color: #888;">
                <th style="height: 70px; padding: 5px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black;">No</th>
                <th class="text-center text-wrap" style="width: 50px;  height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Kode Pengembalian</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Tanggal Pinjam</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Tanggal Kembali</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Kode Buku</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Judul Buku</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Jumlah Pinjaman</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Kode Peminjam</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Peminjam</th>
                <th class="text-center" style="height: 70px; border-bottom: 2px solid black; border-top: 2px solid black; border-right: 1px solid black; border-left: 1px solid black; padding: 5px;">Operator</th>
            </tr>';

$no = 1;
foreach ($data as $row) {
    $html .= '<tr>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black;">' . $no++ . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black;">PGM' . sprintf("%03d", $row['id']) . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black; width: 100px;">' . date('d/m/Y', strtotime($row['tanggal_pinjam'])) . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black; width: 100px;">' . date('d/m/Y', strtotime($row['tanggal_kembali'])) . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black;">BK' . sprintf("%04d", $row['id_buku']) . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black; width: 250px;">' . $row['judul'] . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black;">' . $row['jumlah'] . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black;">AG' . sprintf("%03d", $row['id_anggota']) . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black; width: 160px;">' . $row['nama_member'] . '</td>
                    <td style="padding: 10px; text-align: center;  border-bottom: 1px solid black; width: 160px;">' . $row['nama'] . '</td>
            </tr>';
}


$html .= '</table>
        </body>
        </html>';

// $mpdf->setFooter('{PAGENO}');
$mpdf->AddPage("L");
$mpdf->WriteHTML($html);

$nameFile = "Data Transaksi - RZQ.pdf";
$mpdf->Output($nameFile, "I");
