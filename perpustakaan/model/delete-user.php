<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$id' AND deleted='0'"));
        $_SESSION['nama'] = $data['nama'];

        if ($data['hak_akses'] != "1") {
            $deleteUser = mysqli_query($conn, "UPDATE tb_user SET deleted='1' WHERE id='$id'");
        } else {
            header("Location: ../view/users.php");
        }

        if ($deleteUser) {
            $_SESSION['pesan'] = 202;
            header("Location: ../view/users.php");
        } else {
            $_SESSION['pesan'] = 302;
            header("Location: ../view/users.php");
        }
    }
}
