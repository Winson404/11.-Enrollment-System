<title>Instructor records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Instructor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Instructor records</li>
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
              <div class="card-header p-2">
                <a href="instructor_mgmt.php?page=create" class="btn btn-sm btn-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Instructor</a>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>PROFILE</th>
                      <th>EMP ID</th>
                      <th>FULL NAME</th>
                      <th>DEPARTMENT</th>
                      <th>POSITION</th>
                      <!-- <th>DATE ADDED</th> -->
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $instructor = $db->getInstructor();
                      while($row2 = $instructor->fetch_assoc()) {
                    ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#viewphoto<?php echo $row2['instructor_ID']; ?>">
                          <img src="../images-users/<?php echo $row2['image']; ?>" alt="" width="35" height="35" class="img-circle d-block m-auto" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        </a>
                      </td>
                      <td><?= $row2['emp_ID'] ?></td>
                      <td><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></td>
                      <td><?= ucwords($row2['dept_name']) ?></td>
                      <td><?= ucwords($row2['position']) ?></td>
                      <!-- <td><?= date("F d, Y", strtotime($row2['date_created'])) ?></td> -->
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?php echo $row2['instructor_ID']; ?>"><i class="fas fa-eye"></i> View</button>
                        <a href="instructor_mgmt.php?page=<?php echo $row2['instructor_ID']; ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-instructor" data-instructor-id="<?= $row2['instructor_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    </tr>

                    <!-- VIEW PROFILE PHOTO -->
                    <div class="modal fade" id="viewphoto<?php echo $row2['instructor_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">Instructor's photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body d-flex justify-content-center">
                            <img src="../images-users/<?php echo $row2['image']; ?>" alt="" width="200" height="200" class="img-circle" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                          </div>
                          <div class="modal-footer alert-light d-flex justify-content-center">
                            <a href="../images-users/<?php echo $row2['image']; ?>" type="button" class="btn bg-gradient-primary" download><i class="fa-solid fa-download"></i> Download</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- VIEW MODAL -->
                    <div class="modal fade" id="details<?php echo $row2['instructor_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            Instructor details
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row gutters-sm">
                              <div class="col-md-4 mb-3">
                                <div class="card mt-3">
                                  <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                      <img src="<?php if(!empty($row2['image'])) { echo '../images-users/'.$row2['image'].''; } else { echo '../images-users/user.jpg'; }?>" alt="Admin" class="rounded-circle" width="150" height="150" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                      <div class="mt-3">
                                        <h4><?= ucwords($row2['firstname']) ?></h4>
                                        <p class="text-secondary mb-1"><?= ucwords($row2['position']) ?></p>
                                      </div>
                                    </div>
                                    <hr>
                                    <p style="font-size: 15px; margin: 0;"><b>Employee ID:</b> <?= $row2['emp_ID'] ?></p>
                                    <p style="font-size: 15px;"><b>Department:</b> <?= ucwords($row2['dept_name']) ?></p>
                                    <p style="font-size: 15px;"><b>Birthday:</b> <?= $row2['birthdate'] ?></p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['gender']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['email']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        +63 <?= ucwords($row2['contact']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['address']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Employee Status</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['emp_status']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Contract From-To</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= $row2['hired_date'].' - '.$row2['hired_date'] ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Degrees held</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= $row2['degrees_held'] ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Major Study</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= $row2['major_study'] ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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
          </div>
        </div>

        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <span><i class="fa-solid fa-user"></i> Delete instructor</span>
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

    $('#example1').on('click', '.delete-instructor', function() {
          var instructor_ID = $(this).data('instructor-id'); // Retrieve dept_ID from the data attribute
          console.log("instructor_ID:", instructor_ID); // Check if dept_ID is retrieved correctly
          $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

          $('#confirmDelete').click(function() {
              console.log("Confirm delete clicked. instructor_ID:", instructor_ID); // Log dept_ID before AJAX request
              $.ajax({
                  type: 'POST',
                  url: '../includes/processes.php', // Your PHP file to handle deletion
                  data: { 
                    action: 'DeleteInstructorForm', 
                    instructor_ID: instructor_ID
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
                              window.location.href = "instructor.php";
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