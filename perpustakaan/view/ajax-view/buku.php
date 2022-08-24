<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
if ($search != "") {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_buku WHERE deleted='0' AND (judul LIKE '%$search%' OR pengarang LIKE '%$search%' OR tahun_terbit LIKE '%$search%')ORDER BY id DESC";
} else {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_buku WHERE deleted='0' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman";
}


$buku = mysqli_query($conn, $sql);

?>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">Kode Buku</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Sampul</th>
            <th class="text-center">Pengarang</th>
            <th class="text-center">Tahun Terbit</th>
            <th class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php if (mysqli_num_rows($buku) != 0) : ?>
            <?php $no = $awalData; ?>
            <?php foreach ($buku as $row) : ?>
                <tr>
                    <td class="text-center"><?= $no = $no + 1; ?></td>
                    <td>BK<?= sprintf("%04d", $row['id']); ?></td>
                    <td class="text-wrap" style="width: 200px;"><?= $row['judul']; ?></td>
                    <td class="text-center"><img src="../public/img/buku/<?= $row['gambar']; ?>" alt="Sampul <?= $row['judul']; ?>" width="80" height="80" loading="lazy"></td>
                    <td class="text-center"><?= $row['pengarang']; ?></td>
                    <td class="text-center"><?= $row['tahun_terbit']; ?></td>
                    <td class="text-center">
                        <button class="btn btn-success text-white mb-2" data-bs-toggle="modal" data-bs-target="#Detail<?= $row['id']; ?>"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['id']; ?>"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#Hapus<?= $row['id']; ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" class="text-center fw-bold text-secondary">Data Kosong!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $jumData = mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0'"); ?>
<span class="ms-auto">Showing <?= mysqli_num_rows($buku); ?> Data of <?= mysqli_num_rows($jumData); ?>.</span>