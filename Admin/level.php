<title>Enrollment System | Year level records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Year level</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Year level records</li>
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
                if(isset($_GET['level_ID'])) {
                  $level_ID = $_GET['level_ID'];
                  $acad_year2 = $db->getLevel($level_ID);
                  $row2 = $acad_year2->fetch_assoc()
              ?>
              <form id="UpdateLevelForm">
                <div class="card">
                  <div class="card-header">
                    Update Year level
                  </div>
                  <div class="card-body">
                    <input type="hidden" class="form-control" name="update_level_ID" id="update_level_ID" value="<?= $level_ID ?>" required>
                    <div class="form-group">
                      <span class="text-dark text-bold">Year level</span>
                      <select name="level" id="level" class="form-control" required>
                        <option value="" selected disabled>Select level</option>
                        <option value="First Year" <?php if($row2['level'] == 'First Year') { echo 'selected'; } ?>>First Year</option>
                        <option value="Second Year" <?php if($row2['level'] == 'Second Year') { echo 'selected'; } ?>>Second Year</option>
                        <option value="Third Year" <?php if($row2['level'] == 'Third Year') { echo 'selected'; } ?>>Third Year</option>
                        <option value="Fourth Year" <?php if($row2['level'] == 'Fourth Year') { echo 'selected'; } ?>>Fourth Year</option>
                      </select>
                    </div>

                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <a href="level.php" class="btn btn-sm btn-dark mr-2" type="button">
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
              <form id="AddLevelForm">
                <div class="card">
                  <div class="card-header">
                    New Year level
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark text-bold">Year level</span>
                      <select name="level" id="level" class="form-control" required>
                        <option value="" selected disabled>Select level</option>
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                      </select>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <!-- <a href="level.php" class="btn btn-sm btn-dark mr-2" type="button">
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
                Year level records
                <div class="card-tools mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>YEAR LEVEL</th>
                      <th>DATE CREATED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $acad_year = $db->getLevel();
                      while($row2 = $acad_year->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?= $row2['level'] ?></td>
                      <td><?= date("F d, Y", strtotime($row2['created_at'])) ?></td>
                      <td>
                        <a href="level.php?level_ID=<?php echo $row2['level_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-level" data-level-id="<?= $row2['level_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
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
                <span><i class="fas fa-graduation-cap"></i> Delete year level</span>
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
    $('#AddLevelForm').submit(function(e) {
        e.preventDefault();
        var level = $('#level').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddLevelForm',
                level: level
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
                        window.location.href = "level.php";
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
    $('#UpdateLevelForm').submit(function(e) {
        e.preventDefault();
        var level_ID = $('#update_level_ID').val();
        var level = $('#level').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateLevelForm',
                level_ID: level_ID,
                level: level
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
                        window.location.href = "level.php";
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


   
  $('#example1').on('click', '.delete-level', function() {
      var level_ID = $(this).data('level-id'); // Retrieve dept_ID from the data attribute
      console.log("level_ID:", level_ID); // Check if dept_ID is retrieved correctly
      $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

      $('#confirmDelete').click(function() {
          console.log("Confirm delete clicked. level_ID:", level_ID); // Log dept_ID before AJAX request
          $.ajax({
              type: 'POST',
              url: '../includes/processes.php', // Your PHP file to handle deletion
              data: { 
                action: 'DeleteLevelForm', 
                level_ID: level_ID
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
                          window.location.href = "level.php";
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