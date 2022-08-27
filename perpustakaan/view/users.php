<?php
include '../controller/koneksi.php';

$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

if ($result['hak_akses'] != "1") {
    header("Location: index.php");
}

$hak_akses = $_SESSION['user']['hak_akses'];

$jumlahDataPerHalaman = 10;
$jumData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM tb_user WHERE deleted='0'"));
$jumlahHalaman = ceil($jumData['COUNT(*)'] / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$users = mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0' ORDER BY hak_akses, id DESC LIMIT $awalData, $jumlahDataPerHalaman");


date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users | RZQ Perpus</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == 200) : ?>
            <script>
                swal("Berhasil!", `User baru berhasil ditambahkan!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 300) : ?>
            <script>
                swal("Gagal!", `User gagal ditambahkan!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 201) : ?>
            <script>
                swal("Berhasil!", `Data User berhasil diedit!`, "success", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 301) : ?>
            <script>
                swal("Gagal!", `Data User Gagal Diedit!`, "error", {
                    timer: 2000,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 202) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Berhasil!", `Data User ${nama} Berhasil Dihapus!`, "success", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 302) : ?>
            <script>
                let nama = '<?= $_SESSION['nama']; ?>'
                swal("Gagal!", `Data User ${nama} Gagal Dihapus!`, "error", {
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
                            <span>Data Users</span>
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
                            <h2 class="card-title mb-0">Data Users</h2>
                        </div>
                        <div class="container-fluid mt-4">
                            <div class="col-lg mb-2">
                                <div class="mb-0">
                                    <button type="button" class="btn btn-primary text-white text-center mb-2" data-bs-toggle="modal" data-bs-target="#TambahUser"><i class="mdi mdi-account-plus"></i> Tambah User</button>

                                    <!-- Modal Tambah Users -->
                                    <div class="modal fade " id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TambahUserLabel">Tambah User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../model/tambah-user.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="modal-body">
                                                        <div class="mb-3 row">
                                                            <label class="col-md-4 col-form-label" for="foto">Foto Profil <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8" id="previewimg">
                                                                <input type="file" name="foto" id="foto" class="form-control" required onchange="validateImg(this, 'tambah', 'foto', 'previewimg', 'fotoFeedback')" aria-describedby="fotoFeedback" accept="image/*">
                                                                <div id="fotoFeedback" class="invalid-feedback"></div>
                                                                <div class="form-text text-info">Gambar maksimal 2MB</div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="username" class="col-md-4 col-form-label">Username <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="username" class="form-control" id="username" required maxlength="100" aria-describedby="inputGroupPrepend3 validationUsername">
                                                                <div class="invalid-feedback" id="validationUsername"></div>
                                                            </div>

                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#username').on('keyup', function() {
                                                                        let data = $('#username');
                                                                        let submit = document.getElementById('tambah');

                                                                        $.get("ajax-view/cek-username.php?search=" + data.val(), function(res) {
                                                                            if (res == false) {
                                                                                data.addClass('is-invalid');
                                                                                document.getElementById('validationUsername').innerHTML = "Username sudah digunakan!";
                                                                                submit.disabled = true;
                                                                            } else if (data.val() == "") {
                                                                                data.addClass('is-invalid');
                                                                                document.getElementById('validationUsername').innerHTML = "Field username tidak boleh kosong!";
                                                                                submit.disabled = true;
                                                                            } else if (data.val().length < 3) {
                                                                                data.addClass('is-invalid');
                                                                                document.getElementById('validationUsername').innerHTML = "Username harus lebih dari 3 huruf!";
                                                                                submit.disabled = true;
                                                                            } else {
                                                                                submit.disabled = false;
                                                                                data.removeClass('is-invalid');
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                        <div class=" mb-3 row">
                                                            <label for="password" class="col-md-4 col-form-label">password <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <input type="password" maxlength="200" name="password" id="password" required class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="hak_akses" class="col-md-4 col-form-label">Hak Akses <span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select name="hak_akses" class="form-select" id="hak_akses">
                                                                    <option value="1">Admin</option>
                                                                    <option value="2" selected>Operator</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="tambah" id="tambah" class="btn btn-primary" disabled>Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Tambah -->
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

                                            $.get('ajax-view/user.php?search=' + search, function(data) {
                                                $('#table-user').html(data);
                                            })
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col table-responsive" id="table-user">
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
                            </div>
                            <div class="mt-4">
                                <?php if (mysqli_num_rows($jumData) > $jumlahDataPerHalaman) : ?>
                                    <div class="col">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end">
                                                <?php if ($halamanAktif > 1) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="users.php?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                                    </li>
                                                <?php else : ?>
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Previous</span>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                    <?php if ($i == $halamanAktif) : ?>
                                                        <li class="page-item active" aria-current="page">
                                                            <span class="page-link"><a href="users.php?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                                        </li>
                                                    <?php else : ?>
                                                        <li class="page-item"><a class="page-link" href="users.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                    <li class="page-item">
                                                        <span class="page-link"><a href="users.php?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
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

    <?php $users = mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0'"); ?>
    <?php foreach ($users as $row) : ?>
        <?php if ($row['id'] == $result['id']) {
            continue;
        } ?>
        <!-- Modal Edit User -->
        <div class="modal fade " id="Edit<?= $row['id']; ?>" tabindex="-1" aria-labelledby="EditUser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditUser">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../model/edit-user.php" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                <label for="nama<?= $row['id']; ?>" class="col-md-4 col-form-label">Nama <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $row['nama']; ?>" name="nama" class="form-control" id="nama<?= $row['id']; ?>" required maxlength="200" aria-describedby="validationNama">
                                    <div id="validationNama<?= $row['id']; ?>" class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    let id = '<?= $row['id']; ?>';

                                    $('#nama' + id).on('keyup', function() {
                                        let data = $('#nama' + id);
                                        let submit = document.getElementById('edit' + id);

                                        if (data.val() == "") {
                                            data.addClass('is-invalid');
                                            document.getElementById('validationNama' + id).innerHTML = "Field nama tidak boleh kosong!";
                                            submit.disabled = true;
                                        } else if (data.val().length < 3) {
                                            data.addClass('is-invalid');
                                            document.getElementById('validationNama' + id).innerHTML = "Nama harus lebih dari 3 huruf!";
                                            submit.disabled = true;
                                        } else {
                                            submit.disabled = false;
                                            data.removeClass('is-invalid');
                                        }
                                    })
                                });
                            </script>

                            <?php if ($row['hak_akses'] != "1") : ?>
                                <div class="mb-3 row">
                                    <label for="password<?= $row['id']; ?>" class="col-md-4 col-form-label">Ganti Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control" id="password<?= $row['id']; ?>" maxlength="200">
                                        <div class="form-text text-info">Boleh dikosongkan!</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit" id="edit<?= $row['id']; ?>" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->

        <?php if ($row['hak_akses'] != "1") : ?>
            <!-- Modal Delete -->
            <div class="modal fade " id="Hapus<?= $row['id']; ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="HapusLabel">Hapus Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="../public/img/user/<?= $row['foto']; ?>" alt="Profil" width="200" class="d-block mx-auto img-thumbnail rounded">
                            Anda yakin ingin menghapus akun <strong><?= $row['nama']; ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="../model/delete-user.php" method="POST">
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