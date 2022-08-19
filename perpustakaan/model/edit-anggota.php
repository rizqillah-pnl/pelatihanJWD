<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['edit'])) {
        $idAnggota = $_POST['idAnggota'];
        $nama = ucwords(validasi($_POST['nama']));
        $jkel = validasi($_POST['jkel']);
        $alamat = validasi($_POST['alamat']);
        $nohp = validasi($_POST['nohp']);

        $foto = upload('anggota/');

        if ($_FILES['foto']['error'] != "4") {
            $in = mysqli_query($conn, "UPDATE tb_anggota SET nama='$nama', jkel='$jkel', alamat='$alamat', nohp='$nohp', foto='$foto' WHERE id_anggota='$idAnggota'");
        } else {
            $in = mysqli_query($conn, "UPDATE tb_anggota SET nama='$nama', jkel='$jkel', alamat='$alamat', nohp='$nohp' WHERE id_anggota='$idAnggota'");
        }
        if ($in) {
            $_SESSION['pesan'] = 201;
            header("Location: ../view/anggota.php");
        } else {
            $_SESSION['pesan'] = 301;
            header("Location: ../view/anggota.php");
        }
    }
}
