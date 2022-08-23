<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE id='$id' AND deleted='0'"));
        $_SESSION['nama'] = $name['judul'];

        $deleteBuku = mysqli_query($conn, "UPDATE tb_buku SET deleted='1' WHERE id='$id'");

        if ($deleteBuku) {
            $_SESSION['pesan'] = 202;
            header("Location: ../view/buku.php");
        } else {
            $_SESSION['pesan'] = 302;
            header("Location: ../view/buku.php");
        }
    }
}
