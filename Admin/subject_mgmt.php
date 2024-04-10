<title>Enrollment System | Manage Subject</title>
<?php 
    require_once 'sidebar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

<div class="content-wrapper">
  <?php if($page === 'create') { ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Subject Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="AddSubjectForm">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Fill-in the required fields below</h3>
            <div class="card-tools mt-2">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Semester</span>
                  <select name="semester_ID" id="semester_ID" class="form-control" required>
                    <option value="" selected disabled>Select semester</option>
                    <?php
                    $sem = $db->getSemester();
                    if($sem->num_rows > 0) {
                    while($row2 = $sem->fetch_assoc()) {
                    echo '<option value="'.$row2['semester_ID'].'">'.$row2['semester'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Course</span>
                  <select name="course_ID" id="course_ID" class="form-control" required>
                    <option value="" selected disabled>Select course</option>
                    <?php
                    $course = $db->getCourse();
                    if($course->num_rows > 0) {
                    while($row2 = $course->fetch_assoc()) {
                    echo '<option value="'.$row2['course_ID'].'">'.$row2['course_name'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Year level</span>
                  <select name="level_ID" id="level_ID" class="form-control" required>
                    <option value="" selected disabled>Select level</option>
                    <?php
                    $level = $db->getLevel();
                    if($level->num_rows > 0) {
                    while($row2 = $level->fetch_assoc()) {
                    echo '<option value="'.$row2['level_ID'].'">'.$row2['level'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Subject no</span>
                  <input type="text" class="form-control" name="sub_no" id="sub_no" placeholder="Subject no" required>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Descriptive title</span>
                  <textarea type="text" class="form-control" name="descriptive_title" id="descriptive_title" placeholder="Descriptive title" rows="1" required></textarea>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Units</span>
                  <input type="text" class="form-control" name="units" id="units" placeholder="Units" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Offer code</span>
                  <input type="text" class="form-control" name="offer_code" id="offer_code" placeholder="Offer code" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Instructor</span>
                  <select name="levinstructor_IDel_ID" id="instructor_ID" class="form-control" required>
                    <option value="" selected disabled>Select to assign</option>
                    <?php
                    $instructor = $db->getInstructor();
                    if($instructor->num_rows > 0) {
                    while($row2 = $instructor->fetch_assoc()) {
                    echo '<option value="'.$row2['instructor_ID'].'">'.$row2['firstname'].' '.$row2['lastname'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="subject.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php } else { 
    $sub_ID = $page;
    $subject = $db->getSubject($sub_ID);
    $row2 = $subject->fetch_assoc();
  ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Subject Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="UpdateSubjectForm">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Fill-in the required fields below</h3>
            <div class="card-tools mt-2">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">

            <input type="hidden" class="form-control" name="sub_ID" id="sub_ID" value="<?= $sub_ID ?>" required>

            <div class="row d-flex justify-content-center">
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Semester</span>
                  <select name="semester_ID" id="semester_ID" class="form-control" required>
                    <option value="" selected disabled>Select semester</option>
                    <?php
                    $sem = $db->getSemester();
                    if($sem->num_rows > 0) {
                    while($row3 = $sem->fetch_assoc()) {
                      $selected = ($row3['semester_ID'] == $row2['semester_ID']) ? 'selected' : '';
                      echo '<option value="'.$row3['semester_ID'].'" '.$selected.'>'.$row3['semester'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Course</span>
                  <select name="course_ID" id="course_ID" class="form-control" required>
                    <option value="" selected disabled>Select course</option>
                    <?php
                    $course = $db->getCourse();
                    if($course->num_rows > 0) {
                    while($row4 = $course->fetch_assoc()) {
                      $selected = ($row4['course_ID'] == $row2['course_ID']) ? 'selected' : '';
                      echo '<option value="'.$row4['course_ID'].'" '.$selected.'>'.$row4['course_name'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Year level</span>
                  <select name="level_ID" id="level_ID" class="form-control" required>
                    <option value="" selected disabled>Select level</option>
                    <?php
                    $level = $db->getLevel();
                    if($level->num_rows > 0) {
                    while($row5 = $level->fetch_assoc()) {
                      $selected = ($row5['level_ID'] == $row2['level_ID']) ? 'selected' : '';
                    echo '<option value="'.$row5['level_ID'].'" '.$selected.'>'.$row5['level'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Subject no</span>
                  <input type="text" class="form-control" name="sub_no" id="sub_no" placeholder="Subject no" value="<?= $row2['sub_no'] ?>" required>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Descriptive title</span>
                  <textarea type="text" class="form-control" name="descriptive_title" id="descriptive_title" placeholder="Descriptive title" rows="1" required><?= $row2['descriptive_title'] ?></textarea>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Units</span>
                  <input type="text" class="form-control" name="units" id="units" placeholder="Units" value="<?= $row2['units'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Offer code</span>
                  <input type="text" class="form-control" name="offer_code" id="offer_code" placeholder="Offer code" value="<?= $row2['offer_code'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Instructor</span>
                  <select name="levinstructor_IDel_ID" id="instructor_ID" class="form-control" required>
                    <option value="" selected disabled>Select to assign</option>
                    <?php
                    $instructor = $db->getInstructor();
                    if($instructor->num_rows > 0) {
                    while($row6 = $instructor->fetch_assoc()) {
                      $selected = ($row6['instructor_ID'] == $row2['instructor_ID']) ? 'selected' : '';
                    echo '<option value="'.$row6['instructor_ID'].'" '.$selected.'>'.$row6['firstname'].' '.$row6['lastname'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="subject.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php } } else { require_once '../includes/404.php'; } ?>
<br>
<br>
<br>
<?php require_once '../includes/footer.php'; ?>

<script>
  $(document).ready(function() {

    // Add event listener to form submission
    $('#AddSubjectForm').submit(function(e) {
        e.preventDefault();
        var semester_ID = $('#semester_ID').val();
        var course_ID = $('#course_ID').val();
        var level_ID = $('#level_ID').val();
        var sub_no = $('#sub_no').val();
        var descriptive_title = $('#descriptive_title').val();
        var units = $('#units').val();
        var offer_code = $('#offer_code').val();
        var instructor_ID = $('#instructor_ID').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddSubjectForm',
                semester_ID: semester_ID, 
                course_ID: course_ID, 
                level_ID: level_ID, 
                sub_no: sub_no, 
                descriptive_title: descriptive_title, 
                units: units, 
                offer_code: offer_code, 
                instructor_ID: instructor_ID
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    }).then(function() {
                        // Redirect to academic_year.php after success
                        window.location.href = "subject.php";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });




    // Add event listener to form submission
    $('#UpdateSubjectForm').submit(function(e) {
        e.preventDefault();
        var sub_ID = $('#sub_ID').val();
        var semester_ID = $('#semester_ID').val();
        var course_ID = $('#course_ID').val();
        var level_ID = $('#level_ID').val();
        var sub_no = $('#sub_no').val();
        var descriptive_title = $('#descriptive_title').val();
        var units = $('#units').val();
        var offer_code = $('#offer_code').val();
        var instructor_ID = $('#instructor_ID').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateSubjectForm',
                sub_ID: sub_ID,
                semester_ID: semester_ID, 
                course_ID: course_ID, 
                level_ID: level_ID, 
                sub_no: sub_no, 
                descriptive_title: descriptive_title, 
                units: units, 
                offer_code: offer_code, 
                instructor_ID: instructor_ID
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    }).then(function() {
                        // Redirect to academic_year.php after success
                        window.location.href = "subject.php";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    
});

</script>