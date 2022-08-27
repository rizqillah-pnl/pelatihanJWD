<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SESSION['user']['hak_akses'] != "1") {
    header("Location: ../view/index.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $nama = validasi($_POST['nama']);
            $pass = null;
            if (isset($_POST['password'])) {
                $pass = validasi($_POST['password']);
            }

            if (strlen($nama) < 3) {
                $_SESSION['pesan'] = 301;
                header("Location: ../view/users.php");
            } else {

                if ($pass == "" || $pass == " ") {
                    $pass = NULL;
                } else {
                    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                }

                if ($_FILES['foto']['error'] != "4") {
                    $foto = upload('user/');

                    if ($pass == NULL) {
                        $in = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', foto='$foto' WHERE id='$id'");
                    } else {
                        $in = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', password='$pass', foto='$foto' WHERE id='$id'");
                    }
                } else {
                    if ($pass == NULL) {
                        $in = mysqli_query($conn, "UPDATE tb_user SET nama='$nama' WHERE id='$id'");
                    } else {
                        $in = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', password='$pass' WHERE id='$id'");
                    }
                }

                if ($in) {
                    $_SESSION['pesan'] = 201;
                    header("Location: ../view/users.php");
                } else {
                    $_SESSION['pesan'] = 301;
                    header("Location: ../view/users.php");
                }
            }
        }
    }
}
