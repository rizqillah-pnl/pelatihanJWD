<?php
include '../controller/koneksi.php';
include '../model/getAPI.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

$hak_akses = $_SESSION['user']['hak_akses'];
$kode = $_SESSION['user']['id'];

date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i');
mysqli_query($conn, "UPDATE tb_user SET last_log='$now' WHERE id='$kode'");

$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$kode'"));

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
        let nama = "<?= $_SESSION['user']['nama']; ?>"
        swal("Berhasil!", `Selamat Datang ${nama}`, "success", {
          timer: 2000,
          button: false,
        });
      </script>
    <?php endif; ?>
  <?php endif;
  unset($_SESSION['pesan']);
  ?>

  <!-- Sidebar-->
  <nav class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
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
      <li class="nav-item"><a class="nav-link active" href="index.php">
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
  </nav>
  <!-- Sidebar End -->


  <!-- MAIN SECTION -->
  <main class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <?php include 'header.php'; ?>
      <div class="header-divider"></div>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <div class="body flex-grow-1 px-3">
      <div class="container-fluid">
        <h2 class="text-center">SELAMAT DATANG</h2>
        <!-- /.row-->
        <div class="card mb-4">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title mb-0">Traffic Data</h4>
                <div class="small text-medium-emphasis">All Time</div>
              </div>
            </div>
          </div>
          <div class="card-footer bg-white">
            <div class="row row-cols-1 row-cols-md-3 text-center mx-auto">
              <div class="col mb-sm-3 mx-auto mb-3 border-start border-start-4 border-start-secondary px-3 mb-3">
                <div class="text-medium-emphasis">Buku</div>
                <div class="fw-semibold"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_buku WHERE deleted='0'")); ?> buku</div>
                <!-- <div class="progress progress-thin mt-2">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
              </div>
              <div class="col mb-sm-3 mx-auto mb-3 border-start border-start-4 border-start-success px-3 mb-3">
                <div class="text-medium-emphasis">Anggota</div>
                <div class="fw-semibold"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_anggota WHERE deleted='0'")); ?> member</div>
              </div>
              <div class="col mb-sm-3 mx-auto mb-3 border-start border-start-4 border-start-danger px-3 mb-3">
                <div class="text-medium-emphasis">Users</div>
                <div class="fw-semibold"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_user WHERE deleted='0'")); ?> user</div>
              </div>
              <?php
              $numPinjam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE deleted='0'")); ?>
              <?php
              $numKembali = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengembalian WHERE deleted='0'"));
              ?>
              <div class="col mb-sm-3 mx-auto mb-3 border-start border-start-4 border-start-warning px-3 mb-3">
                <div class="text-medium-emphasis">Peminjaman</div>
                <div class="fw-semibold"><?= $numPinjam; ?> pinjam</div>
              </div>
              <div class="col mb-sm-3 mx-auto mb-3 border-start border-start-4 border-start-primary px-3 mb-3">
                <div class="text-medium-emphasis">Pengembalian</div>
                <div class="fw-semibold"><?= $numKembali; ?> dikembalikan</div>
              </div>
            </div>
          </div>
        </div>




        <!-- MEDSOS -->
        <!-- /.card.mb-4-->
        <div class="row" id="medsos">
          <?php
          // include '../../model/getAPI.php';
          $tokenGitHub = "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";

          $url = "https://api.github.com/search/users?q=rizqillah-pnl";
          $obj = getData($url, $tokenGitHub);

          $url2 = "https://api.github.com/users/rizqillah-pnl/followers";
          $obj2 = getData($url2, $tokenGitHub);

          $url3 = "https://api.github.com/users/rizqillah-pnl/repos";
          $obj3 = getData($url3, $tokenGitHub);

          ?>

          <!-- <div class="col-sm-6 col-lg-4">
            <div class="card mb-4" style="--cui-card-cap-bg: #3b5998">
              <div class="card-header position-relative d-flex justify-content-center align-items-center">
                <svg class="icon icon-3xl text-white my-4">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                </svg>
                <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                  <canvas id="social-box-chart-1" height="90"></canvas>
                </div>
              </div>
              <div class="card-body row text-center">
                <div class="col">
                  <div class="fs-5 fw-semibold">89k</div>
                  <div class="text-uppercase text-medium-emphasis small">friends</div>
                </div>
                <div class="vr"></div>
                <div class="col">
                  <div class="fs-5 fw-semibold">459</div>
                  <div class="text-uppercase text-medium-emphasis small">feeds</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card mb-4" style="--cui-card-cap-bg: #C13584">
              <div class="card-header position-relative d-flex justify-content-center align-items-center">
                <svg class="icon icon-3xl text-white my-4">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/brand.svg#cib-instagram"></use>
                </svg>
                <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                  <canvas id="social-box-chart-2" height="90"></canvas>
                </div>
              </div>
              <div class="card-body row text-center">
                <div class="col">
                  <div class="fs-5 fw-semibold">973k</div>
                  <div class="text-uppercase text-medium-emphasis small">Followers</div>
                </div>
                <div class="vr"></div>
                <div class="col">
                  <div class="fs-5 fw-semibold">1.792</div>
                  <div class="text-uppercase text-medium-emphasis small">Feed</div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- /.col-->
          <div class="col-sm-6 col-lg-4 mx-auto">
            <div class="card mb-4" style="--cui-card-cap-bg: #24292f">
              <div class="card-header position-relative d-flex justify-content-center align-items-center">
                <svg class="icon icon-3xl text-white my-4">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/brand.svg#cib-github"></use>
                </svg>
                <div class="chart-wrapper position-absolute top-0 ms-auto w-100 h-100">
                  <a href="<?= $obj['items'][0]['html_url']; ?>" target="_blank">
                    <img src="<?= $obj['items'][0]['avatar_url']; ?>" alt="Profil Github" height="60">
                  </a>
                </div>
              </div>
              <div class="card-body row text-center">
                <div class="col">
                  <div class="fs-5 fw-semibold"><?= count($obj2); ?></div>
                  <div class="text-uppercase text-medium-emphasis small">Followers</div>
                </div>
                <div class="vr"></div>
                <div class="col">
                  <div class="fs-5 fw-semibold"><?= count($obj3); ?></div>
                  <div class="text-uppercase text-medium-emphasis small">Repo</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
      </div>
    </div>

    <footer class="footer">
      <div><a href="https://github.com/rizqillah-pnl" target="_blank" style="text-decoration: none;">RIZQILLAH</a></div>
      <div class="ms-auto">&copy; 2022 All Right Reserved</div>
    </footer>
  </main>


  <?php include 'footer.php'; ?>

</body>

</html>