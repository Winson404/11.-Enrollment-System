<title>Department records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Department records</li>
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
                if(isset($_GET['dept_ID'])) {
                  $dept_ID = $_GET['dept_ID'];
                  $dept = $db->getDepartment($dept_ID);
                  $row_dept = $dept->fetch_assoc()

              ?>
              <form id="UpdateDepartmentForm">
                <div class="card">
                  <div class="card-header">
                      Update Department
                  </div>
                  <div class="card-body">

                      <input type="hidden" class="form-control" name="update_dept_ID" id="update_dept_ID" value="<?= $dept_ID ?>" required>

                      <div class="form-group">
                          <span class="text-dark text-bold">Academic year</span>
                          <select name="year_ID" id="year_ID" class="form-control" required>
                              <option value="" disabled>Select academic year</option>
                              <?php
                              $sem = $db->getActiveAcadYear();
                              if($sem->num_rows > 0) {
                                  while($row2 = $sem->fetch_assoc()) {
                                      $selected = ($row2['year_ID'] == $row_dept['year_ID']) ? 'selected' : '';
                                      echo '<option value="'.$row2['year_ID'].'" '.$selected.'>'.$row2['year_from'].'-'.$row2['year_to'].'</option>';
                                  }
                              } else {
                                  echo '<option value="" disabled>No record found</option>';
                              }
                              ?>
                          </select>
                      </div>

                      <div class="form-group">
                          <span class="text-dark text-bold">Department name</span>
                          <input type="text" class="form-control" id="dept_name" name="dept_name" value="<?= $row_dept['dept_name'] ?>" required>
                      </div>
                      <div class="form-group">
                          <span class="text-dark text-bold">Department motto</span>
                          <textarea type="text" class="form-control" id="motto" name="motto" rows="3" required><?= $row_dept['motto'] ?></textarea>
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
              <form id="AddDepartmentForm">
                <div class="card">
                  <div class="card-header">
                      New Department
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
                          <span class="text-dark text-bold">Department name</span>
                          <input type="text" class="form-control" id="dept_name" name="dept_name" required>
                      </div>
                      <div class="form-group">
                          <span class="text-dark text-bold">Department motto</span>
                          <textarea type="text" class="form-control" id="motto" name="motto" rows="3" required></textarea>
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
                Department records
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
                      <th>DEPT NAME</th>
                      <th>MOTTO</th>
                      <th>DATE CREATED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $acad_year = $db->getDepartment();
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
                      <td><?= ucwords($row2['dept_name']) ?></td>
                      <td><?= ucwords($row2['motto']) ?></td>
                      <td><?= date("F d, Y", strtotime($row2['date_created'])) ?></td>
                      <td>
                        <a href="department.php?dept_ID=<?php echo $row2['dept_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-department" data-dept-id="<?= $row2['dept_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>

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
                <span><i class="fa-solid fa-book"></i> Delete department</span>
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
    $('#AddDepartmentForm').submit(function(e) {
        e.preventDefault();
        var year_ID = $('#year_ID').val();
        var dept_name = $('#dept_name').val();
        var motto = $('#motto').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddDepartmentForm',
                year_ID: year_ID,
                dept_name: dept_name,
                motto: motto
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
                        window.location.href = "department.php";
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
    $('#UpdateDepartmentForm').submit(function(e) {
        e.preventDefault();
        var dept_ID = $('#update_dept_ID').val();
        var year_ID = $('#year_ID').val();
        var dept_name = $('#dept_name').val();
        var motto = $('#motto').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateDepartmentForm',
                dept_ID: dept_ID,
                year_ID: year_ID,
                dept_name: dept_name,
                motto: motto
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
                        window.location.href = "department.php";
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




$('#example1').on('click', '.delete-department', function() {
    var dept_ID = $(this).data('dept-id'); // Retrieve dept_ID from the data attribute
    console.log("dept_ID:", dept_ID); // Check if dept_ID is retrieved correctly
    $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

    $('#confirmDelete').click(function() {
        console.log("Confirm delete clicked. dept_ID:", dept_ID); // Log dept_ID before AJAX request
        $.ajax({
            type: 'POST',
            url: '../includes/processes.php', // Your PHP file to handle deletion
            data: { action: 'DeleteDepartmentForm', dept_ID: dept_ID }, // Send dept_ID to server
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
                        window.location.href = "department.php";
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