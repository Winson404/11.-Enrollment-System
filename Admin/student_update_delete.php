
<!-- ****************************************************VIEW*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="view<?php echo $row['stud_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-graduation-cap"></i> Student information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-3">
              <div class="form-group">
                <label>Year level</label>
                <input type="text" class="form-control form-control-sm"  value="<?php echo $row['level']; ?>" readonly>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['fname']; ?>" readonly>
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
                <label>Middle name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['mname']; ?>" readonly>
            </div>
          </div>
          <div class="col-lg-3">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['lname']; ?>" readonly>
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label>Suffix name</label>
              <input type="text" class="form-control form-control-sm" value="<?php echo $row['suffix']; ?>" readonly>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label>Gender</label>
              <input type="text" class="form-control form-control-sm" value="<?php echo $row['gender']?>" readonly>
            </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control form-control-sm" value="<?php echo $row['dob']?>" readonly>
              </div>
          </div>
          <div class="col-lg-2">
              <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control form-control-sm" value="<?php echo $row['age']; ?>" readonly>
              </div>
          </div>
          <div class="col-lg-3">
               <div class="form-group">
                  <label>Contact</label>
                  <input type="number" class="form-control form-control-sm" value="<?php echo $row['contact']; ?>" readonly>
               </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control form-control-sm" value="<?php echo $row['email']; ?>" readonly>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="form-group">
                <label>Address</label>
                <input type="email" class="form-control form-control-sm" value="<?php echo $row['address']; ?>" readonly>
              </div>
          </div>
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<?php echo $row['stud_Id']; ?>" data-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
    </div>
  </div>
</div>
<!-- ****************************************************END VIEW*********************************************************************** -->








<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['stud_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-graduation-cap"></i> Update student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" value="<?php echo $row['stud_Id']; ?>" name="stud_Id">
        <div class="row">
          <div class="col-lg-3">
              <div class="form-group">
                <label>Year level</label>
                <input type="text" class="form-control form-control-sm"  value="<?php echo $row['level']; ?>" name="level" required>
              </div>
          </div>
        </div>
        <div class="row">        
          <div class="col-lg-3">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control form-control-sm" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['fname']; ?>">
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
                <label>Middle name</label>
                <input type="text" class="form-control form-control-sm" name="middlename" required onkeyup="lettersOnly(this)" value="<?php echo $row['mname']; ?>">
            </div>
          </div>
          <div class="col-lg-3">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control form-control-sm" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lname']; ?>">
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label>Suffix name</label>
              <input type="text" class="form-control form-control-sm" name="suffix" onkeyup="lettersOnly(this)" value="<?php echo $row['suffix']; ?>">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <?php                           
                  $gender  = mysqli_query($conn, "SELECT DISTINCT gender FROM student");
                  $id = $row['stud_Id'];
                  $all_gender = mysqli_query($conn, "SELECT * FROM student  where stud_Id = '$id' ");
                  $row = mysqli_fetch_array($all_gender);
              ?>
              <label>Gender</label>
              <select class="custom-select custom-select-sm" name="gender" required>
                  <?php foreach($gender as $rows):?>
                        <option value="<?php echo $rows['gender']; ?>"  
                            <?php if($row['gender'] == $rows['gender']) echo 'selected="selected"'; ?> 
                             > <!--/////   CLOSING OPTION TAG  -->
                            <?php echo $rows['gender']; ?>                                           
                        </option>

                 <?php endforeach;?>
               </select> 
              
            </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control form-control-sm" name="dob" required value="<?php echo $row['dob']?>">
              </div>
          </div>
          <div class="col-lg-2">
              <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control form-control-sm" name="age" required value="<?php echo $row['age']; ?>">
              </div>
          </div>
          <div class="col-lg-3">
               <div class="form-group">
                  <label>Contact</label>
                  <input type="number" class="form-control form-control-sm" pattern="[7-9]{1}[0-9]{9}" name="contact" required value="<?php echo $row['contact']; ?>">
               </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control form-control-sm" name="email" required value="<?php echo $row['email']; ?>">
              </div>
          </div>
          <div class="col-lg-8">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control form-control-sm" name="address" required value="<?php echo $row['address']; ?>">
              </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-success" name="update_student"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- ****************************************************END UPDATE*********************************************************************** -->




<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['stud_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-graduation-cap"></i> Delete student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['stud_Id']; ?>" name="stud_Id">
          <h6 class="text-center">Delete student record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_student"><i class="fa-solid fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->