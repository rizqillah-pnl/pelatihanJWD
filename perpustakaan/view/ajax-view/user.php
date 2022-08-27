<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

if ($search != "") {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_user WHERE deleted='0' AND (nama LIKE '%$search%' OR username LIKE '%$search%') ORDER BY hak_akses, id DESC";
} else {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT * FROM tb_user WHERE deleted='0' ORDER BY hak_akses, id DESC LIMIT $awalData, $jumlahDataPerHalaman";
}


$users = mysqli_query($conn, $sql);

?>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">Foto</th>
            <th class="text-center">Kode User</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Username</th>
            <th class="text-center">Hak Akses</th>
            <th class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php if (mysqli_num_rows($users) != 0) : ?>
            <?php $no = $awalData; ?>
            <?php foreach ($users as $row) : ?>
                <tr>
                    <td class="text-center"><?= $no = $no + 1; ?></td>
                    <td class="text-center"><img src="../public/img/user/<?= $row['foto']; ?>" alt="Foto <?= $row['nama']; ?>" width="80" height="80" loading="lazy"></td>
                    <td class="text-center">USR<?= sprintf("%03d", $row['id']); ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td class="text-center"><?= $row['username']; ?></td>
                    <td class="text-center"><?= ($row['hak_akses'] == "1") ? "Admin" : "Operator"; ?></td>
                    <td class="text-center">
                        <?php if ($row['id'] != $result['id']) : ?>
                            <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['id']; ?>"><i class="bi bi-pencil"></i></button>
                        <?php endif; ?>

                        <?php if ($row['hak_akses'] != "1") : ?>
                            <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#Hapus<?= $row['id']; ?>"><i class="bi bi-trash"></i></button>
                        <?php endif; ?>
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
<?php $jumData = mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0'"); ?>
<span class="ms-auto">Showing <?= mysqli_num_rows($users); ?> Data of <?= mysqli_num_rows($jumData); ?>.</span>