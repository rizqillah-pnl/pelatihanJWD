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
    <!-- <ul class="header-nav d-none d-md-flex">
          <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="anggota.php">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="buku.php">Buku</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        </ul> -->
    <div class="header-nav d-none d-md-flex mx-auto" style="font-size: 25px;">
        RZQ Perpustakaan
        <i class="bi bi-book" style="font-size: 20px; margin-left: 10px;"></i>
    </div>
    <!-- <ul class="header-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                    <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg></a></li> -->
    <!-- <li class="nav-item"><a class="nav-link" href="#">
              <svg class="icon icon-lg">
                <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
              </svg></a></li>
          <li class="nav-item"><a class="nav-link" href="#">
              <svg class="icon icon-lg">
                <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
              </svg></a></li> -->
    <!-- </ul> -->
    <ul class="header-nav ms-3">
        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span style="margin-right: 7px;"><?= $result['nama']; ?></span>
                <div class="avatar avatar-md">
                    <img class="avatar-img" src="../public/img/user/<?= $_SESSION['user']['foto']; ?>" alt="user@email.com">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <!-- <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Account</div>
              </div> -->
                <a class="dropdown-item mt-3" href="profile.php">
                    <svg class="icon me-2">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg> Profile</a>
                <!-- <a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg> Settings</a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a> -->
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="#">
                 <svg class="icon me-2">
                  <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                </svg> Lock Account</a> -->
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Logout">
                    <svg class="icon me-2">
                        <use xlink:href="../vendor/coreUI/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg> Logout
                </button>
            </div>
        </li>
    </ul>
</div>