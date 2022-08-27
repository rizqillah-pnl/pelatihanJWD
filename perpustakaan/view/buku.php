<?php
include '../controller/koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$hak_akses = $_SESSION['user']['hak_akses'];

$jumlahDataPerHalaman = 10;
$jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM tb_buku WHERE deleted='0'"));
$jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$buku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");


$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Buku | RZQ Perpus</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == 200) : ?>
            <script>
                swal("Berhasil!", `Data Buku Baru Berhasil Ditambahkan!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 300) : ?>
            <script>
                swal("Gagal!", `Data Buku Gagal Ditambahkan!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 201) : ?>
            <script>
                swal("Berhasil!", `Data Buku Berhasil Diedit!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 301) : ?>
            <script>
                swal("Gagal!", `Data Buku Gagal Diedit!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 202) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Berhasil!", `Data Buku ${nama} Berhasil Dihapus!`, "success", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 302) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Gagal!", `Data Buku ${nama} Gagal Dihapus!`, "error", {
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
                            <span>Master</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Data Buku</span>
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
                            <h2 class="card-title mb-0">Data Buku</h2>
                        </div>
                        <div class="container-fluid mt-4">
                            <div class="col-lg mb-2">
                                <div class="mb-0">
                                    <button type="button" class="btn btn-primary text-white text-center mb-2" data-bs-toggle="modal" data-bs-target="#TambahUser"><i class="mdi mdi-account-plus"></i> Tambah Buku</button>

                                    <!-- Modal Tambah Buku -->
                                    <div class="modal fade " id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TambahUserLabel">Tambah Buku</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../model/tambah-buku.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="modal-body">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="foto">Sampul <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8" id="previewimg">
                                                                <input type="file" name="foto" id="foto" class="form-control" required onchange="validateImg(this, 'tambah', 'foto', 'previewimg', 'fotoFeedback')" aria-describedby="fotoFeedback" accept="image/*">
                                                                <div id="fotoFeedback" class="invalid-feedback"></div>
                                                                <div class="form-text text-info">Gambar maksimal 2MB</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="judul" class="col-md-4 col-form-label">Judul Buku <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="judul" class="form-control" id="judul" required maxlength="200">
                                                            </div>
                                                        </div>
                                                        <div class=" mb-3 row">
                                                            <label for="penerbit" class="col-md-4 col-form-label">Penerbit <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="200" name="penerbit" id="penerbit" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="isbn" class="col-md-4 col-form-label">ISBN <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="100" name="isbn" id="isbn" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="pengarang" class="col-md-4 col-form-label">Pengarang <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="200" name="pengarang" id="pengarang" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="jumhal" class="col-md-4 col-form-label">Jumlah Halaman <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="4" onkeypress="return toNumber(event)" name="jumhal" id="jumhal" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="jumstok" class="col-md-4 col-form-label">Jumlah Stok <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" maxlength="3" onkeypress="return toNumber(event)" name="jumstok" id="jumstok" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="thnterbit<?= $row['id']; ?>" class="col-md-4 col-form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="thnterbit" id="thnterbit<?= $row['id']; ?>" class="form-select">
                                                                    <?php for ($i = 1900; $i <= date('Y'); $i++) : ?>
                                                                        <?php if ($i == date('Y')) : ?>
                                                                            <option selected value="<?= $i; ?>"><?= $i; ?></option>
                                                                            <?php continue; ?>
                                                                        <?php endif; ?>
                                                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="sinopsis">Sinopsis <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <textarea name="sinopsis" id="sinopsis" cols="38" rows="3" class="form-control" maxlength="200" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambah" id="tambah" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Tambah -->

                                    <a href="print/cetak-buku.php" target="_blank" class="btn btn-secondary text-white text-center mb-2"><i class="mdi mdi-account-plus"></i> Cetak Data Buku</a>
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

                                            $.get('ajax-view/buku.php?search=' + search, function(data) {
                                                $('#table-buku').html(data);
                                            })
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col table-responsive" id="table-buku">
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
                            </div>
                            <div class="mt-4">
                                <?php if (mysqli_num_rows($jumData) > $jumlahDataPerHalaman) : ?>
                                    <div class="col">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end">
                                                <?php if ($halamanAktif > 1) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="buku.php?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Previous</span>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                    <?php if ($i == $halamanAktif) : ?>
                                                        <li class="page-item active" aria-current="page">
                                                            <span class="page-link"><a href="buku.php?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                                        </li>
                                                    <?php else : ?>
                                                        <li class="page-item"><a class="page-link" href="buku.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="buku.php?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
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

    <?php $books = mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0'"); ?>
    <?php foreach ($books as $row) : ?>
        <!-- Modal Edit Buku -->
        <div class="modal fade " id="Edit<?= $row['id']; ?>" tabindex="-1" aria-labelledby="EditBuku" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditBuku">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../model/edit-buku.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label" for="foto<?= $row['id']; ?>">Foto</label>
                                <div class="col-sm-8" id="preview<?= $row['id']; ?>">
                                    <input type="file" name="foto" id="foto<?= $row['id']; ?>" class="form-control" onchange="validateImg(this, 'edit', 'foto<?= $row['id']; ?>', 'preview<?= $row['id']; ?>', 'fotoFeedback<?= $row['id']; ?>')" aria-describedby="fotoFeedback" accept="image/*">
                                    <div id="fotoFeedback<?= $row['id']; ?>" class="invalid-feedback"></div>
                                    <div class="form-text text-info">Gambar maksimal 2MB</div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul<?= $row['id']; ?>" class="col-md-4 col-form-label">Judul Buku <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $row['judul']; ?>" name="judul" class="form-control" id="judul<?= $row['id']; ?>" required maxlength="200">
                                </div>
                            </div>
                            <div class=" mb-3 row">
                                <label for="penerbit<?= $row['id']; ?>" class="col-md-4 col-form-label">Penerbit <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="200" value="<?= $row['penerbit']; ?>" name="penerbit" id="penerbit<?= $row['id']; ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="isbn<?= $row['id']; ?>" class="col-md-4 col-form-label">ISBN <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="100" name="isbn" id="isbn<?= $row['id']; ?>" required class="form-control" value="<?= $row['isbn']; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pengarang<?= $row['id']; ?>" class="col-md-4 col-form-label">Pengarang <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $row['pengarang']; ?>" maxlength="200" name="pengarang" id="pengarang<?= $row['id']; ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumhal<?= $row['id']; ?>" class="col-md-4 col-form-label">Jumlah Halaman <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="4" value="<?= $row['jumlah_halaman']; ?>" onkeypress="return toNumber(event)" name="jumhal" id="jumhal<?= $row['id']; ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumstok<?= $row['id']; ?>" class="col-md-4 col-form-label">Jumlah Stok <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" maxlength="3" onkeypress="return toNumber(event)" value="<?= $row['jumlah_stok']; ?>" name="jumstok" id="jumstok<?= $row['id']; ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="thnterbit<?= $row['id']; ?>" class="col-md-4 col-form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="thnterbit" id="thnterbit<?= $row['id']; ?>" class="form-select">
                                        <?php for ($i = 1900; $i <= date('Y'); $i++) : ?>
                                            <?php if ($i == $row['tahun_terbit']) : ?>
                                                <option selected value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label" for="sinopsis<?= $row['id']; ?>">Sinopsis <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="sinopsis" id="sinopsis<?= $row['id']; ?>" cols="38" rows="3" class="form-control" maxlength="200" required><?= $row['sinopsis']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit" id="edit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->

        <!-- Modal Delete -->
        <div class="modal fade " id="Hapus<?= $row['id']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="HapusLabel">Hapus Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="../public/img/buku/<?= $row['gambar']; ?>" alt="Sampul" width="150" class="mx-auto d-block img-thumbnail rounded" loading="lazy">
                        <p>Anda yakin ingin menghapus buku <strong><?= $row['judul']; ?></strong> dengan ID <strong>BK<?= sprintf("%04d", $row['id']); ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="../model/delete-buku.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="hapus" class="btn btn-danger text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Delete -->

        <!-- Modal Detail -->
        <div class="modal fade " id="Detail<?= $row['id']; ?>" tabindex="-1" aria-labelledby="DetailLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DetailLabel">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="../public/img/buku/<?= $row['gambar']; ?>" alt="Sampul <?= $row['judul']; ?>" class="img-thumbnail rounded mx-auto d-block" width="200px">
                        <hr>
                        <h5 class="text-center mb-5"><?= $row['judul']; ?></h5>

                        <table class="table">
                            <tr>
                                <td>
                                    Kode Buku
                                </td>
                                <td> : </td>
                                <td>BK<?= sprintf("%04d", $row['id']); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Pengarang
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['pengarang']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Penerbit
                                </td>
                                <td> : </td>
                                <td><?= $row['penerbit']; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    ISBN
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['isbn']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tahun Terbit
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['tahun_terbit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jumlah Halaman
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['jumlah_halaman']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Jumlah Persediaan
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['jumlah_stok']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sinopsis
                                </td>
                                <td> : </td>
                                <td>
                                    <?= $row['sinopsis']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Detail -->
    <?php endforeach; ?>


    <?php include 'footer.php'; ?>

</body>

</html>