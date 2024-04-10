<title>Enrollment System | Profile</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <?php if($row['image'] == ""): ?>
                <img src="../dist/img/avatar.png" alt="User Avatar" class="img-size-50 img-circle">
                <?php else: ?>
                <img class="profile-user-img img-fluid img-circle"src="../images-users/<?php echo $row['image']; ?>"alt="User profile picture"  style="height: 90px; width: 90px; border-radius: 50%;">
                <?php endif; ?>
                
              </div>
              <h3 class="profile-username text-center"><?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?></h3>
              <p class="text-muted text-center">
               
                <span class="badge badge-primary"><?= $row['stud_type'] ?></span>
              </p>
              <!-- <a class="btn bg-gradient-primary btn-block">Profile</a> -->
            </div>
          </div>
          <div class="card card-primary">
            <div class="card-header bg-gradient-primary">
              <h3 class="card-title">About Me</h3>
            </div>
            <div class="card-body">
              <strong><i class="fas fa-location mr-1"></i> Address</strong>
              <p class="text-muted">
                <?= $row['address'] ?>
              </p>
              <hr>
              <strong><i class="fa-solid fa-calendar-days"></i> Date registered</strong>
              <p class="text-muted ml-3"><?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></p>
              <hr>
              <!--  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>
              <hr>
              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#viewprofile" data-toggle="tab">Profile info</a></li>
                <li class="nav-item"><a class="nav-link" href="#accountsecurity" data-toggle="tab">Account security</a></li>
              </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="viewprofile">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Student type</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['stud_type']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Student ID</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['student_ID']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Gender</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['gender']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Date of Birth</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $row['birthdate'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $row['address'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['email']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        +63 <?= ucwords($row['contact']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">GWA</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['GWA']) ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Year level</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['level'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Course</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['course_name'] ?>
                      </div>
                    </div>
                    <?php if($row['stud_type'] == 'New Student' || $row['stud_type'] == 'Transferee Student'): ?>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Last School Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['school_name'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Last School Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['school_address'] ?>
                      </div>
                    </div>
                <?php endif; ?>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Citizenship</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['citizenship'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Emergency Contact Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['emergency_contact_name'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Relationship to student</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['relationship_to_student'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Emergency contact number</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['emergency_contact'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Parent's/Guardian's name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['parent_name'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Parent's/Guardian's Relationship to Student</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['parent_relationship'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Parent's/Guardian's Contact number</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?= $row['parent_contact'] ?>
                        </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="accountsecurity">
                    <form id="updateAdminPassword" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" value="<?php echo $row['stud_ID']; ?>" name="updatePassword_user_Id" id="updatePassword_user_Id">
                        <div class="form-group row">
                            <label for="OldPassword" class="col-sm-2 col-form-label">Old password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="OldPassword" placeholder="Old password" name="OldPassword" required minlength="8" style="text-transform: none;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                            <i class="fas fa-eye" id="eyeOldPassword"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">New password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required id="password" minlength="8" style="text-transform: none;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye" id="eyePassword"></i>
                                        </button>
                                    </div>
                                </div>
                                <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cpassword" class="col-sm-2 col-form-label">Confirm password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Confirm password" name="cpassword" required id="cpassword" onkeyup="validate_confirm_password()" minlength="8" style="text-transform: none;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye" id="eyeConfirmPassword"></i>
                                        </button>
                                    </div>
                                </div>
                                <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn bg-gradient-primary" id="submit_button">Submit</button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php require_once '../includes/footer.php'; ?>

<script>

  $(document).ready(function () {

    $('#toggleOldPassword').click(function () {
        var input = $('#OldPassword');
        var icon = $('#eyeOldPassword');
        togglePasswordVisibility(input, icon);
    });

    $('#togglePassword').click(function () {
        var input = $('#password');
        var icon = $('#eyePassword');
        togglePasswordVisibility(input, icon);
    });

    $('#toggleConfirmPassword').click(function () {
        var input = $('#cpassword');
        var icon = $('#eyeConfirmPassword');
        togglePasswordVisibility(input, icon);
    });

    function togglePasswordVisibility(input, icon) {
        var type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        icon.toggleClass('fa-eye fa-eye-slash');
    }








  // Add event listener to form submission
    $('#updateAdminPassword').submit(function(e) {
        e.preventDefault();
        var user_Id = $('#updatePassword_user_Id').val();
        var OldPassword = $('#OldPassword').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: {
                action: 'updateAdminPassword',
                type: 'Student',
                user_Id: user_Id,
                OldPassword: OldPassword,
                password: password,
                cpassword: cpassword
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
                        // Redirect to profile.php after success
                        window.location.href = "profile.php";
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


  