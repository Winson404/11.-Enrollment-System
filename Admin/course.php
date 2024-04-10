<title>Course records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Course</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Course records</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            
              <?php 
                if(isset($_GET['course_ID'])) {
                  $course_ID = $_GET['course_ID'];
                  $fetch2 = $db->getCourse($course_ID);
                  $row2 = $fetch2->fetch_assoc();
                  $course_dept_ID = $row2['dept_ID'];

              ?>
              <form id="UpdateCourseForm">
                <div class="card">
                  <div class="card-header">
                    Update Course
                  </div>
                  <div class="card-body">
                    <input type="hidden" class="form-control" name="update_course_ID" id="update_course_ID" value="<?= $course_ID ?>" required>
                    <div class="form-group">
                      <span class="text-dark text-bold">Department</span>
                      <select name="dept_ID" id="dept_ID" class="form-control" required>
                        <option value="" disabled>Select department</option>
                        <?php
                        $fetch3 = $db->getDepartment();
                        if($fetch3->num_rows > 0) {
                        while($row3 = $fetch3->fetch_assoc()) {
                        // Check if the department ID matches the course's department ID
                        $selected = ($row3['dept_ID'] == $course_dept_ID) ? 'selected' : '';
                        echo '<option value="'.$row3['dept_ID'].'" '.$selected.'>'.$row3['dept_name'].'</option>';
                        }
                        } else {
                        echo '<option value="" disabled>No record found</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Course</span>
                      <input type="text" class="form-control" id="course_name" name="course_name" value="<?= $row2['course_name']?>" required>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Description</span>
                      <textarea name="course_desc" id="course_desc" class="form-control" required rows="3"><?= $row2['course_desc']?></textarea>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <a href="course.php" class="btn btn-sm btn-dark mr-2" type="button">
                      <i class="fas fa-times"></i> Cancel
                    </a>
                    <button class="btn btn-sm btn-info" type="submit">
                    <i class="fas fa-check"></i> Update
                    </button>
                  </div>
                </div>
              </form>
              <?php
                } else {
              ?>
              <form id="AddCourseForm">
                <div class="card">
                  <div class="card-header">
                    New Course
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark text-bold">Department</span>
                      <select name="dept_ID" id="dept_ID" class="form-control" required>
                        <option value="" selected disabled>Select department</option>
                        <?php
                        $fetch2 = $db->getDepartment();
                        if($fetch2->num_rows > 0) {
                        while($row2 = $fetch2->fetch_assoc()) {
                        echo '<option value="'.$row2['dept_ID'].'">'.$row2['dept_name'].'</option>';
                        }
                        } else {
                        echo '<option value="" selected disabled>No record found</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Course</span>
                      <input type="text" class="form-control" id="course_name" name="course_name" required>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Description</span>
                      <textarea name="course_desc" id="course_desc" class="form-control" required rows="3"></textarea>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <!-- <a href="course.php" class="btn btn-sm btn-dark mr-2" type="button">
                      <i class="fas fa-times"></i> Cancel
                    </a> -->
                    <button class="btn btn-sm btn-primary" type="submit">
                    <i class="fas fa-check"></i> Submit
                    </button>
                  </div>
                </div>
              </form>
              <?php } ?>
            
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-12">
            <div class="card">
              <div class="card-header">
                Course records
                <div class="card-tools mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>DEPARTMENT</th>
                      <th>COURSE</th>
                      <th>DESCRIPTION</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $course = $db->getCourse();
                      while($row2 = $course->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?= ucwords($row2['dept_name']) ?></td>
                      <td><?= ucwords($row2['course_name']) ?></td>
                      <td><?= ucwords($row2['course_desc']) ?></td>
                      <td>
                        <a href="course.php?course_ID=<?php echo $row2['course_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-course" data-course-id="<?= $row2['course_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    </tr>    
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <span><i class="fa-solid fa-book"></i> Delete course</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                </button>
              </div>
              <div class="modal-body text-center">
                Delete this record?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDelete"><i class="fas fa-check"></i> Confirm</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

<?php require_once '../includes/footer.php'; ?>

<script>
  $(document).ready(function() {

    // Add event listener to form submission
    $('#AddCourseForm').submit(function(e) {
        e.preventDefault();
        var dept_ID     = $('#dept_ID').val();
        var course_name = $('#course_name').val();
        var course_desc = $('#course_desc').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddCourseForm',
                dept_ID: dept_ID,
                course_name: course_name,
                course_desc: course_desc
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
                        window.location.href = "course.php";
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
    $('#UpdateCourseForm').submit(function(e) {
        e.preventDefault();
        var course_ID = $('#update_course_ID').val();
        var dept_ID = $('#dept_ID').val();
        var course_name = $('#course_name').val();
        var course_desc = $('#course_desc').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateCourseForm',
                course_ID: course_ID,
                dept_ID: dept_ID,
                course_name: course_name,
                course_desc: course_desc
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
                        window.location.href = "course.php";
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




  $('#example1').on('click', '.delete-course', function() {
      var course_ID = $(this).data('course-id'); // Retrieve dept_ID from the data attribute
      console.log("course_ID:", course_ID); // Check if dept_ID is retrieved correctly
      $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

      $('#confirmDelete').click(function() {
          console.log("Confirm delete clicked. course_ID:", course_ID); // Log dept_ID before AJAX request
          $.ajax({
              type: 'POST',
              url: '../includes/processes.php', // Your PHP file to handle deletion
              data: { 
                action: 'DeleteCourseForm', 
                course_ID: course_ID
              }, // Send dept_ID to server
              success: function(response) {
                  console.log("Delete request response:", response); // Log response from server
                  if (response.success) {
                      Swal.fire({
                          title: "Success",
                          text: response.message,
                          icon: "success",
                          timer: 2500,
                          timerProgressBar: true,
                          showConfirmButton: true
                      }).then(function() {
                          // Redirect to academic_year.php after success
                          window.location.href = "course.php";
                      });
                      row.remove(); // Remove the deleted row from the table
                  } else {
                      Swal.fire({
                          title: "Error",
                          text: response.message,
                          icon: "error",
                          timer: 2500,
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



   
});

</script>