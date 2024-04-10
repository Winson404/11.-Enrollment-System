<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Enrollment System</title> -->
    <!---FAVICON ICON FOR WEBSITE--->
    <link rel="shortcut icon" type="image/png" href="../images/logo.jpg">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <script src="../plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <script src="../dist/js/sweetalert2.all.min.js"></script>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
      .modal-content{
        -webkit-box-shadow: 0 5px 15px rgba(0,0,0,0);
        -moz-box-shadow: 0 5px 15px rgba(0,0,0,0);
        -o-box-shadow: 0 5px 15px rgba(0,0,0,0);
        box-shadow: 0 5px 15px rgba(0,0,0,0);
      }
      /*.nav-link {
        padding-top: 5px;
        padding-bottom: 5px;
      }

      .nav-treeview > .nav-item > .nav-link {
        padding-left: 20px;
      }

      .nav-treeview > .nav-item > .nav-link p {
        margin-bottom: 0;
      }*/
      .form-control:not([type="email"]):not([type="password"]) {
        text-transform: capitalize;
      }
    </style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">

     <!--  <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div> -->

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- <nav class="main-header navbar navbar-expand navbar-dark"> -->
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
         <!--  <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link">Home</a>
          </li> -->
          <?php
          // Get the current URL
          $currentUrl = $_SERVER['REQUEST_URI'];

          // Check if the URL contains "Admin" folder
          $isAdminPage = strpos($currentUrl, 'Admin') !== false;
          ?>

          <!-- Navigation Link -->
          <?php if (!$isAdminPage): ?>
          <!--   <li class="nav-item d-none d-sm-inline-block">
              <a href="contact-us.php" class="nav-link">Contact</a>
            </li> -->
          <?php endif; ?>

        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- <li class="mt-1">
            <a class="mt-3">Today is <?php //echo date("l"); ?> | <?php// echo date("F d, Y"); ?></a>
          </li> -->
          <!-- Messages Dropdown Menu -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fa-solid fa-user"></i><?php //echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?><i class="fa-solid fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="profile.php" class="dropdown-item">
                <div class="media">
                  <img src="../images-users/<?php //echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50">
                  <div class="media-body">
                    <h3 class="dropdown-item-title"><?php //echo ' '.$row['firstname'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></h3>
                    <p class="text-sm text-muted"><?php //echo $row['user_type']; ?></p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a type="button" href="profile.php" class="dropdown-item">&nbsp;<i class="fa-solid fa-gear"></i>&nbsp;&nbsp; Profile settings</a>
              <div class="dropdown-divider"></div>
              <a href="#" class="d-flex justify-content-start dropdown-item dropdown-footer" onclick="logout()">&nbsp;<i class="fa-solid fa-power-off"></i>&nbsp;&nbsp; Logout</a>
            </div>
          </li> -->
          <!-- Navbar Search -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li> -->
          <!-- Messages Dropdown Menu -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <div class="media">
                  <img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li> -->
          <!-- Notifications Dropdown Menu -->
       
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="../images-users/<?php echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50"> -->
              <img src="../images-users/<?php echo $row['image']; ?>" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline"><?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary">
                <img src="../images-users/<?php echo $row['image']; ?>" class="img-circle elevation-2" alt="User Image">
                <p>
                  <?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?>
                  <?php if($user_type == 'user'): ?>
                  <small><?php if($row['user_type'] == 0) { echo 'Staff'; } else { echo 'Administrator'; } ?></small>
                  <?php endif; ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-12 text-center">
                    <small>Member since <?php echo date("F d, Y", strtotime($row['created_at'])); ?></small>
                  </div>
                  <!-- <div class="col-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-4 text-center">
                    <a href="#">Friends</a>
                  </div> -->
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                <a href="#" id="signOutButton" class="btn btn-default btn-flat float-right">Sign out</a>
              </li>
            </ul>
          </li>
          <!-- FULL SCREEN -->
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <!-- END FULL SCREEN -->
          
        </ul>
      </nav>
 

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("signOutButton").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default action of following the link

        // Your Swal.fire function
        Swal.fire({
            title: "Success",
            text: "You have successfully signed out.",
            icon: "success",
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: true
        }).then(() => {
    window.location.href = "../logout.php";
});

        // Perform logout actions here if needed
    });
});
</script>