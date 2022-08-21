<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['tambah'])) {
        date_default_timezone_set('Asia/Jakarta');

        $buku = $_POST['buku'];
        $member = $_POST['anggota'];
        $jum = $_POST['jum'];
        if ($jum > 3 || $jum <= 0) {
            $jum = 1;
        }

        $ket = validasi($_POST['ket']);
        if ($ket == "") {
            $ket = NULL;
        }

        $tgl = date('Y-m-d');
        $kode = $_SESSION['user']['id'];

        $cekBook = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE id='$buku'"));
        $cekPinjam = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE buku_id='$buku' AND anggota_id='$member' AND status='0' AND deleted='0'");

        if (mysqli_num_rows($cekPinjam) != 0) {
            $cekPinjam = mysqli_fetch_assoc($cekPinjam);
            $jumPinjam = $cekPinjam['jumlah'];

            if ($jumPinjam >= 3) {
                $_SESSION['pesan'] = 303;
                header("Location: ../view/peminjaman.php");
            } else {
                if ($cekBook['jumlah_stok'] >= $jum) {
                    $jum = $jumPinjam + 1;
                    $in = mysqli_query($conn, "UPDATE tb_peminjaman SET jumlah='$jum', tanggal_pinjam='$tgl' WHERE buku_id='$buku' AND anggota_id='$member' AND status='0'");

                    if ($in) {
                        $sisa = $cekBook['jumlah_stok'] - 1;
                        mysqli_query($conn, "UPDATE tb_buku SET jumlah_stok='$sisa' WHERE id='$buku'");

                        $_SESSION['pesan'] = 200;
                        header("Location: ../view/peminjaman.php");
                    } else {
                        $_SESSION['pesan'] = 300;
                        header("Location: ../view/peminjaman.php");
                    }
                } else {
                    $_SESSION['pesan'] = 303;
                    header("Location: ../view/peminjaman.php");
                }
            }
        } else {

            if ($cekBook['jumlah_stok'] >= $jum) {
                $in = mysqli_query($conn, "INSERT INTO tb_peminjaman (tanggal_pinjam, keterangan, status, jumlah, buku_id, anggota_id, user_id, deleted) VALUES ('$tgl', NULLIF('$ket', ''), '0', '$jum', '$buku', '$member', '$kode', '0')");

                if ($in) {
                    $sisa = $cekBook['jumlah_stok'] - $jum;
                    mysqli_query($conn, "UPDATE tb_buku SET jumlah_stok='$sisa' WHERE id='$buku'");

                    $_SESSION['pesan'] = 200;
                    header("Location: ../view/peminjaman.php");
                } else {
                    $_SESSION['pesan'] = 300;
                    header("Location: ../view/peminjaman.php");
                }
            } else {
                $_SESSION['pesan'] = 303;
                header("Location: ../view/peminjaman.php");
            }
        }
    }
}
