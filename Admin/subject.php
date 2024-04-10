<title>Subject records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Subject records</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header p-2">
            <a href="subject_mgmt.php?page=create" class="btn btn-sm btn-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Subject</a>

            <div class="card-tools mr-1 mt-3">
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
                  <th>ACTIONS</th>
              </thead>
              <tbody id="users_data">
                <?php
                  $acad_year = $db->getSubject();
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
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?php echo $row2['sub_ID']; ?>"><i class="fas fa-eye"></i> View</button>
                    <a href="subject_mgmt.php?page=<?php echo $row2['sub_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm delete-subject" data-subject-id="<?= $row2['sub_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
                  </td>
                </tr>

                <!-- VIEW MODAL -->
                    <div class="modal fade" id="details<?php echo $row2['sub_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            Subject details
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Academic Year</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= $row2['year_from'].' '.$row2['year_to'] ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Semester</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['semester']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Course</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['course_name']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Year level</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['level']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Subject No</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['sub_no']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Descriptive title</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['descriptive_title']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Units</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= $row2['units'] ?>
                              </div>
                            </div>
                            <hr>
                            
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Offer Code</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= $row2['offer_code'] ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Assigned Instructor</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= ucwords($row2['firstname'].' '.$row2['middlename']) ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Date created</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <?= date("F d, Y", strtotime($row2['date_created'])) ?>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <span><i class="fa-solid fa-book"></i> Delete subject</span>
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

    $('#example1').on('click', '.delete-subject', function() {
        var sub_ID = $(this).data('subject-id'); 
        console.log("sub_ID:", sub_ID);
        $('#deleteConfirmationModal').modal('show');

        $('#confirmDelete').click(function() {
            console.log("Confirm delete clicked. sub_ID:", sub_ID); // Log dept_ID before AJAX request
            $.ajax({
                type: 'POST',
                url: '../includes/processes.php', // Your PHP file to handle deletion
                data: { 
                  action: 'DeleteSubjectForm', 
                  sub_ID: sub_ID
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
                            window.location.href = "subject.php";
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