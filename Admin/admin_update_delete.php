




<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['admin_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Update admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          
          <!-- LOAD IMAGE PREVIEW -->
          <div class="col-lg-12 mb-2">
              <div class="form-group" id="admin_preview">
              </div>
          </div>
          <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" value="<?php echo $row['admin_Id']; ?>" name="admin_Id">
          <div class="col-lg-3">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control form-control-sm" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['firstname']; ?>">
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
                <label>Middle name</label>
                <input type="text" class="form-control form-control-sm" name="middlename" required onkeyup="lettersOnly(this)" value="<?php echo $row['middlename']; ?>">
            </div>
          </div>
          <div class="col-lg-3">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control form-control-sm" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lastname']; ?>">
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
                  $gender  = mysqli_query($conn, "SELECT DISTINCT gender FROM admin");
                  $id = $row['admin_Id'];
                  $all_gender = mysqli_query($conn, "SELECT * FROM admin  where admin_Id = '$id' ");
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
          <div class="col-lg-4">
              <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control-file form-control-sm" name="fileToUpload" onchange="newgetImagePreview(event)">
              </div>
          </div>
          
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-success" name="update_admin" id="create"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
   function newgetImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('admin_preview');
    var newimg=document.createElement('img');
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
  }


  function lettersOnly(input) {
      var regex = /[^a-z ]/gi;
      input.value = input.value.replace(regex, "");
    }
    
</script>
<!-- ****************************************************END UPDATE*********************************************************************** -->








<!-- ****************************************************VIEW*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="view<?php echo $row['admin_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Admin information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-lg-12 mb-4 d-flex justify-content-center">
              <img src="../images-admin/<?php echo $row['image']; ?>" alt="" width="200">
          </div>
          <div class="col-lg-3">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['firstname']; ?>" readonly>
              </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
                <label>Middle name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['middlename']; ?>" readonly>
            </div>
          </div>
          <div class="col-lg-3">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $row['lastname']; ?>" readonly>
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<?php echo $row['admin_Id']; ?>" data-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
    </div>
  </div>
</div>
<!-- ****************************************************END VIEW*********************************************************************** -->







<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['admin_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Delete admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['admin_Id']; ?>" name="admin_Id">
          <h6>Delete admin record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_admin"><i class="fa-solid fa-circle-check"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->






<!-- ****************************************************PASSWORD*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="password<?php echo $row['admin_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
           <input type="hidden" class="form-control" value="<?php echo $row['admin_Id']; ?>" name="admin_Id">
            <div class="form-group mb-3">
              <label for=""><b>Old password</b></label>
              <input type="password" class="form-control form-control-sm" placeholder="Old password" name="OldPassword" required>
            </div>
            <div class="form-group mb-3">
              <label for=""><b>New password</b></label>
              <input type="password" class="form-control form-control-sm" placeholder="Password" name="password" required id="new_password">
            </div>
            <div class="form-group mb-3">
              <label for=""><b>Confirm password</b></label>
              <input type="password" class="form-control form-control-sm" placeholder="Confirm password" name="cpassword" required id="new_cpassword" onkeyup="new_validate_password()">
                <small id="new_wrong_pass_alert"></small>
            </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="password_admin" id="new_create"><i class="fa-solid fa-circle-check"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END PASSWORD*********************************************************************** -->


<script>
    function new_validate_password() {

      var pass = document.getElementById('new_password').value;
      var confirm_pass = document.getElementById('new_cpassword').value;
      if (pass != confirm_pass) {
        document.getElementById('new_wrong_pass_alert').style.color = 'red';
        document.getElementById('new_wrong_pass_alert').innerHTML = 'X Password did not matched!';
        document.getElementById('new_create').disabled = true;
        document.getElementById('new_create').style.opacity = (0.4);
      } else {
        document.getElementById('new_wrong_pass_alert').style.color = 'green';
        document.getElementById('new_wrong_pass_alert').innerHTML = '✓ Password matched!';
        document.getElementById('new_create').disabled = false;
        document.getElementById('new_create').style.opacity = (1);
      }
    }

</script>
<!-- ****************************************************END CREATE*********************************************************************** -->