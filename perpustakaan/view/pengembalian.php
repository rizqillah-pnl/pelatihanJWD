<?php
include '../controller/koneksi.php';

$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$hak_akses = $_SESSION['user']['hak_akses'];

$jumlahDataPerHalaman = 10;
$jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE deleted='0'"));

$jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$pengembalian = mysqli_query($conn, "SELECT tb_pengembalian.id, tb_peminjaman.tanggal_pinjam, tb_peminjaman.keterangan, tb_peminjaman.status, tb_peminjaman.jumlah, tb_user.nama, tb_anggota.nama as nama_member, tb_buku.judul, tb_pengembalian.tanggal_kembali FROM tb_pengembalian LEFT JOIN tb_peminjaman ON tb_pengembalian.peminjaman_id=tb_peminjaman.id LEFT JOIN tb_buku ON tb_peminjaman.buku_id=tb_buku.id LEFT JOIN tb_anggota ON tb_anggota.id_anggota=tb_peminjaman.anggota_id LEFT JOIN tb_user ON tb_user.id=tb_peminjaman.user_id WHERE tb_peminjaman.deleted='0' AND tb_peminjaman.status='1' AND tb_pengembalian.deleted='0' ORDER BY tb_pengembalian.id DESC LIMIT $awalData, $jumlahDataPerHalaman");


date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pengembalian | RZQ Perpus</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == 202) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Berhasil!", `Data transaksi dengan kode ${nama} berhasil dihapus!`, "success", {
                    timer: 3000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 302) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Gagal!", `Data transaksi dengan kode ${nama} gagal dihapus!`, "error", {
                    timer: 3000,
                    button: false,
                });
            </script>
        <?php endif; ?>
    <?php endif;
    unset($_SESSION['pesan']);
    unset($_SESSION['nama']);
    ?>

    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <div class="sidebar-brand-full">
                <i class="bi bi-book" style="font-size: 20px;"></i>
                <span style="margin-left: 10px; font-size: 20px;">RZQ Library</span>
            </div>
            <div class="sidebar-brand-narrow">
                <i class="bi bi-book" style="font-size: 20px;"></i>
            </div>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-title">Home</li>
            <li class="nav-item"><a class="nav-link" href="index.php">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                    </svg> Dashboard</a></li>
            <li class="nav-title">Menu</li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#!">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-monitor"></use>
                    </svg> Master</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="anggota.php"><i class="bi bi-people-fill" style="margin-right: 10px;"></i> Data Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="buku.php"><i class="bi bi-book-half" style="margin-right: 10px;"></i> Data Buku</a></li>
                    <?php if ($hak_akses == "1") : ?>
                        <li class="nav-item"><a class="nav-link" href="users.php"><i class="bi bi-person-fill" style="margin-right: 10px;"></i> Data Users</a></li>
                    <?php endif; ?>

                </ul>
            </li>
            <!-- <li class="nav-title">Data Transaksi</li> -->
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#!">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
                    </svg> Transaksi</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="peminjaman.php"><i class="bi bi-bookmark" style="margin-right: 10px;"></i> Peminjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="pengembalian.php"><i class="bi bi-bookmark-check" style="margin-right: 10px;"></i> Pengembalian</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="print/cetak-transaksi.php" target="_blank">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                    </svg> Laporan Transaksi</a>
            </li>
            <li class="nav-title">Settings</li>
            <li class="nav-item"><a class="nav-link" href="profile.php">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg> Profile</a>
            </li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="modal" data-bs-target="#Logout">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg> Logout</button>
            </li>
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>

    <!-- MAIN SECTION -->
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <?php include 'header.php'; ?>
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <span>Transaksi</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Data Pengembalian</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-fluid">
                <!-- /.row-->
                <div class="card mb-5">
                    <div class="card-body">
                        <div>
                            <h2 class="card-title mb-0">Data Pengembalian</h2>
                        </div>
                        <div class="container-fluid mt-4">
                            <div class="col-lg">
                                <div class="d-flex flex-row-reverse mb-3">
                                    <input type="text" style="height: 35px; width: 100%;" name="search" id="search" placeholder="Search . . ." autocomplete="off" class="form-control" autofocus>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#search').on('keyup', function() {
                                            let search = $('#search').val();

                                            $.get('ajax-view/pengembalian.php?search=' + search, function(data) {
                                                $('#table-pengembalian').html(data);
                                            })
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col table-responsive" id="table-pengembalian">
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
                            </div>
                            <div class="mt-4">
                                <?php if (mysqli_num_rows($jumData) > $jumlahDataPerHalaman) : ?>
                                    <div class="col">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end">
                                                <?php if ($halamanAktif > 1) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="pengembalian.php?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Previous</span>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                    <?php if ($i == $halamanAktif) : ?>
                                                        <li class="page-item active" aria-current="page">
                                                            <span class="page-link"><a href="pengembalian.php?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                                        </li>
                                                    <?php else : ?>
                                                        <li class="page-item"><a class="page-link" href="pengembalian.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="pengembalian.php?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Next</span>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card.mb-4-->
            </div>
        </div>
        <footer class="footer">
            <div><a href="https://github.com/rizqillah-pnl" target="_blank" style="text-decoration: none;">RIZQILLAH</a></div>
            <div class="ms-auto">&copy; 2022 All Right Reserved</div>
        </footer>
    </div>

    <?php $pinjam = mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE deleted='0'"); ?>
    <?php foreach ($pinjam as $row) : ?>
        <?php if ($result['hak_akses'] == "1") : ?>
            <!-- Modal Delete -->
            <div class="modal fade " id="Hapus<?= $row['id']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="HapusLabel">Hapus Data Pengembalian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus data pengembalian berkode <strong>PGM<?= sprintf("%03d", $row['id']); ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="../model/delete-kembali.php" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="hapus" class="btn btn-danger text-white">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Delete -->
        <?php endif; ?>
    <?php endforeach; ?>


    <?php include 'footer.php'; ?>

</body>

</html>