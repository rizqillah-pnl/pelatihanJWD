<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];


$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$search'");

if (mysqli_num_rows($user) != 0) {
    echo false;
} else {
    echo true;
}
