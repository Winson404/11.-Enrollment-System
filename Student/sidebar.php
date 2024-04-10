<?php
  require_once '../includes/db_config.php';
  require_once '../includes/classes.php';
  $db = new db_class();
  if(!isset($_SESSION['id']) && !isset($_SESSION['user_type'])) {
    header("Location: ../login.php");
    exit();
  }

  $id = $_SESSION['id'];
  $user_type = $_SESSION['user_type'];

  $user_result = $db->getStudents($id);
  if ($user_result->num_rows < 0) {
    echo '
    <script>
      Swal.fire({
          title: "User not found",
          text: "Registration failed",
          icon: "error",
          timer: 2000,
          timerProgressBar: true,
          showConfirmButton: true
      }).then((result) => {
          window.location.href = "../logout.php";
      });
    </script>';
  } 
  $row = $user_result->fetch_assoc();

  require_once '../includes/header.php';
  
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="dashboard.php" class="brand-link">
    <img src="../images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Enrollment System</span>
    <br>
    <span class="text-sm ml-5 font-weight-light mt-2">&nbsp;&nbsp;Paniqui, Tarlac Inc.</span>
  </a>
  
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> -->
    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->
    <!-- Sidebar Menu -->
    <nav class="">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="enrollment.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'enrollment.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>Subjects Enrolled</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="payment.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'payment.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-coins"></i>
            <p>Payment</p>
          </a>
        </li>

      <!--   <li class="nav-item">
          <a href="log_history.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'log_history.php') ? 'active' : ''; ?>">
            <i class="fas fa-list-alt"></i>
            <p>&nbsp;&nbsp; Login history</p>
          </a>
        </li>
         -->
      </ul>
    </nav>
  </div>
</aside>
