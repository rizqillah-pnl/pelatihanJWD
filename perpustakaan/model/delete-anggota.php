<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hapus'])) {
        $idAnggota = $_POST['id'];
        $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='$idAnggota'"));
        $_SESSION['nama'] = $name['nama'];

        $deleteAnggota = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id_anggota='$idAnggota'");

        if ($deleteAnggota) {
            $_SESSION['pesan'] = 202;
            header("Location: ../view/anggota.php");
        } else {
            $_SESSION['pesan'] = 302;
            header("Location: ../view/anggota.php");
        }
    }
}
