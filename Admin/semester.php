<title>Enrollment System | Semester records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Semester</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Semester records</li>
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
                if(isset($_GET['semester_ID'])) {
                  $semester_ID = $_GET['semester_ID'];
                  $semester = $db->getSemester($semester_ID);
                  $row_sem = $semester->fetch_assoc()

              ?>
              <form id="UpdateSemForm">
              <div class="card">
                <div class="card-header">
                  Update Semester
                </div>
                <div class="card-body">
                  <input type="hidden" class="form-control" name="update_semester_ID" id="update_semester_ID" value="<?= $semester_ID ?>" required>
                  <div class="form-group">
                    <span class="text-dark text-bold">Academic year</span>
                    <select name="year_ID" id="year_ID" class="form-control" required>
                      <option value="" disabled>Select academic year</option>
                      <?php
                      $sem = $db->getActiveAcadYear();
                      if($sem->num_rows > 0) {
                      while($row2 = $sem->fetch_assoc()) {
                      $selected = ($row2['year_ID'] == $row_sem['year_ID']) ? 'selected' : '';
                      echo '<option value="'.$row2['year_ID'].'" '.$selected.'>'.$row2['year_from'].'-'.$row2['year_to'].'</option>';
                      }
                      } else {
                      echo '<option value="" disabled>No record found</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <span class="text-dark text-bold">Semester</span>
                    <select name="semester" id="semester" class="form-control" required>
                      <option value="" selected disabled>Select semester</option>
                      <option value="First Semester" <?php if($row_sem['semester'] == 'First Semester') { echo 'selected'; } ?>>First Semester</option>
                      <option value="Second Semester" <?php if($row_sem['semester'] == 'Second Semester') { echo 'selected'; } ?>>Second Semester</option>
                      <option value="Summer" <?php if($row_sem['semester'] == 'Summer') { echo 'selected'; } ?>>Summer</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <span class="text-dark text-bold">Status</span>
                    <br>
                    <input class="m-1" type="radio" name="status" value="1" required <?php if($row_sem['sem_status'] == 1) { echo 'checked'; } ?>> Active
                    <input class="m-1" type="radio" name="status" value="0" required <?php if($row_sem['sem_status'] == 0) { echo 'checked'; } ?>> Inactive
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <a href="semester.php" class="btn btn-sm btn-dark mr-2" type="button">
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
              <form id="AddSemesterForm">
                <div class="card">
                  <div class="card-header">
                    New Semester
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark text-bold">Academic year</span>
                      <select name="year_ID" id="year_ID" class="form-control" required>
                        <option value="" selected disabled>Select academic year</option>
                        <?php
                        $sem = $db->getActiveAcadYear();
                        if($sem->num_rows > 0) {
                        while($row2 = $sem->fetch_assoc()) {
                        echo '<option value="'.$row2['year_ID'].'" selected>'.$row2['year_from'].'-'.$row2['year_to'].'</option>';
                        }
                        } else {
                        echo '<option value="" selected disabled>No record found</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Semester</span>
                      <select name="semester" id="semester" class="form-control" required>
                        <option value="" selected disabled>Select semester</option>
                        <option value="First Semester">First Semester</option>
                        <option value="Second Semester">Second Semester</option>
                        <option value="Summer">Summer</option>
                      </select>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <!-- <a href="semester.php" class="btn btn-sm btn-dark mr-2" type="button">
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
                Semester records
                <div class="card-tools mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>ACADEMIC YEAR</th>
                      <th>SEMESTER</th>
                      <th>STATUS</th>
                      <th>DATE CREATED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $acad_year = $db->getSemester();
                      while($row2 = $acad_year->fetch_assoc()) {
                    ?>
                    <tr>
                      <td>
                        <?= $row2['year_from'].'-'.$row2['year_to'] ?>
                        <br>
                        <span class="badge badge-<?php echo $row2['status'] == 1 ? 'success' : 'danger'; ?>">
                          <?php echo $row2['status'] == 1 ? 'Active' : 'Inactive'; ?>
                        </span>
                      </td>
                      <td><?= $row2['semester'] ?></td>
                      <td>
                        <span class="badge badge-<?php echo $row2['sem_status'] == 1 ? 'success' : 'danger'; ?>">
                          <?php echo $row2['sem_status'] == 1 ? 'Active' : 'Inactive'; ?>
                        </span>
                      </td>
                      <td><?= date("F d, Y", strtotime($row2['date_created'])) ?></td>
                      <td>
                        <a href="semester.php?semester_ID=<?php echo $row2['semester_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-semester" data-semester-id="<?= $row2['semester_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
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
                <span><i class="fa-solid fa-calendar-days"></i> Delete semester</span>
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
    $('#AddSemesterForm').submit(function(e) {
        e.preventDefault();
        var year_ID = $('#year_ID').val();
        var semester = $('#semester').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddSemesterForm',
                year_ID: year_ID,
                semester: semester
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
                        window.location.href = "semester.php";
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
    $('#UpdateSemForm').submit(function(e) {
        e.preventDefault();
        var semester_ID = $('#update_semester_ID').val();
        var year_ID = $('#year_ID').val();
        var semester = $('#semester').val();
        var status = $("input[name='status']:checked").val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateSemForm',
                semester_ID: semester_ID,
                year_ID: year_ID,
                semester: semester,
                status: status
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
                        window.location.href = "semester.php";
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





    $('#example1').on('click', '.delete-semester', function() {
        var semester_ID = $(this).data('semester-id'); 
        console.log("semester_ID:", semester_ID);
        $('#deleteConfirmationModal').modal('show');

        $('#confirmDelete').click(function() {
            console.log("Confirm delete clicked. semester_ID:", semester_ID); // Log dept_ID before AJAX request
            $.ajax({
                type: 'POST',
                url: '../includes/processes.php', // Your PHP file to handle deletion
                data: { 
                  action: 'DeleteSemForm', 
                  semester_ID: semester_ID
                }, // Send semester_ID to server
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
                            window.location.href = "semester.php";
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