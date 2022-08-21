<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id='$id'"));
        $_SESSION['nama'] = "PJM" . sprintf("%03d", $id);

        if ($_SESSION['user']['hak_akses'] == "1") {
            $deletePinjam = mysqli_query($conn, "UPDATE tb_peminjaman SET deleted='1' WHERE id='$id'");

            if ($deletePinjam) {
                $_SESSION['pesan'] = 202;
                header("Location: ../view/peminjaman.php");
            } else {
                $_SESSION['pesan'] = 302;
                header("Location: ../view/peminjaman.php");
            }
        } else {
            header("Location: ../view/peminjaman.php");
        }
    }
}
