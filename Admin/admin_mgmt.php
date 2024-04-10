<title>Enrollment System | Manage Administrator</title>
<?php 
    require_once 'sidebar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

<div class="content-wrapper">
  <?php if($page === 'create') { ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Administrator Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form id="AddAdminForm" method="POST" enctype="multipart/form-data">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Fill-in the required fields below</h3>
              <div class="card-tools mt-2">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 mt-1 mb-2">
                  <a class="h5 text-primary"><b>Basic information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <div class="form-group">
                      <span class="text-dark"><b>User type</b></span>
                      <select class="form-control" name="user_type" id="user_type" required>
                        <option selected disabled value="">Select type</option>
                        <option value="0">Staff</option>
                        <option value="1">Admin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col col-md-6 col-sm-6 col-12"></div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>First name</b></span>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" onkeyup="lettersOnly(this)" required>
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Middle name</b></span>
                    <input type="text" class="form-control"  name="middlename" id="middlename" placeholder="Middle name" onkeyup="lettersOnly(this)">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Last name</b></span>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" onkeyup="lettersOnly(this)" required>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Ext/Suffix</b></span>
                    <input type="text" class="form-control" name="suffix" id="Suffix" placeholder="Ext/Suffix">
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Date of Birth</b></span>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Place of Birth</b></span>
                    <textarea class="form-control" name="birthplace" id="birthplace" placeholder="Place of Birth" cols="30" rows="1" required></textarea>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Sex</b></span>
                    <select class="form-control" name="gender" id="gender" required>
                      <option selected disabled value="">Select sex</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Civil Status</b></span>
                    <select class="form-control" name="civilstatus" id="civilstatus" required>
                      <option selected disabled value="">Select status</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widow/ER">Widow/ER</option>
                      <option value="Separated">Separated</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Profession/ Occupation</b></span>
                    <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Profession/ Occupation" required>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Religion</b></span>
                    <select class="form-control" name="religion" id="religion" required>
                      <option selected disabled value="">Select religion</option>
                      <option value="Roman Catholic">Roman Catholic</option>
                      <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                      <option value="Evangelical Christianity">Evangelical Christianity</option>
                      <option value="Islam">Islam</option>
                      <option value="Protestants">Protestants</option>
                      <option value="Seventh-day Adventism">Seventh-day Adventism</option>
                      <option value="Aglipayan">Aglipayan</option>
                      <option value="Bible Baptist Church">Bible Baptist Church</option>
                      <option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
                      <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
                      <option value="Buddhist">Buddhist</option>
                      <option value="Methodist">Methodist</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Judaism">Judaism</option>
                      <option value="Ang Dating Daan">Ang Dating Daan</option>
                      <option value="Other Religion">Other Religion</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Contact details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Email</b></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" onkeydown="validation()" onkeyup="validation()" required>
                    <small id="text" style="font-style: italic;"></small>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Contact number</b></span>
                    <div class="input-group">
                      <div class="input-group-text">+63</div>
                      <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" maxlength="10" required>
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Complete address</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>House No.</b></span>
                    <input type="text" class="form-control" name="house_no" id="house_no" placeholder="House No.">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Street name</b></span>
                    <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street name">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Sitio/Purok</b></span>
                    <input type="text" class="form-control" name="purok" id="purok" placeholder="Sitio/Purok">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Zone</b></span>
                    <input type="text" class="form-control"  name="zone" id="zone" placeholder="Zone">
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Barangay</b></span>
                    <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Municipality</b></span>
                    <input type="text" class="form-control" name="municipality" id="municipality" placeholder="Municipality" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Province</b></span>
                    <input type="text" class="form-control" name="province" id="province" placeholder="Province" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Region</b></span>
                    <input type="text" class="form-control" name="region" id="region" placeholder="Region" required>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Account password</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <span class="text-dark"><b>Password</b></span>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" minlength="8" style="text-transform: none;" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="eye-toggle-password" onclick="togglePasswordVisibility('password')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <span id="password-message" class="text-bold" style="font-style: italic; font-size: 12px; color: #e60000;"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <span class="text-dark"><b>Confirm password</b></span>
                        <div class="input-group">
                            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Retype password" onkeyup="validate_confirm_password()" minlength="8" style="text-transform: none;" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="eye-toggle-cpassword" onclick="togglePasswordVisibility('cpassword')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <small id="wrong_pass_alert" class="text-bold" style="font-style: italic; font-size: 12px;"></small>
                    </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Additional information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Administrator's photo</b></span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" onchange="getImagePreview(event)">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                     <!--  <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                    </div>
                    <p class="help-block text-danger">Max. 500KB</p>
                  </div>
                </div>
                <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                  <div class="form-group">
                    <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                    <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                      <img id="imagePreview" src="../images/image-holder.png" alt="Image Preview" class="img-fluid" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer d-flex justify-content-end">
              <a href="admin.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <?php } else { 
    $user_Id = $page;
    $instructor = $db->getUsers($user_Id);
    $row2 = $instructor->fetch_assoc();
  ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Administrator Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form id="UpdateAdminForm" method="POST" enctype="multipart/form-data">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Fill-in the required fields below</h3>
              <div class="card-tools mt-2">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <input type="hidden" class="form-control" name="user_Id" id="user_Id" value="<?= $user_Id ?>" required>

              <div class="row">
                <div class="col-lg-12 mt-1 mb-2">
                  <a class="h5 text-primary"><b>Basic information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <div class="form-group">
                      <span class="text-dark"><b>User type</b></span>
                      <select class="form-control" name="user_type" id="user_type" required>
                        <option selected disabled value="">Select type</option>
                        <option value="0" <?php if($row2['user_type'] == 0) { echo 'selected'; } ?>>Staff</option>
                        <option value="1" <?php if($row2['user_type'] == 1) { echo 'selected'; } ?>>Admin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col col-md-6 col-sm-6 col-12"></div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>First name</b></span>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" onkeyup="lettersOnly(this)" value="<?= $row2['firstname'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Middle name</b></span>
                    <input type="text" class="form-control"  name="middlename" id="middlename" placeholder="Middle name" onkeyup="lettersOnly(this)" value="<?= $row2['middlename'] ?>">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Last name</b></span>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" onkeyup="lettersOnly(this)"  value="<?= $row2['lastname'] ?>"required>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Ext/Suffix</b></span>
                    <input type="text" class="form-control" name="suffix" id="Suffix" placeholder="Ext/Suffix" value="<?= $row2['suffix'] ?>">
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Date of Birth</b></span>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>"  value="<?= $row2['birthdate'] ?>"required>
                  </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Place of Birth</b></span>
                    <textarea class="form-control" name="birthplace" id="birthplace" placeholder="Place of Birth" cols="30" rows="1" required><?= $row2['birthplace'] ?></textarea>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Sex</b></span>
                    <select class="form-control" name="gender" id="gender" required>
                      <option selected disabled value="">Select sex</option>
                      <option value="Male" <?php if($row2['gender'] == 'Male') { echo 'selected'; } ?>>Male</option>
                      <option value="Female" <?php if($row2['gender'] == 'Female') { echo 'selected'; } ?>>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Civil Status</b></span>
                    <select class="form-control" name="civilstatus" id="civilstatus" required>
                      <option selected disabled value="">Select status</option>
                      <option value="Single" <?php if($row2['civilstatus'] == 'Single') { echo 'selected'; } ?>>Single</option>
                      <option value="Married" <?php if($row2['civilstatus'] == 'Married') { echo 'selected'; } ?>>Married</option>
                      <option value="Widow/ER" <?php if($row2['civilstatus'] == 'Widow/ER') { echo 'selected'; } ?>>Widow/ER</option>
                      <option value="Separated" <?php if($row2['civilstatus'] == 'Separated') { echo 'selected'; } ?>>Separated</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Profession/ Occupation</b></span>
                    <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Profession/ Occupation" value="<?= $row2['occupation'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Religion</b></span>
                    <select class="form-control" name="religion" id="religion" required>
                      <option selected disabled value="">Select religion</option>
                      <option value="Roman Catholic" <?php if($row2['religion'] == 'Roman Catholic') { echo 'selected'; } ?>>Roman Catholic</option>
                      <option value="Iglesia Ni Cristo" <?php if($row2['religion'] == 'Iglesia Ni Cristo') { echo 'selected'; } ?>>Iglesia Ni Cristo</option>
                      <option value="Evangelical Christianity" <?php if($row2['religion'] == 'Evangelical Christianity') { echo 'selected'; } ?>>Evangelical Christianity</option>
                      <option value="Islam" <?php if($row2['religion'] == 'Islam') { echo 'selected'; } ?>>Islam</option>
                      <option value="Protestants" <?php if($row2['religion'] == 'Protestants') { echo 'selected'; } ?>>Protestants</option>
                      <option value="Seventh-day Adventism" <?php if($row2['religion'] == 'Seventh-day Adventism') { echo 'selected'; } ?>>Seventh-day Adventism</option>
                      <option value="Aglipayan" <?php if($row2['religion'] == 'Aglipayan') { echo 'selected'; } ?>>Aglipayan</option>
                      <option value="Bible Baptist Church" <?php if($row2['religion'] == 'Bible Baptist Church') { echo 'selected'; } ?>>Bible Baptist Church</option>
                      <option value="United Church of Christ in the Philippines" <?php if($row2['religion'] == 'United Church of Christ in the Philippines') { echo 'selected'; } ?>>United Church of Christ in the Philippines</option>
                      <option value="Jehovah's Witnesses" <?php if($row2['religion'] == "Jehovah's Witnesses") { echo 'selected'; } ?>>Jehovah's Witnesses</option>
                      <option value="Buddhist" <?php if($row2['religion'] == 'Buddhist') { echo 'selected'; } ?>>Buddhist</option>
                      <option value="Methodist" <?php if($row2['religion'] == 'Methodist') { echo 'selected'; } ?>>Methodist</option>
                      <option value="Hindu" <?php if($row2['religion'] == 'Hindu') { echo 'selected'; } ?>>Hindu</option>
                      <option value="Judaism" <?php if($row2['religion'] == 'Judaism') { echo 'selected'; } ?>>Judaism</option>
                      <option value="Ang Dating Daan" <?php if($row2['religion'] == 'Ang Dating Daan') { echo 'selected'; } ?>>Ang Dating Daan</option>
                      <option value="Other Religion" <?php if($row2['religion'] == 'Other Religion') { echo 'selected'; } ?>>Other Religion</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Contact details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Email</b></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" onkeydown="validation()" onkeyup="validation()" value="<?= $row2['email'] ?>" required>
                    <small id="text" style="font-style: italic;"></small>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Contact number</b></span>
                    <div class="input-group">
                      <div class="input-group-text">+63</div>
                      <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" maxlength="10" value="<?= $row2['contact'] ?>" required>
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Complete address</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>House No.</b></span>
                    <input type="text" class="form-control" name="house_no" id="house_no" placeholder="House No."value="<?= $row2['house_no'] ?>" >
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Street name</b></span>
                    <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street name"value="<?= $row2['street_name'] ?>" >
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Sitio/Purok</b></span>
                    <input type="text" class="form-control" name="purok" id="purok" placeholder="Sitio/Purok"value="<?= $row2['purok'] ?>" >
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Zone</b></span>
                    <input type="text" class="form-control"  name="zone" id="zone" placeholder="Zone"value="<?= $row2['zone'] ?>" >
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Barangay</b></span>
                    <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" value="<?= $row2['barangay'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Municipality</b></span>
                    <input type="text" class="form-control" name="municipality" id="municipality" placeholder="Municipality" value="<?= $row2['municipality'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Province</b></span>
                    <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?= $row2['province'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Region</b></span>
                    <input type="text" class="form-control" name="region" id="region" placeholder="Region" value="<?= $row2['region'] ?>" required>
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Additional information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Administrator's photo</b></span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" onchange="getImagePreview(event)">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                     <!--  <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                    </div>
                    <p class="help-block text-danger">Max. 500KB</p>
                  </div>
                </div>
                <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                  <div class="form-group">
                    <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                    <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                      <img id="imagePreview" src="<?php if(!empty($row2['image'])) { echo '../images-users/'.$row2['image']; } else { echo '../images/image-holder.png'; } ?>" alt="Image Preview" class="img-fluid" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer d-flex justify-content-end">
              <a href="admin.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
              <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <?php } } else { require_once '../includes/404.php'; } ?>
<br>
<br>
<br>
<?php require_once '../includes/footer.php'; ?>


<script>
  $(document).ready(function() {
      
   // Add event listener to form submission
    $('#AddAdminForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'AddAdminForm');

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
                        window.location.href = "admin.php";
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

    // // Add event listener to form submission
    // $('#AddInstructorForm').submit(function(e) {
    //     e.preventDefault();
    //     var year_ID      = $('#year_ID').val();
    //     var firstname    = $('#firstname').val();
    //     var middlename   = $('#middlename').val();
    //     var lastname     = $('#lastname').val();
    //     var suffix       = $('#suffix').val();
    //     var gender       = $('#gender').val();
    //     var birthdate    = $('#birthdate').val();
    //     var contact        = $('#contact').val();
    //     var email        = $('#email').val();
    //     var address      = $('#address').val();
    //     var emp_ID       = $('#emp_ID').val();
    //     var dept_ID      = $('#dept_ID').val();
    //     var position     = $('#position').val();
    //     var emp_status   = $('#emp_status').val();
    //     var hired_date   = $('#hired_date').val();
    //     var contract_end = $('#contract_end').val();
    //     var degrees_held = $('#degrees_held').val();
    //     var major_study  = $('#major_study').val();
    //     var image        = $('#image').val();
    //     var password     = $('#password').val();
    //     var cpassword    = $('#cpassword').val();

        
    //     $.ajax({
    //         type: 'POST',
    //         url: '../includes/processes.php',
    //         data: {
    //             action: 'AddInstructorForm',
    //             year_ID      : year_ID,
    //             firstname    : firstname,
    //             middlename   : middlename,
    //             lastname     : lastname,
    //             suffix       : suffix,
    //             gender       : gender,
    //             birthdate    : birthdate,
    //             contact        : contact,
    //             email        : email,
    //             address      : address,
    //             emp_ID       : emp_ID,
    //             dept_ID      : dept_ID,
    //             position     : position,
    //             emp_status   : emp_status,
    //             hired_date   : hired_date,
    //             contract_end : contract_end,
    //             degrees_held : degrees_held,
    //             major_study  : major_study,
    //             image        : image,
    //             password     : password,
    //             cpassword    : cpassword

    //         },
    //         success: function(response) {
    //             if (response.success) {
    //                 Swal.fire({
    //                     title: "Success",
    //                     text: response.message,
    //                     icon: "success",
    //                     timer: 1500,
    //                     timerProgressBar: true,
    //                     showConfirmButton: true
    //                 }).then(function() {
    //                     // Redirect to academic_year.php after success
    //                     window.location.href = "admin.php";
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     title: "Error",
    //                     text: response.message,
    //                     icon: "error",
    //                     timer: 1500,
    //                     timerProgressBar: true,
    //                     showConfirmButton: true
    //                 });
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // });





    // Add event listener to form submission
    $('#UpdateAdminForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);


        // Add action parameter
        formData.append('action', 'UpdateAdminForm');

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
                        window.location.href = "admin.php";
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
