<?php
include '../controller/koneksi.php';

$kode = $_SESSION['user']['id'];
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode' AND deleted='0'"));

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$hak_akses = $result['hak_akses'];


date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile | RZQ Perpus</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == 200) : ?>
            <script>
                swal("Berhasil!", `Profile berhasil diperbarui!`, "success", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 300) : ?>
            <script>
                swal("Gagal!", `Profile gagal diperbarui!`, "error", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 201) : ?>
            <script>
                swal("Berhasil!", `Password berhasil diperbarui!`, "success", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 301) : ?>
            <script>
                swal("Gagal!", `Password gagal diperbarui!`, "error", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 302) : ?>
            <script>
                swal("Gagal!", `Password lama salah!`, "warning", {
                    timer: 2500,
                    button: false,
                });
            </script>
        <?php elseif ($pesan == 303) : ?>
            <script>
                swal("Gagal!", `Password baru sama dengan password lama!`, "warning", {
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
                            <span>Settings</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Profile <?= $result['nama']; ?></span>
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
                        <div class="container-fluid mt-4">
                            <div class="row">
                                <div class="col-lg-6 col-12 col-sm-12 mb-5">
                                    <h4 class="card-title mb-3">Edit Profile</h4>
                                    <form action="../model/update-profile.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-material mx-2 needs-validation">
                                        <div class="mb-3 row">
                                            <label class="form-label col-lg-4" for="foto">Foto</label>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col" id="previewimg">
                                                <input type="file" name="foto" id="foto" class="form-control" onchange="validateImg(this, 'tambah', 'foto', 'previewimg', 'fotoFeedback')" aria-describedby="fotoFeedback" accept="image/*">
                                                <div id="fotoFeedback" class="invalid-feedback"></div>
                                                <div class="form-text text-info">Gambar maksimal 2MB</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="form-label col-lg-4">Nama <span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col">
                                                <input type="text" name="nama" class="form-control" id="nama" required maxlength="100" value="<?= $result['nama']; ?>" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#nama').on('keyup', function() {
                                                    let nama = $('#nama').val();
                                                    let submit = document.getElementById('update');
                                                    nama = nama.trim();

                                                    if (nama == "") {
                                                        submit.disabled = true;
                                                    } else {
                                                        submit.disabled = false;

                                                    }
                                                });
                                            });
                                        </script>

                                        <div class="form-group text-end">
                                            <div class="col-sm-12">
                                                <button type="submit" id="update" name="edit" class="btn btn-success text-white">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-12">
                                    <h4 class="card-title mb-3">Update Password</h4>
                                    <form action="../model/update-profile.php" method="POST" class="form-horizontal form-material mx-2 needs-validation">

                                        <div class="mb-3 row">
                                            <label for="passlama" class="form-label col-lg-4">Password Lama <span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col">
                                                <input type="password" name="passlama" class="form-control" id="passlama" required maxlength="100">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="passbaru" class="form-label col-lg-4">Password Baru <span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col">
                                                <input type="password" name="passbaru" class="form-control" id="passbaru" required maxlength="100">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="passkon" class="form-label col-lg-4">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col">
                                                <input type="password" name="passkon" class="form-control" id="passkon" required maxlength="100">
                                                <div class="invalid-feedback">
                                                    Konfirmasi Password salah!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-sm-12 col-md-12 col-lg-8 col-12">
                                                <input type="checkbox" id="show-password" onclick="showPass()">
                                                <label for="show-password">Show Password</label>
                                            </div>
                                        </div>

                                        <div class="form-group text-end">
                                            <div class="col-sm-12">
                                                <button type="submit" id="update-password" name="update-password" class="btn btn-danger text-white" disabled>Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                    <script>
                                        function showPass() {
                                            var x = document.getElementById("passbaru");
                                            var y = document.getElementById("passkon");
                                            var z = document.getElementById("passlama");

                                            if (x.type === "password" && y.type === "password" && z.type === "password") {
                                                x.type = "text";
                                                y.type = "text";
                                                z.type = "text";
                                            } else {
                                                x.type = "password";
                                                y.type = "password";
                                                z.type = "password";
                                            }
                                        }

                                        $(document).ready(function() {
                                            $('#passlama').on('keyup', function() {
                                                let passlama = document.getElementById('passlama').value;
                                                let password = document.getElementById('passbaru').value;
                                                let passkon = document.getElementById('passkon').value;
                                                let submit = document.getElementById('update-password');


                                                if (passlama == "" || password == "" || passkon == "") {
                                                    submit.disabled = true;
                                                } else {
                                                    submit.disabled = false;
                                                }
                                            })

                                            $('#password').on('keyup', function() {
                                                let passlama = document.getElementById('passlama').value;
                                                let password = document.getElementById('passbaru').value;
                                                let passkon = document.getElementById('passkon').value;
                                                let submit = document.getElementById('update-password');


                                                if (passlama == "" || password == "" || passkon == "") {
                                                    submit.disabled = true;
                                                } else {
                                                    submit.disabled = false;
                                                }
                                            })

                                            $('#passkon').on('keyup', function() {
                                                let passlama = document.getElementById('passlama').value;
                                                let password = document.getElementById('passbaru').value;
                                                let passkon = document.getElementById('passkon').value;
                                                let submit = document.getElementById('update-password');


                                                if (passlama == "" || password == "" || passkon == "") {
                                                    submit.disabled = true;
                                                } else {
                                                    submit.disabled = false;
                                                }
                                            })

                                            $('#passkon').on('keyup', function() {
                                                let password = document.getElementById('passbaru');
                                                let passkon = document.getElementById('passkon');
                                                let submit = document.getElementById('update-password');

                                                if (passkon.value == "") {
                                                    passkon.classList.remove('is-invalid');
                                                } else if (password.value != passkon.value) {
                                                    passkon.classList.add('is-invalid');
                                                    submit.disabled = true;
                                                } else {
                                                    passkon.classList.remove('is-invalid');
                                                    submit.disabled = false;
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="text-end mt-5">
                                <span class="text-dark">- Tanda (<span class="text-danger">*</span>) Wajib diisi!</span>
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



    <?php include 'footer.php'; ?>

</body>

</html>