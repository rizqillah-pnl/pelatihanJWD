<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['tambah'])) {
        $username = validasi($_POST['username']);
        $nama = ucwords($username);
        $username = strtolower(str_replace(" ", "", $username));
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $hak_akses = $_POST['hak_akses'];
        if (strlen($username) < 3) {
            $_SESSION['pesan'] = 300;
            header("Location: ../view/users.php");
        } else {
            $foto = upload('user/');
            if ($_SESSION['user']['hak_akses'] == "1") {
                if ($_FILES['foto']['error'] != "4") {
                    $in = mysqli_query($conn, "INSERT INTO tb_user (nama, username, password, hak_akses, foto) VALUES ('$nama', '$username', '$pass', '$hak_akses', '$foto')");
                } else {
                    $in = mysqli_query($conn, "INSERT INTO tb_user (nama, username, password, hak_akses, foto) VALUES ('$nama', '$username', '$pass', '$hak_akses', '1.jpg')");
                }
                if ($in) {
                    $_SESSION['pesan'] = 200;
                    header("Location: ../view/users.php");
                } else {
                    $_SESSION['pesan'] = 300;
                    header("Location: ../view/users.php");
                }
            }
        }
    }
}
