<title>Enrollment System | Dashboard</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <?php $tbl_user=$db->getUsers(); ?>
              <h3><?= $tbl_user->num_rows > 0 ? $tbl_user->num_rows : "0"; ?></h3>
              <p>Administrators</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users-gear"></i>
            </div>
            <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php $tbl_stud=$db->getStudents(); ?>
              <h3><?= $tbl_stud->num_rows > 0 ? $tbl_stud->num_rows : "0"; ?></h3>
              <p>Student</p>
            </div>
            <div class="icon">
              <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php $tbl_instructor=$db->getInstructor(); ?>
              <h3><?= $tbl_instructor->num_rows > 0 ? $tbl_instructor->num_rows : "0"; ?></h3>
              <p>Instructors</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="instructor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <?php $tbl_subject=$db->getSubject(); ?>
              <h3><?= $tbl_subject->num_rows > 0 ? $tbl_subject->num_rows : "0"; ?></h3>
              <p>Subject</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="subject.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <?php $tbl_course=$db->getCourse(); ?>
              <h3><?= $tbl_course->num_rows > 0 ? $tbl_course->num_rows : "0"; ?></h3>
              <p>Courses</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="course.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php $tbl_dept=$db->getDepartment(); ?>
              <h3><?= $tbl_dept->num_rows > 0 ? $tbl_dept->num_rows : "0"; ?></h3>
              <p>Department</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="department.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php $tbl_enroll=$db->getEnrolledStudents(); ?>
              <h3><?= $tbl_enroll->num_rows > 0 ? $tbl_enroll->num_rows : "0"; ?></h3>
              <p>Enrolled Students</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="enrollment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>