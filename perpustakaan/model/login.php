<?php
include '../controller/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['username'] = $username;

        $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND deleted='0'");

        if (mysqli_num_rows($cek) == 1) {
            $res = mysqli_fetch_assoc($cek);

            if (password_verify($password, $res['password'])) {
                $_SESSION['pesan'] = 200;
                $_SESSION['user'] = $res;

                header("Location: ../view/index.php");
            } else {
                $_SESSION['message'] = 400;
                header("Location: ../view/login.php");
            }
        } else {
            $_SESSION['message'] = 404;
            header("Location: ../view/login.php");
        }
    }
}

header("Location: ../view/login.php");
