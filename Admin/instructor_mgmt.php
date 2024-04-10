<title>Enrollment System | Manage Instructor</title>
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
          <h1>Instructor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Instructor Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="AddInstructorForm" method="POST" enctype="multipart/form-data">
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
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
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
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" id="firstname" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" id="middlename" onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" id="lastname" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Ext/Suffix</b></span>
                  <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" id="suffix">
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                  <span class="text-dark"><b>Date of Birth</b></span>
                  <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
              </div>
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Contact details</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder="9123456789" required maxlength="10">
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
              </div>
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Address</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Complete address</b></span>
                  <textarea class="form-control" name="address" id="address" rows="2" placeholder="Complete address" required></textarea>
                </div>
              </div>

              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>School Information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Employee ID</b></span>
                  <input type="text" class="form-control" placeholder="Employee ID" name="emp_ID" id="emp_ID" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Department</span>
                  <select name="dept_ID" id="dept_ID" class="form-control" required>
                    <option value="" selected disabled>Select department</option>
                    <?php
                    $fetch2 = $db->getDepartment();
                    if($fetch2->num_rows > 0) {
                    while($row2 = $fetch2->fetch_assoc()) {
                    echo '<option value="'.$row2['dept_ID'].'">'.$row2['dept_name'].'</option>';
                    }
                    } else {
                    echo '<option value="" selected disabled>No record found</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Position</b></span>
                  <input type="text" class="form-control" placeholder="Position" name="position" id="position" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Employment Status</b></span>
                  <select name="emp_status" id="emp_status" class="form-control" required>
                    <option value="" selected disabled>Select status</option>
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Temporary">Temporary</option>
                    <option value="Adjunct">Adjunct</option>
                    <option value="Permanent">Permanent</option>
                    <option value="Probationary">Probationary</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Date hired</b></span>
                  <input type="date" class="form-control" placeholder="Date hired" name="hired_date" id="hired_date" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contract end date</b></span>
                  <input type="date" class="form-control" placeholder="Date hired" name="contract_end" id="contract_end" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Degrees held</b></span>
                  <textarea class="form-control" name="degrees_held" id="degrees_held" rows="2" placeholder="Degrees held" required></textarea>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Major Study</b></span>
                  <textarea class="form-control" name="major_study" id="major_study" rows="2" placeholder="Major Study" required></textarea>
                </div>
              </div>

              <div class="col-lg-12 mt-3 mb-2">
                <a class="h5 text-primary"><b>Additional information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Instructor's photo</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" onchange="getImagePreview(event)">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                   
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                <div class="form-group">
                  <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                  <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                    <img id="imagePreview" src="../images/image-holder.png" alt="Image Preview" class="img-fluid" style="width: 100%;">
                  </div>
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
                          <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8" style="text-transform: none;">
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
                          <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_confirm_password()" required minlength="8" style="text-transform: none;">
                          <div class="input-group-append">
                              <span class="input-group-text" id="eye-toggle-cpassword" onclick="togglePasswordVisibility('cpassword')">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                              </span>
                          </div>
                      </div>
                      <small id="wrong_pass_alert" class="text-bold" style="font-style: italic; font-size: 12px;"></small>
                  </div>
              </div>
              
            </div>
            <!-- END ROW -->
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="instructor.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php } else { 
    $instructor_ID = $page;
    $instructor = $db->getInstructor($instructor_ID);
    $row2 = $instructor->fetch_assoc();
  ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Instructor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Instructor Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="UpdateInstructorForm" method="POST" enctype="multipart/form-data">        
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

            <input type="hidden" class="form-control" id="instructor_ID" name="instructor_ID" value="<?= $instructor_ID ?>" required>

            <div class="row">
              <div class="col-lg-12 mt-1 mb-2">
                <a class="h5 text-primary"><b>Basic information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <span class="text-dark text-bold">Academic year</span>
                        <select name="year_ID" id="year_ID" class="form-control" required>
                          <option value="" selected disabled>Select academic year</option>
                          <?php
                            $sem = $db->getActiveAcadYear();
                            if($sem->num_rows > 0) {
                              while($row3 = $sem->fetch_assoc()) {
                                echo '<option value="'.$row3['year_ID'].'" selected>'.$row3['year_from'].'-'.$row3['year_to'].'</option>';
                              }
                            } else {
                              echo '<option value="" selected disabled>No record found</option>';
                            }
                          ?>
                        </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" id="firstname"  value="<?= $row2['firstname'] ?>" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" id="middlename"  value="<?= $row2['middlename'] ?>" onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" id="lastname"  value="<?= $row2['lastname'] ?>" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Ext/Suffix</b></span>
                  <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" id="suffix" value="<?= $row2['suffix'] ?>" >
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                  <span class="text-dark"><b>Date of Birth</b></span>
                  <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>" value="<?= $row2['birthdate'] ?>" required>
                </div>
              </div>
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Contact details</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder="9123456789" required value="<?= $row2['contact'] ?>" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" value="<?= $row2['email'] ?>" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
              </div>
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Address</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Complete address</b></span>
                  <textarea class="form-control" name="address" id="address" rows="2" placeholder="Complete address" required><?= $row2['address'] ?></textarea>
                </div>
              </div>

              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>School Information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Employee ID</b></span>
                  <input type="text" class="form-control" placeholder="Employee ID" name="emp_ID" id="emp_ID" value="<?= $row2['emp_ID'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark text-bold">Department</span>
                  <select name="dept_ID" id="dept_ID" class="form-control" required>
                      <option value="" disabled>Select department</option>
                      <?php
                      $fetch2 = $db->getDepartment();
                      if($fetch2->num_rows > 0) {
                          while($row4 = $fetch2->fetch_assoc()) {
                              // Check if the department ID matches the instructor's department ID
                              $selected = ($row4['dept_ID'] == $row2['dept_ID']) ? 'selected' : '';
                              echo '<option value="'.$row4['dept_ID'].'" '.$selected.'>'.$row4['dept_name'].'</option>';
                          }
                      } else {
                          echo '<option value="" disabled>No record found</option>';
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Position</b></span>
                  <input type="text" class="form-control" placeholder="Position" name="position" id="position" value="<?= $row2['position'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Employment Status</b></span>
                  <select name="emp_status" id="emp_status" class="form-control" required>
                    <option value="" selected disabled>Select status</option>
                    <option value="Full-Time" <?php if($row2['emp_status'] == 'Full-Time') { echo 'selected'; } ?>>Full-Time</option>
                    <option value="Part-Time" <?php if($row2['emp_status'] == 'Part-Time') { echo 'selected'; } ?>>Part-Time</option>
                    <option value="Contract" <?php if($row2['emp_status'] == 'Contract') { echo 'selected'; } ?>>Contract</option>
                    <option value="Temporary" <?php if($row2['emp_status'] == 'Temporary') { echo 'selected'; } ?>>Temporary</option>
                    <option value="Adjunct" <?php if($row2['emp_status'] == 'Adjunct') { echo 'selected'; } ?>>Adjunct</option>
                    <option value="Permanent" <?php if($row2['emp_status'] == 'Permanent') { echo 'selected'; } ?>>Permanent</option>
                    <option value="Probationary" <?php if($row2['emp_status'] == 'Probationary') { echo 'selected'; } ?>>Probationary</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Date hired</b></span>
                  <input type="date" class="form-control" placeholder="Date hired" name="hired_date" id="hired_date" value="<?= $row2['hired_date'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contract end date</b></span>
                  <input type="date" class="form-control" placeholder="Date hired" name="contract_end" id="contract_end" value="<?= $row2['contract_end'] ?>" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Degrees held</b></span>
                  <textarea class="form-control" name="degrees_held" id="degrees_held" rows="2" placeholder="Degrees held" required><?= $row2['degrees_held'] ?></textarea>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Major Study</b></span>
                  <textarea class="form-control" name="major_study" id="major_study" rows="2" placeholder="Major Study" required><?= $row2['major_study'] ?></textarea>
                </div>
              </div>

              <div class="col-lg-12 mt-3 mb-2">
                <a class="h5 text-primary"><b>Additional information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Instructor's photo</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" onchange="getImagePreview(event)">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                   
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
              </div>
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
            <a href="instructor.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
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
    $('#AddInstructorForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);


        // Add action parameter
        formData.append('action', 'AddInstructorForm');

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
                        window.location.href = "instructor.php";
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
    //                     window.location.href = "instructor.php";
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
    $('#UpdateInstructorForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);


        // Add action parameter
        formData.append('action', 'UpdateInstructorForm');

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
                        window.location.href = "instructor.php";
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
