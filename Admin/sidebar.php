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

  $user_result = $db->getUsers($id);
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
          <a href="dashboard.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt m-0"></i>
            <p>&nbsp;Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="enrollment.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'enrollment.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>Enrollment</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'admin.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'instructor.php' ||
            basename($_SERVER['PHP_SELF']) == 'instructor_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_payments.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_verify.php' 
            ) ? 'active' : '';
            ?>
            ">
            <i class="fa-solid fa-users-gear"></i>
            <p>&nbsp;&nbsp;System Users<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'admin.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'instructor.php' ||
            basename($_SERVER['PHP_SELF']) == 'instructor_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_payments.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_verify.php' 
            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="admin.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['admin.php', 'admin_mgmt.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Administrators</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="instructor.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['instructor.php', 'instructor_mgmt.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Instructors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['users.php', 'users_mgmt.php', 'users_payments.php', 'users_verify.php', ]) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Students</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'subject.php' ||
            basename($_SERVER['PHP_SELF']) == 'subject_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'subject_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'academic_year.php' ||
            basename($_SERVER['PHP_SELF']) == 'semester.php' ||
            basename($_SERVER['PHP_SELF']) == 'course.php' ||
            basename($_SERVER['PHP_SELF']) == 'department.php' ||
            basename($_SERVER['PHP_SELF']) == 'level.php'

            ) ? 'active' : '';
            ?>
            ">
            <i class="fa-solid fa-gear"></i>
            <p>&nbsp;&nbsp;File maintenance<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'subject.php' ||
            basename($_SERVER['PHP_SELF']) == 'subject_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'subject_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'school_fees_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'academic_year.php' ||
            basename($_SERVER['PHP_SELF']) == 'semester.php' ||
            basename($_SERVER['PHP_SELF']) == 'course.php' ||
            basename($_SERVER['PHP_SELF']) == 'department.php' ||
            basename($_SERVER['PHP_SELF']) == 'level.php'

            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="subject.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['subject.php', 'subject_mgmt.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Subjects</p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a href="school_fees.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['school_fees.php', 'school_fees_mgmt.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>School Fees</p>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="academic_year.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'academic_year.php') ? 'active' : ''; ?>">
                <!-- <i class="fa-solid fa-calendar-days"></i> -->
                <i class="far fa-circle nav-icon"></i>
                <p>Academic Year</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="semester.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'semester.php') ? 'active' : ''; ?>">
                <!-- <i class="fa-solid fa-calendar-days"></i> -->
                <i class="far fa-circle nav-icon"></i>
                <p>Semester</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="course.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'course.php') ? 'active' : ''; ?>">
                <!-- <i class="fas fa-book"></i> -->
                <i class="far fa-circle nav-icon"></i>
                <p>Courses</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="department.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'department.php') ? 'active' : ''; ?>">
                <!-- <i class="fas fa-book"></i> -->
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="level.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'level.php') ? 'active' : ''; ?>">
                <!-- <i class="fas fa-graduation-cap"></i> -->
                <i class="far fa-circle nav-icon"></i>
                <p>Year level</p>
              </a>
            </li>

          </ul>
        </li>


        <!-- <li class="nav-item">
          <a href="log_history.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'log_history.php') ? 'active' : ''; ?>">
            <i class="fas fa-list-alt"></i>
            <p>&nbsp;&nbsp; Login history</p>
          </a>
        </li>
        <li class="nav-header text-secondary" style="margin-bottom: -10px;">DATABASE MGMT</li>
        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'backup.php' ||
            basename($_SERVER['PHP_SELF']) == 'restore.php'
            ) ? 'active' : '';
            ?>
            ">
            <i class="fa-solid fa-database"></i>
            <p>&nbsp;&nbsp;Manage Database<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'backup.php' ||
            basename($_SERVER['PHP_SELF']) == 'restore.php'
            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="backup.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'backup.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Back-up database</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="restore.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'restore.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Restore database</p>
              </a>
            </li>
          </ul>
        </li> -->
        <br>
        <br>
        <br>
      </ul>
    </nav>
  </div>
</aside>
