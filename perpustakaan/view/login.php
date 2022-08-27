<?php

include '../controller/koneksi.php';

if (isset($_SESSION['user'])) {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login | RZQ Perpus</title>
  <?php include 'meta.php'; ?>
</head>

<body>

  <?php if (isset($_SESSION['message'])) :
    $message = $_SESSION['message'];
  ?>
    <?php if ($message == "404" || $message == "400") : ?>
      <script>
        swal("Gagal!", "Username / Password Salah!", "error", {
          timer: 1300,
          button: false,
        });
      </script>
    <?php endif; ?>
  <?php endif;
  unset($_SESSION['message']);
  ?>


  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10 col-md-10 col-lg-8 col-sm-12">
          <div class="card-group d-block d-md-flex row p-2" style="height: 400px;">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1 class="text-center">Login</h1>
                <p class="text-medium-emphasis text-center mb-5">Sign in With Your Account!</p>
                <form action="../model/login.php" method="post" autocomplete="off">
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" type="text" placeholder="Username" name="username" autofocus id="username" maxlength="100" value="<?= (isset($_SESSION['username'])) ? $_SESSION['username'] : ""; ?>" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" type="password" placeholder="Password" name="password" id="password" maxlength="100">
                  </div>
                  <div class="row">
                    <div class="col text-end">
                      <button id="login" class="btn btn-primary px-5 fw-semibold" type="submit" name="login" disabled>Login <i class="bi bi-box-arrow-in-right" style="margin-left: 10px;"></i></button>
                    </div>
                    <script>
                      $(document).ready(function() {
                        $('#username').on('keyup', function() {
                          let username = document.getElementById('username').value;
                          let password = document.getElementById('password').value;
                          let login = document.getElementById('login');


                          if (username == "" || password == "") {
                            login.disabled = true;
                          } else {
                            login.disabled = false;
                          }
                        })

                        $('#password').on('keyup', function() {
                          let username = document.getElementById('username').value;
                          let password = document.getElementById('password').value;
                          let login = document.getElementById('login');


                          if (username == "" || password == "") {
                            login.disabled = true;
                          } else {
                            login.disabled = false;
                          }
                        })
                      });
                    </script>
                  </div>
                </form>
              </div>
            </div>
            <div class="card d-none d-lg-block d-md-block col-md-5 text-white bg-primary py-5">
              <div class="card-body text-center">
                <div>
                  <h3>RIZQILLAH LIBRARY</h3>
                  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae in ipsam veritatis corporis cumque? Vero earum optio soluta quod! Reprehenderit sequi provident explicabo. Totam sunt maxime, molestiae culpa debitis natus aliquid?</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>

</html>