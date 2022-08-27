<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE id='$search'"));

echo $data['gambar'];
