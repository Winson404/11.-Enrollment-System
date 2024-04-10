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
            <li class="breadcrumb-item active">Admin Profile</li>
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
                <?php
                  $userType = $row['user_type'];
                  $badgeClass = ($userType == 0) ? 'badge-danger' : 'badge-primary';
                  $userTypeName = ($userType == 0) ? 'Staff' : 'Administrator';
                ?>
                <span class="badge <?= $badgeClass ?>"><?= $userTypeName ?></span>
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
                <?php echo ''.$row['house_no'].' '.$row['street_name'].' '.$row['purok'].' '.$row['zone'].' '.$row['barangay'].' '.$row['municipality'].' '.$row['province'].' '.$row['region'].''; ?>
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
                <li class="nav-item"><a class="nav-link" href="#updateprofile" data-toggle="tab">Update info</a></li>
                <li class="nav-item"><a class="nav-link" href="#profileupdate" data-toggle="tab">Profile update</a></li>
                <li class="nav-item"><a class="nav-link" href="#accountsecurity" data-toggle="tab">Account security</a></li>
              </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="viewprofile">
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
                        <h6 class="mb-0">Date of Birth</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?php echo $row['birthdate'] ?>
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
                        <h6 class="mb-0">Birthplace</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= ucwords($row['birthplace']) ?>
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
                        <h6 class="mb-0">Civil Status</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['civilstatus'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Occupation</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['occupation'] ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Religion</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <?= $row['religion'] ?>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="updateprofile">
                    <form id="UpdateAdminDetails" method="POST">
                      <input type="hidden" class="form-control" name="user_Id" id="user_Id" value="<?= $row['user_Id'] ?>" required>
                      <div class="form-group row">
                        <a  class="col-sm-12 text-primary text-bold">Basic information</a>
                      </div>
                      <div class="form-group row">
                        <label for="firstname" class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" value="<?= $row['firstname'] ?>" onkeyup="lettersOnly(this)" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="middlename" class="col-sm-2 col-form-label">Middle name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Middle name" value="<?= $row['middlename'] ?>" onkeyup="lettersOnly(this)">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lastname" class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value="<?= $row['lastname'] ?>" onkeyup="lettersOnly(this)" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="suffix" class="col-sm-2 col-form-label">Suffix</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Suffix" value="<?= $row['suffix'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="birthdate" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?= $row['birthdate'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="birthplace" class="col-sm-2 col-form-label">Birthplace</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace" value="<?= $row['birthplace'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="birthplace" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <?php
                          $genders = ['Male', 'Female'];
                          $selectedGender = $row['gender']; // Assuming $row contains the data for the current user
                          ?>
                          <select class="form-control" name="gender" id="gender" required>
                            <option selected disabled value="">Select sex</option>
                            <?php foreach ($genders as $gender): ?>
                            <option value="<?= $gender ?>" <?php if ($selectedGender === $gender) { echo 'selected'; } ?>><?= $gender ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="civilstatus" class="col-sm-2 col-form-label">Civil Status</label>
                        <div class="col-sm-10">
                          <?php
                            $statuses = ['Single', 'Married', 'Widow/ER', 'Separated'];
                            $selectedStatus = $row['civilstatus']; // Assuming $row contains the data for the current user
                            ?>
                            <select class="form-control" name="civilstatus" id="civilstatus" required>
                              <option selected disabled value="">Select status</option>
                              <?php foreach ($statuses as $status): ?>
                              <option value="<?= $status ?>" <?php if ($selectedStatus === $status) { echo 'selected'; } ?>><?= $status ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="occupation" class="col-sm-2 col-form-label">Occupation</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Profession/ Occupation" value="<?= $row['occupation'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                        <div class="col-sm-10">
                          <?php
                          $religions = ['Roman Catholic', 'Iglesia Ni Cristo', 'Evangelical Christianity', 'Islam', 'Protestants', 'Seventh-day Adventism', 'Aglipayan', 'Bible Baptist Church', 'United Church of Christ in the Philippines', "Jehovah's Witnesses", 'Buddhist', 'Methodist', 'Hindu', 'Judaism', 'Ang Dating Daan', 'Other Religion'];
                          $selectedreligion = $row['religion']; // Assuming $row contains the data for the current user
                          ?>
                          <select class="form-control" name="religion" id="religion" required>
                            <option selected disabled value="">Select religion</option>
                            <?php foreach ($religions as $religion): ?>
                            <option value="<?= $religion ?>" <?php if ($selectedreligion === $religion) { echo 'selected'; } ?>><?= $religion ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <a  class="col-sm-12 text-primary text-bold">Contact information</a>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $row['email'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="contact" class="col-sm-2 col-form-label">Contact number</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" name="contact" id="contact" placeholder="9123456789" value="<?= $row['contact'] ?>" maxlength="10" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <a  class="col-sm-12 text-primary text-bold">Address information</a>
                      </div>                      
                      <div class="form-group row">
                        <label for="house_no" class="col-sm-2 col-form-label">House No</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="house_no" id="house_no" placeholder="House No" value="<?= $row['house_no'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="street_name" class="col-sm-2 col-form-label">Street name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street name" value="<?= $row['street_name'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="purok" class="col-sm-2 col-form-label">Purok</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="purok" id="purok" placeholder="Purok" value="<?= $row['purok'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="zone" class="col-sm-2 col-form-label">Zone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="zone" id="zone" placeholder="Zone" value="<?= $row['zone'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="barangay" class="col-sm-2 col-form-label">Barangay</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" value="<?= $row['barangay'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="municipality" class="col-sm-2 col-form-label">Municipality</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="municipality" id="municipality" placeholder="Municipality" value="<?= $row['municipality'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="province" class="col-sm-2 col-form-label">Province</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?= $row['province'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="region" class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="region" id="region" placeholder="Region" value="<?= $row['region'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-12 d-flex justify-content-end">
                          <hr>
                          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="profileupdate">
                    <form id="updateProfileForm" method="POST" enctype="multipart/form-data">
                      <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="updateProfile_user_Id" id="updateProfile_user_Id">
                      <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="image" class="text-dark"><b>Update profile</b></label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="image" name="image" onchange="getImagePreview(event)" required>
                                  <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                              </div>
                              <small class="form-text text-danger">Max. 500KB</small>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                              <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                                <img id="imagePreview" src="<?php if(!empty($row['image'])) { echo '../images-users/'.$row['image']; } else { echo '../images/image-holder.png'; } ?>" alt="Image Preview" class="img-fluid" style="width: 100%;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <hr>
                          <div class="col-12 d-flex justify-content-end">
                            <hr>
                            <button type="submit" class="btn btn-primary btn-sm mr-5">Submit</button>
                          </div>
                        </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="accountsecurity">
                    <form id="updateAdminPassword" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="updatePassword_user_Id" id="updatePassword_user_Id">
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
  $('#UpdateAdminDetails').submit(function(e) {
      e.preventDefault();

      // Serialize form data into an object
      var formData = $(this).serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
      }, {});

      // Add custom action
      formData.action = 'UpdateAdminDetails';

      $.ajax({
          type: 'POST',
          url: '../includes/processes.php',
          data: formData,
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
                type: 'Administrator',
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





    // Add event listener to form submission
    $('#updateProfileForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'updateProfileForm');

        // Optional: Add image file to formData if it exists
        var imageFile = $('#image')[0].files[0];
        if (imageFile) {
            formData.append('image', imageFile);
        }

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: formData,
            contentType: false,
            processData: false,
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


  