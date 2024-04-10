<title>Enrollment System | Manage Student</title>
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
          <h1>Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="AddStudentForm" method="POST" enctype="multipart/form-data">
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
              <div class="col-12">
                <div class="row">                   
                  <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Type of Student</b></span>
                      <select class="form-control" name="stud_type" id="stud_type" required onchange="toggleSchoolFields()">
                          <option selected disabled value="">Select type</option>
                          <option value="Old Student">Old Student</option>
                          <option value="New Student">New Student</option>
                          <option value="Returnee Student">Returnee Student</option>
                          <option value="Transferee Student">Transferee Student</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Student ID #</b></span>
                      <input type="text" class="form-control" name="student_ID" id="student_ID" placeholder="Enter Student ID here" required>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <span class="text-dark text-bold">Academic year</span>
                        <select name="year_ID" id="year_ID" class="form-control" required>
                          <option value="" selected disabled>Select academic year</option>
                          <?php
                            $acad = $db->getActiveAcadYear();
                            if($acad->num_rows > 0) {
                              while($row2 = $acad->fetch_assoc()) {
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

              <div class="col-lg-12 mt-1 mb-2">
                <a class="h5 text-primary"><b>Basic information</b></a>
                <div class="dropdown-divider"></div>
              </div>
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
                  <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Ext/Suffix">
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
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Date of Birth</b></span>
                  <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
              </div>
              <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Complete Address</b></span>
                  <textarea class="form-control" name="address" id="address" placeholder="Complete Address" cols="30" rows="1" required></textarea>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Citizenship</b></span>
                  <input type="text" class="form-control"  name="citizenship" id="citizenship" placeholder="Citizenship" required>
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
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" maxlength="10" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Email</b></span>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" onkeydown="validation()" onkeyup="validation()" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
              </div>
              
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>School information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>General Weighted Average</b></span>
                  <input type="text" class="form-control" name="GWA" id="GWA" placeholder="General Weighted Average">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Year level</b></span>
                  <select name="year_level_ID" id="year_level_ID" class="form-control" required>
                    <option value="" selected disabled>Select level</option>
                    <?php
                      $level = $db->getLevel();
                      if($level->num_rows > 0) {
                        while($row2 = $level->fetch_assoc()) {
                          echo '<option value="'.$row2['level_ID'].'">'.$row2['level'].'</option>';
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
                  <span class="text-dark"><b>Course</b></span>
                  <select name="course_ID" id="course_ID" class="form-control" required>
                    <option value="" selected disabled>Select course</option>
                    <?php
                      $course = $db->getCourse();
                      if($course->num_rows > 0) {
                        while($row2 = $course->fetch_assoc()) {
                          echo '<option value="'.$row2['course_ID'].'">'.$row2['course_name'].'</option>';
                        }
                      } else {
                        echo '<option value="" selected disabled>No record found</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-12" id="school_fields" style="display: none;">
                  <div class="form-group">
                      <span class="text-dark"><b>Past Name of School</b></span>
                      <input type="text" class="form-control" name="school_name" id="school_name" placeholder="Name of School">
                  </div>
                  <div class="form-group">
                      <span class="text-dark"><b>Past School Address</b></span>
                      <input type="text" class="form-control" name="school_address" id="school_address" placeholder="School Address">
                  </div>
              </div>


              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Contacts in case of emergency</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Full name</b></span>
                  <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" placeholder="Full name" required>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Relationship to student</b></span>
                  <input type="text" class="form-control" name="relationship_to_student" id="relationship_to_student" placeholder="Relationship to student" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="emergency_contact" name="emergency_contact" placeholder = "9123456789" maxlength="10" required>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Parents/Guardian information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Full name</b></span>
                  <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Full name" required>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Relationship to student</b></span>
                  <input type="text" class="form-control" name="parent_relationship" id="parent_relationship" placeholder="Relationship to student" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="parent_contact" name="parent_contact" placeholder = "9123456789" maxlength="10" required>
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
                <a class="h5 text-primary"><b>Documents</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Upload documents (Birth certificate, Card and etc.)</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="documents" name="documents[]" multiple required>
                      <label class="custom-file-label" for="documents">Choose file</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div> -->
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
              </div>
              
            </div>
            <!-- END ROW -->
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="users.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php } else { 
    $stud_ID = $page;
    $students = $db->getStudents($stud_ID);
    $row2 = $students->fetch_assoc();
  ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="UpdateStudentForm" method="POST" enctype="multipart/form-data">
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

            <input type="hidden" class="form-control" name="stud_ID" id="stud_ID" value="<?= $stud_ID ?>" required>

            <div class="row">
              <div class="col-12">
                <div class="row">                   
                  <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Type of Student</b></span>
                      <select class="form-control" name="stud_type" id="stud_type" required onchange="toggleSchoolFields()">
                          <option selected disabled value="">Select type</option>
                          <option value="Old Student" <?php if($row2['stud_type'] == 'Old Student') { echo 'selected'; } ?>>Old Student</option>
                          <option value="New Student" <?php if($row2['stud_type'] == 'New Student') { echo 'selected'; } ?>>New Student</option>
                          <option value="Returnee Student" <?php if($row2['stud_type'] == 'Returnee Student') { echo 'selected'; } ?>>Returnee Student</option>
                          <option value="Transferee Student" <?php if($row2['stud_type'] == 'Transferee Student') { echo 'selected'; } ?>>Transferee Student</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Student ID #</b></span>
                      <input type="text" class="form-control" name="student_ID" id="student_ID" placeholder="Enter Student ID here" value="<?= $row2['student_ID'] ?>" required>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <span class="text-dark text-bold">Academic year</span>
                        <select name="year_ID" id="year_ID" class="form-control" required>
                            <option value="" disabled>Select academic year</option>
                            <?php
                            $acad = $db->getActiveAcadYear();
                            if($acad->num_rows > 0) {
                                while($row3 = $acad->fetch_assoc()) {
                                    $selected = ($row3['year_ID'] == $row2['year_ID']) ? 'selected' : '';
                                    echo '<option value="'.$row3['year_ID'].'" '.$selected.'>'.$row3['year_from'].'-'.$row3['year_to'].'</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No record found</option>';
                            }
                            ?>
                        </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 mt-1 mb-2">
                <a class="h5 text-primary"><b>Basic information</b></a>
                <div class="dropdown-divider"></div>
              </div>
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
                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" onkeyup="lettersOnly(this)" value="<?= $row2['lastname'] ?>" required>
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Ext/Suffix</b></span>
                  <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Ext/Suffix" value="<?= $row2['suffix'] ?>">
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
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Date of Birth</b></span>
                  <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>" value="<?= $row2['birthdate'] ?>" required>
                </div>
              </div>
              <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Complete Address</b></span>
                  <textarea class="form-control" name="address" id="address" placeholder="Complete Address" cols="30" rows="1" required><?= $row2['address'] ?></textarea>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Citizenship</b></span>
                  <input type="text" class="form-control"  name="citizenship" id="citizenship" placeholder="Citizenship" value="<?= $row2['citizenship'] ?>" required>
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
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" maxlength="10" value="<?= $row2['contact'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Email</b></span>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" onkeydown="validation()" onkeyup="validation()" value="<?= $row2['email'] ?>" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
              </div>
              
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>School information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>General Weighted Average</b></span>
                  <input type="text" class="form-control" name="GWA" id="GWA" placeholder="General Weighted Average" value="<?= $row2['GWA'] ?>">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Year level</b></span>
                  <select name="year_level_ID" id="year_level_ID" class="form-control" value="<?= $row2['year_level_ID'] ?>" required>
                    <option value="" selected disabled>Select level</option>
                    <?php
                      $level = $db->getLevel();
                      if($level->num_rows > 0) {
                        while($row4 = $level->fetch_assoc()) {
                          $selected = ($row4['level_ID'] == $row2['level_ID']) ? 'selected' : '';
                          echo '<option value="'.$row4['level_ID'].'" '.$selected.'>'.$row4['level'].'</option>';
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
                  <span class="text-dark"><b>Course</b></span>
                  <select name="course_ID" id="course_ID" class="form-control" required>
                    <option value="" selected disabled>Select course</option>
                    <?php
                      $course = $db->getCourse();
                      if($course->num_rows > 0) {
                        while($row5 = $course->fetch_assoc()) {
                          $selected = ($row5['course_ID'] == $row2['course_ID']) ? 'selected' : '';
                          echo '<option value="'.$row5['course_ID'].'" '.$selected.'>'.$row5['course_name'].'</option>';
                        }
                      } else {
                        echo '<option value="" selected disabled>No record found</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-12" id="school_fields" style="display: none;">
                  <div class="form-group">
                      <span class="text-dark"><b>Past Name of School</b></span>
                      <input type="text" class="form-control" name="school_name" id="school_name" placeholder="Name of School" value="<?= $row2['school_name'] ?>">
                  </div>
                  <div class="form-group">
                      <span class="text-dark"><b>Past School Address</b></span>
                      <input type="text" class="form-control" name="school_address" id="school_address" placeholder="School Address" value="<?= $row2['school_address'] ?>">
                  </div>
              </div>


              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Contacts in case of emergency</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Full name</b></span>
                  <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" placeholder="Full name" value="<?= $row2['emergency_contact_name'] ?>" required>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Relationship to student</b></span>
                  <input type="text" class="form-control" name="relationship_to_student" id="relationship_to_student" placeholder="Relationship to student" value="<?= $row2['relationship_to_student'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="emergency_contact" name="emergency_contact" placeholder = "9123456789" maxlength="10" value="<?= $row2['emergency_contact'] ?>" required>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                <a class="h5 text-primary"><b>Parents/Guardian information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Full name</b></span>
                  <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Full name" value="<?= $row2['parent_name'] ?>" required>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Relationship to student</b></span>
                  <input type="text" class="form-control" name="parent_relationship" id="parent_relationship" placeholder="Relationship to student" value="<?= $row2['parent_relationship'] ?>" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="parent_contact" name="parent_contact" placeholder = "9123456789" maxlength="10" value="<?= $row2['parent_contact'] ?>" required>
                  </div>
                </div>
              </div>

              
              <div class="col-lg-12 mt-3 mb-2">
                <a class="h5 text-primary"><b>Documents</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm6 col-12">
                <div class="form-group">
                  <span class="text-dark"><b>Upload documents (Birth certificate, Card and etc.)</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="documents" name="documents[]" multiple>
                      <label class="custom-file-label" for="documents">Choose file</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div> -->
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
              </div>
              
            </div>
            <!-- END ROW -->
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="users.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
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
    function toggleSchoolFields() {
        var studType = document.getElementById("stud_type").value;
        var schoolFields = document.getElementById("school_fields");
        var schoolNameInput = document.getElementById("school_name");
        var schoolAddressInput = document.getElementById("school_address");

        if (studType == "New Student" || studType == "Transferee Student") {
            schoolFields.style.display = "block";
            schoolNameInput.setAttribute("required", "");
            schoolAddressInput.setAttribute("required", "");
        } else {
            schoolFields.style.display = "none";
            schoolNameInput.removeAttribute("required");
            schoolAddressInput.removeAttribute("required");
        }
    }

  $(document).ready(function() {
      


    // Add event listener to form submission
    $('#AddStudentForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'AddStudentForm');

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
                        window.location.href = "users.php";
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
    $('#UpdateStudentForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'UpdateStudentForm');

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
                        window.location.href = "users.php";
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
