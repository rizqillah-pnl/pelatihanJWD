<?php
include '../controller/koneksi.php';
include '../controller/validateText.php';
include '../controller/uploadImg.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $judul = ucwords(validasi($_POST['judul']));
        $penerbit = ucwords(validasi($_POST['penerbit']));
        $isbn = ucwords(validasi($_POST['isbn']));
        $pengarang = ucwords(validasi($_POST['pengarang']));
        $jumhal = ucwords(validasi($_POST['jumhal']));
        $jumstok = ucwords(validasi($_POST['jumstok']));
        $thnterbit = ucwords(validasi($_POST['thnterbit']));
        $sinopsis = ucwords(validasi($_POST['sinopsis']));

        $sampul = upload('buku/');

        if ($_FILES['foto']['error'] != "4") {
            $in = mysqli_query($conn, "UPDATE tb_buku SET judul='$judul', penerbit='$penerbit', isbn='$isbn', pengarang='$pengarang', jumlah_halaman='$jumhal', jumlah_stok='$jumstok', tahun_terbit='$thnterbit', sinopsis='$sinopsis', gambar='$sampul' WHERE id='$id'");
        } else {
            $in = mysqli_query($conn, "UPDATE tb_buku SET judul='$judul', penerbit='$penerbit', isbn='$isbn', pengarang='$pengarang', jumlah_halaman='$jumhal', jumlah_stok='$jumstok', tahun_terbit='$thnterbit', sinopsis='$sinopsis' WHERE id='$id'");
        }
        if ($in) {
            $_SESSION['pesan'] = 201;
            header("Location: ../view/buku.php");
        } else {
            $_SESSION['pesan'] = 301;
            header("Location: ../view/buku.php");
        }
    }
}
