<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE id='$id'"));
        $_SESSION['nama'] = "PGM" . sprintf("%03d", $id);

        if ($_SESSION['user']['hak_akses'] == "1") {
            $deleteKembali = mysqli_query($conn, "UPDATE tb_pengembalian SET deleted='1' WHERE id='$id'");

            if ($deleteKembali) {
                $_SESSION['pesan'] = 202;
                header("Location: ../view/pengembalian.php");
            } else {
                $_SESSION['pesan'] = 302;
                header("Location: ../view/pengembalian.php");
            }
        } else {
            header("Location: ../view/pengembalian.php");
        }
    }
}
