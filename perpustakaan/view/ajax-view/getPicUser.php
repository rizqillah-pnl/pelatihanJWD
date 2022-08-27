<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='$search'"));

echo $data['foto'];
