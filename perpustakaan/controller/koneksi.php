<?php
session_start();
$conn = mysqli_connect("127.0.0.1", "root", "", "dbperpus_jwd");

if (!$conn) {
    echo "Koneksi gagal!";
}
