<?php
include 'controller/koneksi.php';
if (isset($_GET['id'])) :
  $id = $_GET['id'];
  $data = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='$id'");

  if (mysqli_num_rows($data) != 0) :
    $anggota = mysqli_fetch_assoc($data);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <base href="./">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta name="description" content="RZQ Perpus - Dashboard">
      <meta name="author" content="Rizqillah">
      <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

      <link rel="icon" type="image/png" sizes="192x192" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="16x16" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="96x96" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="32x32" href="public/logo.svg">
      <!-- Vendors styles-->
      <link rel="stylesheet" href="vendor/coreUI/vendors/simplebar/css/simplebar.css">
      <link rel="stylesheet" href="public/css/vendors/simplebar.css">
      <!-- Main styles for this application-->
      <link href="public/css/style.css" rel="stylesheet">
      <script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <title>Data Anggota | <?= $anggota['nama']; ?></title>
    </head>

    <body>
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
          <a class="header-brand d-md-none" href="index.php">
            <div>
              RZQ Perpustakaan
              <i class="bi bi-book" style="font-size: 20px;"></i>
            </div>
          </a>
          <a class="header-nav mx-auto text-decoration-none text-dark" href="index.php">
            <div class="" style="font-size: 25px;">
              RZQ Perpustakaan
              <i class="bi bi-book" style="font-size: 20px; margin-left: 10px;"></i>
            </div>
          </a>
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
        </div>
      </header>

      <div class="container">
        <div class="row">
          <div class="col-3">
            <img src="public/img/anggota/<?= $anggota['foto']; ?>" alt="Foto Profil" style="width: 30vh;" class="img-thumbnail rounded">
          </div>
          <div class="col">
            <table>
              <tr>
                <td>Nama</td>
                <td></td>
                <td></td>
                <td> : </td>
                <td></td>
                <td></td>
                <td class="fw-semibold"><?= $anggota['nama']; ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td></td>
                <td></td>
                <td> : </td>
                <td></td>
                <td></td>
                <td class="fw-semibold"><?= ($anggota['jkel'] == "L") ? "Laki-laki" : "Perempuan" ?></td>
              </tr>
              <tr>
                <td>Nomor HP</td>
                <td></td>
                <td></td>
                <td> : </td>
                <td></td>
                <td></td>
                <td class="fw-semibold"><?= $anggota['nohp']; ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td></td>
                <td></td>
                <td> : </td>
                <td></td>
                <td></td>
                <td class="fw-semibold"><?= $anggota['alamat']; ?></td>
              </tr>

            </table>

            <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" fill="#2cfc03" class="bi bi-check-circle mt-3" viewBox="0 0 16 16" loading="lazy">
              <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
              <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
            </svg>
          </div>
        </div>

      </div>

      <!-- CoreUI and necessary plugins-->
      <script src="vendor/coreUI/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
      <script src="vendor/coreUI/vendors/simplebar/js/simplebar.min.js"></script>
      <script src="vendor/coreUI/vendors/@coreui/utils/js/coreui-utils.js"></script>
    </body>

    </html>

  <?php else : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <base href="./">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta name="description" content="RZQ Perpus - Dashboard">
      <meta name="author" content="Rizqillah">
      <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

      <link rel="icon" type="image/png" sizes="192x192" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="16x16" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="96x96" href="public/logo.svg">
      <link rel="icon" type="image/png" sizes="32x32" href="public/logo.svg">
      <!-- Vendors styles-->
      <link rel="stylesheet" href="vendor/coreUI/vendors/simplebar/css/simplebar.css">
      <link rel="stylesheet" href="public/css/vendors/simplebar.css">
      <!-- Main styles for this application-->
      <link href="public/css/style.css" rel="stylesheet">
      <script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <title>Data Anggota | Tidak Ditemukan</title>
    </head>

    <body>
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
          <a class="header-brand d-md-none" href="index.php">
            <div>
              RZQ Perpustakaan
              <i class="bi bi-book" style="font-size: 20px;"></i>
            </div>
          </a>
          <a class="header-nav mx-auto text-decoration-none text-dark" href="index.php">
            <div class="" style="font-size: 25px;">
              RZQ Perpustakaan
              <i class="bi bi-book" style="font-size: 20px; margin-left: 10px;"></i>
            </div>
          </a>
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
        </div>
      </header>

      <div class="container">
        <div class="row">
          <h1 class="text-center">Data Tidak Ditemukan!</h1>

          <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="red" class="bi bi-shield-x" viewBox="0 0 16 16">
            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
            <path d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z" />
          </svg>

          <div class="text-center mt-4">
            <div>
              Anda akan dialihkan ke halaman awal dalam waktu <strong><span id="time">Loading...</span></strong>
            </div>
          </div>

          <script>
            var time = 15;
            setInterval(function() {
              var seconds = time % 60;
              var minutes = (time - seconds) / 60;
              if (seconds.toString().length == 1) {
                seconds = "0" + seconds;
              }
              if (minutes.toString().length == 1) {
                minutes = "0" + minutes;
              }
              document.getElementById("time").innerHTML = minutes + ":" + seconds;
              time--;
              if (time == 0) {
                window.location.href = "index.php";
              }
            }, 1000);
          </script>

        </div>
      </div>

      </div>

      <!-- CoreUI and necessary plugins-->
      <script src="vendor/coreUI/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
      <script src="vendor/coreUI/vendors/simplebar/js/simplebar.min.js"></script>
      <script src="vendor/coreUI/vendors/@coreui/utils/js/coreui-utils.js"></script>
    </body>

    </html>
  <?php endif; ?>

<?php
else :
  header("Location: view/index.php");
endif;
?>