<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['admin_name'];?></span>
                <img class="img-profile rounded-circle" src="/adminlogin/theme/img/undraw_profile.svg" alt="avatar">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/adminlogin/profil.php?id=<?php echo $_SESSION['admin_logged'];?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <?php
                  $adminV = new AdminView();
                  $per = $adminV->getAdminPermissionByIds($_SESSION['admin_logged'], 2);
                  if($per == 3 ){
                 ?>
                <a class="dropdown-item" href="/adminlogin/settings.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Nastavenia
                </a>
              <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Odhlásiť
                </a>
            </div>
        </li>

    </ul>

</nav>
