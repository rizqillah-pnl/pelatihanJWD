<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SESSION['user']['id'] != "1") {
    header("Location: ../view/index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['back'])) {
        date_default_timezone_set('Asia/Jakarta');
        $id = $_POST['id'];
        $ket = validasi($_POST['ket']);
        $tgl = date('Y-m-d');
        $kode = $_SESSION['user']['id'];


        mysqli_query($conn, "UPDATE tb_peminjaman SET status='1', keterangan=NULLIF('$ket', '') WHERE id='$id'");
        $in = mysqli_query($conn, "INSERT INTO tb_pengembalian (peminjaman_id, user_id, tanggal_kembali, deleted) VALUES ('$id', '$kode', '$tgl', '0')");

        if ($in) {
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id='$id'"));
            $jum = $data['jumlah'];
            $idBuku = $data['buku_id'];

            $buku = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE id='$idBuku'"));
            $jumStok = $buku['jumlah_stok'];
            $jumStok = $jumStok + $jum;

            $upStok = mysqli_query($conn, "UPDATE tb_buku SET jumlah_stok='$jumStok' WHERE id='$idBuku'");
            if ($upStok) {
                $_SESSION['pesan'] = 201;
                header("Location: ../view/peminjaman.php");
            } else {
                $_SESSION['pesan'] = 203;
                header("Location: ../view/peminjaman.php");
            }
        } else {
            $_SESSION['pesan'] = 301;
            header("Location: ../view/peminjaman.php");
        }
    }
}
