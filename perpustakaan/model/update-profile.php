<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

$kode = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit'])) {
        $nama = validasi($_POST['nama']);
        if ($nama != "") {

            if ($_FILES['foto']['error'] != "4") {
                $foto = upload('user/');
                $up = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', foto='$foto' WHERE id='$kode'");
            } else {
                $up = mysqli_query($conn, "UPDATE tb_user SET nama='$nama' WHERE id='$kode'");
            }

            if ($up) {
                $_SESSION['pesan'] = 200;
                header("Location: ../view/profile.php");
            } else {
                $_SESSION['pesan'] = 300;
                header("Location: ../view/profile.php");
            }
        } else {
            $_SESSION['pesan'] = 300;
            header("Location: ../view/profile.php");
        }
    } else if (isset($_POST['update-password'])) {
        $getData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode'"));
        $passlama = $_POST['passlama'];
        $passbaru = $_POST['passbaru'];
        $passkon = $_POST['passkon'];

        if ($passbaru == $passkon) {
            if (password_verify($passlama, $getData['password'])) {
                $hash = password_hash($passbaru, PASSWORD_DEFAULT);
                if (!password_verify($passbaru, $getData['password'])) {
                    $up = mysqli_query($conn, "UPDATE tb_user SET password='$hash' WHERE id='$kode'");

                    if ($up) {
                        $_SESSION['pesan'] = 201;
                        header("Location: ../view/profile.php");
                    } else {
                        $_SESSION['pesan'] = 301;
                        header("Location: ../view/profile.php");
                    }
                } else {
                    $_SESSION['pesan'] = 303;
                    header("Location: ../view/profile.php");
                }
            } else {
                $_SESSION['pesan'] = 302;
                header("Location: ../view/profile.php");
            }
        } else {
            $_SESSION['pesan'] = 302;
            header("Location: ../view/profile.php");
        }
    }
}
