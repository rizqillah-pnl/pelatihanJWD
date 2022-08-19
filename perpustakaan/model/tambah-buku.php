<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['tambah'])) {
        $judul = ucwords(validasi($_POST['judul']));
        $penerbit = ucwords(validasi($_POST['penerbit']));
        $isbn = ucwords(validasi($_POST['isbn']));
        $pengarang = ucwords(validasi($_POST['pengarang']));
        $jumhal = ucwords(validasi($_POST['jumhal']));
        $jumstok = ucwords(validasi($_POST['jumstok']));
        $thnterbit = ucwords(validasi($_POST['thnterbit']));
        $sinopsis = ucwords(validasi($_POST['sinopsis']));

        $sampul = upload('buku/');

        $in = mysqli_query($conn, "INSERT INTO tb_buku (judul, penerbit, isbn, pengarang, jumlah_halaman, jumlah_stok, tahun_terbit, sinopsis, gambar) VALUES ('$judul', '$penerbit', '$isbn', '$pengarang', '$jumhal', '$jumstok', '$thnterbit', '$sinopsis', '$sampul')");
        if ($in) {
            $_SESSION['pesan'] = 200;
            header("Location: ../view/buku.php");
        } else {
            $_SESSION['pesan'] = 300;
            header("Location: ../view/buku.php");
        }
    }
}
