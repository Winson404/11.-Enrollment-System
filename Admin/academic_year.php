<title>Enrollment System | Academic year records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Academic year</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Academic year records</li>
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
                if(isset($_GET['year_ID'])) {
                  $year_ID = $_GET['year_ID'];
                  $acad_year2 = $db->getAcadYear($year_ID);
                  $row2 = $acad_year2->fetch_assoc()

              ?>
              <form id="UpdateAcadForm">
                <div class="card">
                  <div class="card-header">
                    Update Academic Year
                  </div>
                  <div class="card-body">
                    <input type="hidden" class="form-control" name="update_year_ID" id="update_year_ID" value="<?= $year_ID ?>" required>
                    <div class="form-group">
                      <span class="text-dark text-bold">Academic year from</span>
                      <input type="number" class="form-control" id="year_from" name="year_from" placeholder="2000" min="1900" value="<?= $row2['year_from'] ?>" required>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Academic year to</span>
                      <input type="number" class="form-control" id="year_to" name="year_to" placeholder="2001" min="1901" value="<?= $row2['year_to'] ?>" required readonly>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Status</span>
                      <br>
                      <input type="radio" name="status" value="1" required <?php if($row2['status'] == 1) { echo 'checked'; } ?>> Active
                      <input type="radio" name="status" value="0" required <?php if($row2['status'] == 0) { echo 'checked'; } ?>> Inactive
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <a href="academic_year.php" class="btn btn-sm btn-dark mr-2" type="button">
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
              <form id="AddAcadForm">
                <div class="card">
                  <div class="card-header">
                    New Academic Year
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark text-bold">Academic year from</span>
                      <input type="number" class="form-control" id="year_from" name="year_from" placeholder="2000" min="1900" required>
                    </div>
                    <div class="form-group">
                      <span class="text-dark text-bold">Academic year to</span>
                      <input type="number" class="form-control" id="year_to" name="year_to" placeholder="2001" min="1901" required readonly>
                    </div>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                    <!-- <a href="academic_year.php" class="btn btn-sm btn-dark mr-2" type="button">
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
                Academic year records
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
                      <th>STATUS</th>
                      <th>DATE CREATED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $acad_year = $db->getAcadYear();
                      while($row2 = $acad_year->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?= $row2['year_from'].'-'.$row2['year_to'] ?></td>
                      <td>
                        <span class="badge badge-<?php echo $row2['status'] == 1 ? 'success' : 'danger'; ?>">
                          <?php echo $row2['status'] == 1 ? 'Active' : 'Inactive'; ?>
                        </span>
                      </td>
                      <td><?= date("F d, Y", strtotime($row2['created_at'])) ?></td>
                      <td>
                        <a href="academic_year.php?year_ID=<?php echo $row2['year_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-year" data-year-id="<?= $row2['year_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
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
                <span><i class="fa-solid fa-calendar-days"></i> Delete academic year</span>
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
    // Add event listener to input field for academic year from
    $('#year_from').on('input', function() {
        var fromYear = parseInt($(this).val());
        var toYear = fromYear + 1;
        $('#year_to').val(toYear);
    });

    // Add event listener to form submission
    $('#AddAcadForm').submit(function(e) {
        e.preventDefault();
        var year_from = $('#year_from').val();
        var year_to = $('#year_to').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'AddAcadForm',
                year_from: year_from,
                year_to: year_to
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
                        window.location.href = "academic_year.php";
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
    $('#UpdateAcadForm').submit(function(e) {
        e.preventDefault();
        var year_ID = $('#update_year_ID').val();
        var year_from = $('#year_from').val();
        var year_to = $('#year_to').val();
        var status = $("input[name='status']:checked").val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'UpdateAcadForm',
                year_ID: year_ID,
                year_from: year_from,
                year_to: year_to,
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
                        window.location.href = "academic_year.php";
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


   
  $('#example1').on('click', '.delete-year', function() {
      var year_ID = $(this).data('year-id'); // Retrieve dept_ID from the data attribute
      console.log("year_ID:", year_ID); // Check if dept_ID is retrieved correctly
      $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

      $('#confirmDelete').click(function() {
          console.log("Confirm delete clicked. year_ID:", year_ID); // Log dept_ID before AJAX request
          $.ajax({
              type: 'POST',
              url: '../includes/processes.php', // Your PHP file to handle deletion
              data: { 
                action: 'DeleteAcadForm', 
                year_ID: year_ID
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
                          window.location.href = "academic_year.php";
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

    // Allow only numbers in the input fields
    $('input[type="number"]').on('keypress', function(event) {
        var charCode = event.which ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    });
});

</script>