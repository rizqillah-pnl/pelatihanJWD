<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
if ($search != "") {
    $jumlahDataPerHalaman = 5;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_anggota"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_anggota WHERE nama LIKE '%$search%' OR id_anggota LIKE '%$search%' OR alamat LIKE '%$search%' LIMIT $awalData, $jumlahDataPerHalaman";
} else {
    $jumlahDataPerHalaman = 5;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_anggota"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_anggota LIMIT $awalData, $jumlahDataPerHalaman";
}


$anggota = mysqli_query($conn, $sql);

?>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">Id Anggota</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Foto</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">Nomor HP</th>
            <th class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php if (mysqli_num_rows($anggota) != 0) : ?>
            <?php $no = $awalData; ?>
            <?php foreach ($anggota as $row) : ?>
                <tr>
                    <td class="text-center"><?= $no = $no + 1; ?></td>
                    <td>AG<?= $row['id_anggota']; ?></td>
                    <td class="text-wrap" style="width: 200px;"><?= $row['nama']; ?></td>
                    <td class="text-center"><img src="../public/img/anggota/<?= $row['foto']; ?>" alt="Profil <?= $row['nama']; ?>" width="80" height="80"></td>
                    <td class="text-center"><?= ($row['jkel'] == "L") ? "Laki-laki" : "Perempuan"; ?></td>
                    <td class="text-wrap" style="width: 250px; text-align: justify;"><?= $row['alamat']; ?></td>
                    <td><?= $row['nohp']; ?></td>
                    <td class="text-center">
                        <button class="btn btn-success text-white mb-2" data-bs-toggle="modal" data-bs-target="#Cetak<?= $row['id_anggota']; ?>">Cetak Kartu</button>
                        <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['id_anggota']; ?>">Edit</button>
                        <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#Hapus<?= $row['id_anggota']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" class="text-center fw-bold text-secondary">Data Tidak Ditemukan!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $jumData = mysqli_query($conn, "SELECT * FROM tb_anggota"); ?>
<span class="ms-auto">Showing <?= mysqli_num_rows($anggota); ?> Data of <?= mysqli_num_rows($jumData); ?>.</span>