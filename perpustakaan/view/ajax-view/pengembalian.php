<?php
include '../../controller/koneksi.php';

$search = $_GET['search'];
$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

if ($search != "") {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT tb_pengembalian.id, tb_peminjaman.tanggal_pinjam, tb_peminjaman.keterangan, tb_peminjaman.status, tb_peminjaman.jumlah, tb_user.nama, tb_anggota.nama as nama_member, tb_buku.judul, tb_pengembalian.tanggal_kembali FROM tb_pengembalian LEFT JOIN tb_peminjaman ON tb_pengembalian.peminjaman_id=tb_peminjaman.id LEFT JOIN tb_buku ON tb_peminjaman.buku_id=tb_buku.id LEFT JOIN tb_anggota ON tb_anggota.id_anggota=tb_peminjaman.anggota_id LEFT JOIN tb_user ON tb_user.id=tb_peminjaman.user_id WHERE tb_peminjaman.deleted='0' AND tb_peminjaman.status='1' AND tb_pengembalian.deleted='0' AND (tb_pengembalian.id LIKE '%$search%' OR tb_anggota.nama LIKE '%$search%' OR tb_buku.judul LIKE '%$search%') ORDER BY tb_pengembalian.id DESC LIMIT $awalData, $jumlahDataPerHalaman";
} else {
    $jumlahDataPerHalaman = 10;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE deleted='0'"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $sql = "SELECT tb_pengembalian.id, tb_peminjaman.tanggal_pinjam, tb_peminjaman.keterangan, tb_peminjaman.status, tb_peminjaman.jumlah, tb_user.nama, tb_anggota.nama as nama_member, tb_buku.judul, tb_pengembalian.tanggal_kembali FROM tb_pengembalian LEFT JOIN tb_peminjaman ON tb_pengembalian.peminjaman_id=tb_peminjaman.id LEFT JOIN tb_buku ON tb_peminjaman.buku_id=tb_buku.id LEFT JOIN tb_anggota ON tb_anggota.id_anggota=tb_peminjaman.anggota_id LEFT JOIN tb_user ON tb_user.id=tb_peminjaman.user_id WHERE tb_peminjaman.deleted='0' AND tb_peminjaman.status='1' AND tb_pengembalian.deleted='0' ORDER BY tb_pengembalian.id DESC LIMIT $awalData, $jumlahDataPerHalaman";
}


$pengembalian = mysqli_query($conn, $sql);

?>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center text-wrap" style="width: 50px;">Kode Pengembalian</th>
            <th class="text-center">Judul Buku</th>
            <th class="text-center">Tanggal Pinjam</th>
            <th class="text-center">Tanggal Kembali</th>
            <th class="text-center">Jumlah Pinjaman</th>
            <th class="text-center">Peminjam</th>
            <?php if ($result['hak_akses'] == "1") : ?>
                <th class="text-center">Opsi</th>
                <th class="text-center">Operator</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php if (mysqli_num_rows($pengembalian) != 0) : ?>
            <?php $no = $awalData; ?>
            <?php foreach ($pengembalian as $row) : ?>
                <tr>
                    <td class="text-center"><?= $no = $no + 1; ?></td>
                    <td class="text-center">PGM<?= sprintf("%03d", $row['id']); ?></td>
                    <td><?= $row['judul']; ?></td>
                    <td class="text-center"><?= date('d F Y', strtotime($row['tanggal_pinjam'])); ?></td>
                    <td class="text-center"><?= date('d F Y', strtotime($row['tanggal_kembali'])); ?></td>
                    <td class="text-center"><?= $row['jumlah']; ?></td>
                    <td class="text-center"><?= $row['nama_member']; ?></td>
                    <td class="text-center" style="width: 110px;">
                        <?php if ($result['hak_akses'] == "1") : ?>
                            <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#Hapus<?= $row['id']; ?>"><i class="bi bi-trash"></i></button>
                        <?php endif; ?>
                    </td>
                    <?php if ($result['hak_akses'] == "1") : ?>
                        <td class="text-center"><?= $row['nama']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <?php if ($_SESSION['user']['hak_akses'] == "1") : ?>
                    <td colspan="10" class="text-center fw-bold text-secondary">Data Kosong!</td>
                <?php else : ?>
                    <td colspan="9" class="text-center fw-bold text-secondary">Data Kosong!</td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $jumData = mysqli_query($conn, "SELECT * FROM tb_pengembalian LEFT JOIN tb_peminjaman ON tb_peminjaman.id=tb_pengembalian.peminjaman_id WHERE tb_peminjaman.deleted='0' AND tb_pengembalian.deleted='0'"); ?>
<span class="ms-auto">Showing <?= mysqli_num_rows($pengembalian); ?> Data of <?= mysqli_num_rows($jumData); ?>.</span>