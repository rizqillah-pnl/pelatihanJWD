<?php
include '../controller/koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$hak_akses = $_SESSION['user']['hak_akses'];

$jumlahDataPerHalaman = 5;
$jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM tb_anggota WHERE deleted='0'"));
$jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$anggota = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE deleted='0' ORDER BY id_anggota DESC LIMIT $awalData, $jumlahDataPerHalaman");


$kode = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'");
if (mysqli_num_rows($result) == 0) {
    header("Location: login.php");
}

$result = mysqli_fetch_assoc($result);


date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anggota | RZQ Perpus</title>
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
                                                <form action="../model/tambah-anggota.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="modal-body">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="foto">Foto <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8" id="previewimg">
                                                                <input type="file" name="foto" id="foto" class="form-control" required onchange="validateImg(this, 'tambah', 'foto', 'previewimg', 'fotoFeedback')" aria-describedby="fotoFeedback" accept="image/*">
                                                                <div id="fotoFeedback" class="invalid-feedback"></div>
                                                                <div class="form-text text-info">Gambar maksimal 2MB</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="nama" class="col-md-4 col-form-label">Nama Anggota <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="nama" class="form-control" id="nama" required maxlength="100">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="nohp" class="col-md-4 col-form-label">No HP <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="tel" name="nohp" class="form-control" id="nohp" required maxlength="15" onkeypress="return toNumber(event)" pattern="^(\+62|62|0)8[1-9][0-9]{7,12}$">
                                                                <div class="invalid-feedback" id="hp">
                                                                    Nomor HP tidak valid!
                                                                </div>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $('#nohp').on('keyup', function() {
                                                                            let nohp = document.getElementById('nohp');
                                                                            let submit = document.getElementById('tambah');

                                                                            if (!nohp.value.match(/^(^\+62|62|0)8[1-9][0-9]{7,12}$/g)) {
                                                                                submit.disabled = true;
                                                                                nohp.classList.add('is-invalid');
                                                                            } else {
                                                                                submit.disabled = false;
                                                                                nohp.classList.remove('is-invalid');
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>

                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="radio" name="jkel" id="laki" required value="L"> <label for="laki">Laki-laki</label>
                                                                <input type="radio" name="jkel" id="perempuan" required value="P"> <label for="perempuan">Perempuan</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <textarea name="alamat" id="alamat" cols="38" rows="3" class="form-control" maxlength="200" required></textarea>
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

                                    <a href="print/cetak.php" target="_blank" class="btn btn-secondary text-white text-center mb-2"><i class="mdi mdi-account-plus"></i> Cetak Data Anggota</a>
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
                                                    <td>AG<?= sprintf("%03d", $row['id_anggota']); ?></td>
                                                    <td class="text-wrap" style="width: 200px;"><?= $row['nama']; ?></td>
                                                    <td class="text-center"><img src="../public/img/anggota/<?= $row['foto']; ?>" alt="Profil <?= $row['nama']; ?>" width="80" height="80"></td>
                                                    <td class="text-center"><?= ($row['jkel'] == "L") ? "Laki-laki" : "Perempuan"; ?></td>
                                                    <td class="text-wrap" style="width: 250px; text-align: justify;"><?= $row['alamat']; ?></td>
                                                    <td><?= $row['nohp']; ?></td>
                                                    <td class="text-center">
                                                        <div class="row" style="width: 170px;">
                                                            <div class="col">
                                                                <a href="print/cetak.php?id=<?= $row['id_anggota']; ?>" name="id-card" class="btn btn-success text-white mb-2" target="_blank"><i class="bi bi-printer"></i></a>
                                                                <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['id_anggota']; ?>"><i class="bi bi-pencil"></i></button>
                                                                <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#Hapus<?= $row['id_anggota']; ?>"><i class="bi bi-trash"></i></button>
                                                            </div>
                                                        </div>
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
                                <?php $jumData = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE deleted='0'"); ?>
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
                    <form action="../model/edit-anggota.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="idAnggota" value="<?= $row['id_anggota']; ?>">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label" for="foto<?= $row['id_anggota']; ?>">Foto </label>
                                <div class="col-sm-8" id="preview<?= $row['id_anggota']; ?>">
                                    <input type="file" name="foto" id="foto<?= $row['id_anggota']; ?>" class="form-control" onchange="validateImg(this, 'edit', 'foto<?= $row['id_anggota']; ?>', 'preview<?= $row['id_anggota']; ?>', 'fotoFeedback<?= $row['id_anggota']; ?>')" aria-describedby="fotoFeedback" accept="image/*">
                                    <div id="fotoFeedback<?= $row['id_anggota']; ?>" class="invalid-feedback"></div>
                                    <div class="form-text text-info">Gambar maksimal 2MB</div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama<?= $row['id_anggota']; ?>" class="col-md-4 col-form-label">Nama Anggota <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control" id="nama<?= $row['id_anggota']; ?>" required maxlength="100" value="<?= $row['nama']; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nohp<?= $row['id_anggota']; ?>" class="col-md-4 col-form-label">No HP <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="tel" name="nohp" class="form-control" id="nohp<?= $row['id_anggota']; ?>" required maxlength="15" onkeypress="return toNumber(event)" value="<?= $row['nohp']; ?>" pattern="^(\+62|62|0)8[1-9][0-9]{7,12}$">
                                    <div class="invalid-feedback">
                                        Nomor HP tidak valid!
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        let id = "<?= $row['id_anggota']; ?>";
                                        $('#nohp' + id).on('keyup', function() {
                                            let nohp = document.getElementById('nohp' + id);
                                            let submit = document.getElementById('edit' + id);

                                            if (!nohp.value.match(/^(^\+62|62|0)8[1-9][0-9]{7,12}$/g)) {
                                                submit.disabled = true;
                                                nohp.classList.add('is-invalid');
                                            } else {
                                                submit.disabled = false;
                                                nohp.classList.remove('is-invalid');
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
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
                                <label class="col-md-4 col-form-label" for="alamat<?= $row['id_anggota']; ?>">Alamat <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" id="alamat<?= $row['id_anggota']; ?>" cols="38" rows="3" class="form-control" maxlength="200" required><?= $row['alamat']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit" id="edit<?= $row['id_anggota']; ?>" class="btn btn-primary">Simpan</button>
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
                        <img src="../public/img/anggota/<?= $row['foto']; ?>" alt="Profil" width="100" loading="lazy" class="mx-auto d-block rounded img-thumbnail">
                        <p>Anda yakin ingin menghapus anggota dengan nama <strong><?= $row['nama']; ?></strong>?</p>
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