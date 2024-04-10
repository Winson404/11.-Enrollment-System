<title>Student records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student records</li>
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
                <a href="users_mgmt.php?page=create" class="btn btn-sm btn-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Student</a>

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
                      <th>STUD ID</th>
                      <th>STUDENT NAME</th>
                      <th>DEPARTMENT/COURSE</th>
                      <th>YEAR LEVEL</th>
                      <th>STATUS</th>
                      <!-- <th>DATE ADDED</th> -->
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $instructor = $db->getStudents();
                      while($row2 = $instructor->fetch_assoc()) {
                    ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#viewphoto<?php echo $row2['stud_ID']; ?>">
                          <img src="../images-users/<?php echo $row2['image']; ?>" alt="" width="35" height="35" class="img-circle d-block m-auto" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        </a>
                      </td>
                      <td><?= $row2['student_ID'] ?></td>
                      <td><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></td>
                      <td>
                        <b>Department:</b> <?= $row2['dept_name'] ?> <br>
                        <b>Course:</b> <?= ucwords($row2['course_name']) ?>
                      </td>
                      <td><?= $row2['level'] ?></td>
                      <td>
                        <span class="badge badge-<?php echo $row2['student_status'] == 0 ? 'danger' : 'success'; ?>">
                          <?php echo $row2['student_status'] == 0 ? 'Pending' : 'Verified'; ?>
                        </span>
                      </td>
                      <!-- <td><?= date("F d, Y", strtotime($row2['date_created'])) ?></td> -->
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?php echo $row2['stud_ID']; ?>"><i class="fas fa-eye"></i> View</button>
                        <a href="users_payments.php?stud_ID=<?= $row2['stud_ID'] ?>" type="button" class="btn btn-warning btn-sm"><i class="fas fa-coins"></i> Payment</a>
                        <a href="users_verify.php?stud_ID=<?= $row2['stud_ID'] ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Verify</a>
                        <a href="users_mgmt.php?page=<?= $row2['stud_ID'] ?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-student" data-student-id="<?= $row2['stud_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    </tr>

                    <!-- VIEW PROFILE PHOTO -->
                    <div class="modal fade" id="viewphoto<?php echo $row2['stud_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">Student's photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body d-flex justify-content-center">
                            <img src="../images-users/<?= $row2['image'] ?>" alt="" width="200" height="200" class="img-circle" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                          </div>
                          <div class="modal-footer alert-light d-flex justify-content-center">
                            <a href="../images-users/<?= $row2['image'] ?>" type="button" class="btn bg-gradient-primary" download><i class="fa-solid fa-download"></i> Download</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- VIEW MODAL -->
                    <div class="modal fade" id="details<?php echo $row2['stud_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            Student's details
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row gutters-sm">
                              <div class="col-md-3 mb-3">
                                <div class="card mt-3">
                                  <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                      <img src="<?php if(!empty($row2['image'])) { echo '../images-users/'.$row2['image'].''; } else { echo '../images-users/user.jpg'; }?>" alt="Admin" class="rounded-circle" width="150" height="150" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                      <div class="mt-3">
                                        <h4><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></h4>
                                        <p class="text-secondary mb-1">Type: <?= $row2['stud_type'] ?></p>
                                        <p class="text-secondary mb-1">Stud ID: <?= $row2['student_ID'] ?></p>
                                      </div>
                                    </div>
                                    <hr>
                                    <p style="font-size: 15px;"><b>GWA:</b> <?= $row2['GWA'] ?></p>
                                    <p style="font-size: 15px;"><b>Year Level:</b> <?= ucwords($row2['level']) ?></p>
                                    <p style="font-size: 15px;"><b>Course:</b> <?= ucwords($row2['course_name']) ?></p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <a href="">Basic info</a>
                                        <hr>
                                      </div>
                                    </div>
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
                                        <h6 class="mb-0">Birthday</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= $row2['birthdate'] ?>
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
                                        <h6 class="mb-0">Citizenship</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['citizenship']) ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <a href="">Contact details</a>
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
                                        <h6 class="mb-0">Contact number</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        +63 <?= ucwords($row2['contact']) ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php if($row2['stud_type'] == 'New Student' || $row2['stud_type'] == 'Transferee Student'): ?>
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <a href="">School information</a>
                                        <hr>
                                      </div>
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Past School Name</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['school_name']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Past School Address</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['school_address']) ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php endif; ?>
                              </div>
                              <div class="col-md-4">
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <a href="">Parents/Guardian information</a>
                                        <hr>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Parent's/Guardian name</h6>
                                        <p>‣ <?= ucwords($row2['parent_name']) ?></p>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Relationship to student</h6>
                                        <p>‣ <?= ucwords($row2['parent_relationship']) ?></p>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Parent's Contact number</h6>
                                        <p>‣ +63<?= $row2['parent_contact'] ?></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="card mb-3 mt-3">
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <a href="">Contact in case of emergency</a>
                                        <hr>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Emergency contact name</h6>
                                        <p>‣ <?= ucwords($row2['emergency_contact_name']) ?></p>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Relationship to student</h6>
                                        <p>‣ <?= ucwords($row2['relationship_to_student']) ?></p>
                                      </div>
                                      <div class="col-sm-12">
                                        <h6 class="mb-0">Emergency contact number</h6>
                                        <p>‣ +63<?= $row2['emergency_contact'] ?></p>
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
                <span><i class="fas fa-graduation-cap"></i> Delete student</span>
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

    $('#example1').on('click', '.delete-admin', function() {
          var user_Id = $(this).data('admin-id'); // Retrieve dept_ID from the data attribute
          console.log("user_Id:", user_Id); // Check if dept_ID is retrieved correctly
          $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

          $('#confirmDelete').click(function() {
              console.log("Confirm delete clicked. user_Id:", user_Id); // Log dept_ID before AJAX request
              $.ajax({
                  type: 'POST',
                  url: '../includes/processes.php', // Your PHP file to handle deletion
                  data: { 
                    action: 'DeleteAdminForm', 
                    user_Id: user_Id
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
                              window.location.href = "admin.php";
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


    $('#example1').on('click', '.delete-student', function() {
      var stud_ID = $(this).data('student-id'); // Retrieve dept_ID from the data attribute
      console.log("stud_ID:", stud_ID); // Check if dept_ID is retrieved correctly
      $('#deleteConfirmationModal').modal('show'); // Show delete confirmation modal

      $('#confirmDelete').click(function() {
          console.log("Confirm delete clicked. stud_ID:", stud_ID); // Log dept_ID before AJAX request
          $.ajax({
              type: 'POST',
              url: '../includes/processes.php', // Your PHP file to handle deletion
              data: { 
                action: 'DeleteStudentForm', 
                stud_ID: stud_ID
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
                          // Redirect to users.php after success
                          window.location.href = "users.php";
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