<title>Enrollment System | Enrolled subject records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Enrolled subjects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Enrolled subject records</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <?php if($row['is_enrolled'] == 1): ?>
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>SUBJECT NO</th>
                      <th>DESCRIPTION TITLE</th>
                      <th>UNITS</th>
                      <th>OFFER CODE</th>
                      <th>INSTRUCTOR</th>
                      <!-- <th>OTHER DETAILS</th> -->
                      <!-- <th>DATE ADDED</th> -->
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $acad_year = $db->getEnrolledSubjects($id);
                      while($row2 = $acad_year->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?= ucwords($row2['sub_no']) ?></td>
                      <td><?= ucwords($row2['descriptive_title']) ?></td>
                      <td><?= $row2['units'] ?></td>
                      <td><?= $row2['offer_code'] ?></td>
                      <td><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></td>
                      <!-- <td>
                        Department: <?= $row2['dept_name'] ?> <br>
                        Semester: <?= $row2['semester'] ?>
                      </td> -->
                      <!-- <td><?= date("F d, Y", strtotime($row2['date_created'])) ?></td> -->
                  
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body text-center p-5">
                <h6>"Informal enrollment status: Your enrollment process is pending official confirmation. Kindly ensure timely payment to facilitate enrollment. If payment has been completed, please await confirmation from School Administrators."</h6>
              </div>
            <?php endif;?>
            </div>
          </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="enrollStudentForm">
              <div class="modal-content">
                <div class="modal-header bg-light">
                  <h5 class="modal-title" id="exampleModalLabel">Enroll new student</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <span class="text-dark text-bold">Semester</span>
                    <select name="semester_ID" id="semester_ID" class="form-control" required>
                      <option value="" selected disabled>Select semester</option>
                      <?php
                      $get_sem = $db->getActiveSemester();
                      if($get_sem->num_rows > 0) {
                      while($row_sem = $get_sem->fetch_assoc()) {
                      echo '<option value="'.$row_sem['semester_ID'].'">'.$row_sem['semester'].'</option>';
                      }
                      } else {
                      echo '<option value="" disabled>No record found</option>';
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="text-dark text-bold">Course</span>
                    <select name="course_ID" id="course_ID" class="form-control" required>
                      <option value="" selected disabled>Select course</option>
                      <?php
                      $course = $db->getCourse();
                      if($course->num_rows > 0) {
                      while($row = $course->fetch_assoc()) {
                      echo '<option value="'.$row['course_ID'].'">'.$row['course_name'].'</option>';
                      }
                      } else {
                      echo '<option value="" disabled>No record found</option>';
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="text-dark text-bold">Student</span>
                    <select name="stud_ID" id="stud_ID" class="form-control" required>
                      <option value="" selected disabled>Select student</option>
                      <?php
                      $stud = $db->getStudents();
                      if($stud->num_rows > 0) {
                      while($row = $stud->fetch_assoc()) {
                      echo '<option value="'.$row['stud_ID'].'">'.$row['firstname'].' '.$row['middlename'].'</option>';
                      }
                      } else {
                      echo '<option value="" disabled>No record found</option>';
                      }
                      ?>
                    </select>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Confirm</button>
                </div>
              </div>
            </form>
          </div>
        </div>

       
      </div>
    </section>

<?php require_once '../includes/footer.php'; ?>

<script>
$(document).ready(function(){
    $('#course_ID').change(function(){
        var course_ID = $(this).val(); // Get the selected course ID
        
        // AJAX call to fetch students enrolled in the selected course
        $.ajax({
            url: '../includes/processes.php',
            method: 'POST',
            data: { action: 'getStudentCourse', course_ID: course_ID },
            dataType: 'json',
            success: function(response){
                if(response.success){
                    $('#stud_ID').empty();
                    var students = response.students;
                    if(students.length > 0){
                        $('#stud_ID').append('<option value="" selected disabled>Select student to enroll</option>');
                        $.each(students, function(index, student) {
                            $('#stud_ID').append('<option value="' + student.stud_ID + '">' + student.firstname + ' ' + student.middlename + '</option>');
                        });
                    } else {
                        $('#stud_ID').append('<option value="" selected disabled>No students found for this course</option>');
                    }
                } else {
                    $('#stud_ID').empty();
                    $('#stud_ID').append('<option value="" selected disabled>No students found for this course</option>');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });




    // Add event listener to form submission
    $('#enrollStudentForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'enrollStudentForm');

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: formData,
            contentType: false,
            processData: false,
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
                        window.location.href = "enrollment.php";
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