<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['tambah'])) {
        $nama = ucwords(validasi($_POST['nama']));
        $jkel = validasi($_POST['jkel']);
        $alamat = validasi($_POST['alamat']);
        $nohp = validasi($_POST['nohp']);

        $foto = upload('anggota/');

        $in = mysqli_query($conn, "INSERT INTO tb_anggota (nama, jkel, alamat, foto, nohp) VALUES ('$nama', '$jkel', '$alamat', '$foto', '$nohp')");
        if ($in) {
            $_SESSION['pesan'] = 200;
            header("Location: ../view/anggota.php");
        } else {
            $_SESSION['pesan'] = 300;
            header("Location: ../view/anggota.php");
        }
    }
}
