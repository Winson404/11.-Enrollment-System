<title>Administrator records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrator</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Administrator records</li>
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
                <a href="admin_mgmt.php?page=create" class="btn btn-sm btn-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Administrator</a>

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
                      <th>FULL NAME</th>
                      <th>CONTACT DETAILS</th>
                      <th>USERTYPE</th>
                      <th>DATE ADDED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      $instructor = $db->getUsers();
                      while($row2 = $instructor->fetch_assoc()) {
                    ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#viewphoto<?php echo $row2['user_Id']; ?>">
                          <img src="../images-users/<?php echo $row2['image']; ?>" alt="" width="35" height="35" class="img-circle d-block m-auto" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        </a>
                      </td>
                      <td><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></td>
                      <td>
                        <i class="fas fa-envelope"></i>: <?= $row2['email'] ?> <br>
                        <i class="fas fa-phone"></i>: +63<?= ucwords($row2['contact']) ?>
                      </td>
                      <td>
                          <?php
                          $userType = $row2['user_type'];
                          $badgeClass = ($userType == 0) ? 'badge-danger' : 'badge-primary';
                          $userTypeName = ($userType == 0) ? 'Staff' : 'Administrator';
                          ?>
                          <span class="badge <?= $badgeClass ?>"><?= $userTypeName ?></span>
                      </td>
                      <td><?= date("F d, Y", strtotime($row2['created_at'])) ?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?php echo $row2['user_Id']; ?>"><i class="fas fa-eye"></i> View</button>
                        <a href="admin_mgmt.php?page=<?php echo $row2['user_Id']; ?>" type="button" class="btn btn-info btn-sm" <?php if($row2['user_type'] == 1) { echo 'style="pointer-events: none;opacity: .7;"'; } ?>><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button type="button" class="btn btn-danger btn-sm delete-admin" data-admin-id="<?= $row2['user_Id']; ?>" <?php if($row2['user_type'] == 1) { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    </tr>

                    <!-- VIEW PROFILE PHOTO -->
                    <div class="modal fade" id="viewphoto<?php echo $row2['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="modal fade" id="details<?php echo $row2['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            System user's details
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
                                        <h4><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></h4>
                                        <p class="text-secondary mb-1">
                                          <?php
                                            $userType = $row2['user_type'];
                                            $badgeClass = ($userType == 0) ? 'badge-danger' : 'badge-primary';
                                            $userTypeName = ($userType == 0) ? 'Staff' : 'Administrator';
                                          ?>
                                          <span class="badge <?= $badgeClass ?>"><?= $userTypeName ?></span>
                                        </p>
                                      </div>
                                    </div>
                                    <hr>
                                    <p style="font-size: 15px;"><b>Birthday:</b> <?= $row2['birthdate'] ?></p>
                                    <p style="font-size: 15px;"><b>Birthplace:</b> <?= ucwords($row2['birthplace']) ?></p>
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
                                        <h6 class="mb-0">Civil Status</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['civilstatus']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Occupation</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['occupation']) ?>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Religion</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['religion']) ?>
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
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                      </div>
                                      <div class="col-sm-9 text-secondary">
                                        <?= ucwords($row2['house_no'].' '.$row2['street_name'].' '.$row2['purok'].' '.$row2['zone'].' '.$row2['barangay'].' '.$row2['municipality'].' '.$row2['province'].' '.$row2['region']) ?>
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
                <span><i class="fa-solid fa-users-gear"></i> Delete administrator</span>
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
    });

</script>