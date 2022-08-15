<?php
include '../controller/koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$id = $_SESSION['user']['id'];
$us = mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$id'");
$result = mysqli_fetch_assoc($us);



$hak_akses = $_SESSION['user']['hak_akses'];

$jumlahDataPerHalaman = 5;
$jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM tb_anggota"));
$jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$anggota = mysqli_query($conn, "SELECT * FROM tb_anggota LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard | RZQ Perpus</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == 200) : ?>
            <script>
                swal("Berhasil!", `Data Anggota Baru Berhasil Ditambahkan!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 300) : ?>
            <script>
                swal("Gagal!", `Data Anggota Gagal Ditambahkan!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 201) : ?>
            <script>
                swal("Berhasil!", `Data Anggota Berhasil Diedit!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 301) : ?>
            <script>
                swal("Gagal!", `Data Anggota Gagal Diedit!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 202) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Berhasil!", `Data ${nama} Berhasil Dihapus!`, "success", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 302) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Gagal!", `Data ${nama} Gagal Dihapus!`, "error", {
                    timer: 2500,
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
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-monitor"></use>
                    </svg> Master</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link active" href="anggota.php"><i class="bi bi-people-fill" style="margin-right: 10px;"></i> Data Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="buku.php"><i class="bi bi-book-half" style="margin-right: 10px;"></i> Data Buku</a></li>
                    <?php if ($hak_akses == "1") : ?>
                        <li class="nav-item"><a class="nav-link" href="users.php"><i class="bi bi-person-fill" style="margin-right: 10px;"></i> Data Users</a></li>
                    <?php endif; ?>

                </ul>
            </li>
            <!-- <li class="nav-title">Data Transaksi</li> -->
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
                    </svg> Transaksi</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="peminjaman.php"><i class="bi bi-bookmark" style="margin-right: 10px;"></i> Peminjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="pengembalian.php"><i class="bi bi-bookmark-check" style="margin-right: 10px;"></i> Pengembalian</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="laporan.php">
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
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button>
                <a class="header-brand d-md-none" href="index.php">
                    <div>
                        Data Anggota
                        <i class="bi bi-book" style="font-size: 20px;"></i>
                    </div>
                </a>
                <div class="header-nav d-none d-md-flex ms-auto" style="font-size: 25px;">
                    Data Anggota
                    <i class="bi bi-book" style="font-size: 20px; margin-left: 10px;"></i>
                </div>
                <ul class="header-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                            </svg></a>
                    </li>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="../public/img/user/<?= $result['foto']; ?>" alt="user@email.com"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <a class="dropdown-item mt-3" href="profile.php">
                                <svg class="icon me-2">
                                    <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Logout">
                                <svg class="icon me-2">
                                    <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <span>Master</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Data Anggota</span>
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
                            <h2 class="card-title mb-0">Data Anggota</h2>
                        </div>
                        <div class="container-fluid mt-4">
                            <div class="col-lg mb-2">
                                <div class="mb-0">
                                    <button type="button" class="btn btn-primary text-white text-center mb-2" data-bs-toggle="modal" data-bs-target="#TambahUser"><i class="mdi mdi-account-plus"></i> Tambah Anggota</button>

                                    <!-- Modal Tambah Anggota -->
                                    <div class="modal fade " id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TambahUserLabel">Tambah Anggota</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../model/tambah-anggota.php" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="foto">Foto</label>
                                                            <div class="col-sm-8" id="previewimg">
                                                                <input type="file" name="foto" id="foto" class="form-control" required onchange="validateImg(this, 'tambah', 'foto', 'previewimg', 'fotoFeedback')" aria-describedby="fotoFeedback" accept="image/*">
                                                                <div id="fotoFeedback" class="invalid-feedback"></div>
                                                                <div class="form-text text-info">Gambar maksimal 2MB</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="nama" class="col-md-4 col-form-label">Nama Anggota</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="nama" class="form-control" id="nama" required maxlength="100">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="nohp" class="col-md-4 col-form-label">No HP</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="nohp" class="form-control" id="nohp" required maxlength="15" onkeypress="return toNumber(event)">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-8">
                                                                <input type="radio" name="jkel" id="laki" required value="L"> <label for="laki">Laki-laki</label>
                                                                <input type="radio" name="jkel" id="perempuan" required value="P"> <label for="perempuan">Perempuan</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="alamat">Alamat</label>
                                                            <div class="col-sm-8">
                                                                <textarea name="alamat" id="alamat" cols="38" rows="3" class="form-control" maxlength="200" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambah" id="tambah" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Tambah -->

                                    <button type="button" class="btn btn-secondary text-white text-center mb-2" data-bs-toggle="modal" data-bs-target="#cetak"><i class="mdi mdi-account-plus"></i> Cetak Data Anggota</button>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="d-flex flex-row-reverse mb-3">
                                    <input type="text" style="height: 35px; width: 100%;" name="search" id="search" placeholder="Search . . ." autocomplete="off" class="form-control" autofocus>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#search').on('keyup', function() {
                                            let search = $('#search').val();

                                            $.get('ajax-view/anggota.php?search=' + search, function(data) {
                                                $('#table-anggota').html(data);
                                            })
                                            // $.get('../public/ajax/user.php?keyword=' + cari, function(data) {
                                            //     $('#container').html(data);
                                            // });
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col table-responsive" id="table-anggota">
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
                                                <td colspan="8" class="text-center fw-bold text-secondary">Data Kosong!</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php $jumData = mysqli_query($conn, "SELECT * FROM tb_anggota"); ?>
                                <span class="ms-auto">Showing <?= mysqli_num_rows($anggota); ?> Data of <?= mysqli_num_rows($jumData); ?>.</span>
                            </div>
                            <div class="mt-4">
                                <?php if (mysqli_num_rows($jumData) > 5) : ?>
                                    <div class="col">
                                        <ul class="pagination d-flex justify-content-end">
                                            <?php if ($halamanAktif > 1) : ?>
                                                <li class="page-item">
                                                    <span class="page-link"><a href="anggota.php?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                                </li>
                                            <?php else : ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link">Previous</span>
                                                </li>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <?php if ($i == $halamanAktif) : ?>
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link"><a href="anggota.php?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="page-item"><a class="page-link" href="anggota.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                <li class="page-item">
                                                    <span class="page-link"><a href="anggota.php?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
                                                </li>
                                            <?php else : ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link">Next</span>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
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

    <?php foreach ($anggota as $row) : ?>
        <!-- Modal Edit Anggota -->
        <div class="modal fade " id="Edit<?= $row['id_anggota']; ?>" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahUserLabel">Edit Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../model/edit-anggota.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idAnggota" value="<?= $row['id_anggota']; ?>">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label" for="foto<?= $row['id_anggota']; ?>">Foto</label>
                                <div class="col-sm-8" id="preview<?= $row['id_anggota']; ?>">
                                    <input type="file" name="foto" id="foto<?= $row['id_anggota']; ?>" class="form-control" onchange="validateImg(this, 'edit', 'foto<?= $row['id_anggota']; ?>', 'preview<?= $row['id_anggota']; ?>', 'fotoFeedback<?= $row['id_anggota']; ?>')" aria-describedby="fotoFeedback" accept="image/*">
                                    <div id="fotoFeedback<?= $row['id_anggota']; ?>" class="invalid-feedback"></div>
                                    <div class="form-text text-info">Gambar maksimal 2MB</div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama<?= $row['id_anggota']; ?>" class="col-md-4 col-form-label">Nama Anggota</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control" id="nama<?= $row['id_anggota']; ?>" required maxlength="100" value="<?= $row['nama']; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nohp<?= $row['id_anggota']; ?>" class="col-md-4 col-form-label">No HP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nohp" class="form-control" id="nohp<?= $row['id_anggota']; ?>" required maxlength="15" onkeypress="return toNumber(event)" value="<?= $row['nohp']; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    <?php
                                    $laki = "";
                                    $pr = "";
                                    ?>
                                    <?php ($row['jkel'] == "L") ? $laki = "checked" : $pr = "checked"; ?>
                                    <input type="radio" name="jkel" id="laki<?= $row['id_anggota']; ?>" required value="L" <?= $laki; ?>> <label for="laki<?= $row['id_anggota']; ?>">Laki-laki</label>
                                    <input type="radio" name="jkel" id="perempuan<?= $row['id_anggota']; ?>" required value="P" <?= $pr; ?>> <label for="perempuan<?= $row['id_anggota']; ?>">Perempuan</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label" for="alamat<?= $row['id_anggota']; ?>">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" id="alamat<?= $row['id_anggota']; ?>" cols="38" rows="3" class="form-control" maxlength="200" required><?= $row['alamat']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit" id="edit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->

        <!-- Modal Delete -->
        <div class="modal fade " id="Hapus<?= $row['id_anggota']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusLabel">Hapus Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus anggota dengan nama <strong><?= $row['nama']; ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <form action="../model/delete-anggota.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id_anggota']; ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="hapus" class="btn btn-danger text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Delete -->
    <?php endforeach; ?>


    <?php include 'footer.php'; ?>

</body>

</html>