<?php 
    include 'header.php'; 
    include 'login.php';
?>

<!-- ======= Appointment Section ======= -->
    <section id="register" class="appointment section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Patient registration</h2>
          <?php if(isset($_SESSION['success'])) { ?> 
              <h5 class="alert text-success" role="alert"><b><?php echo $_SESSION['success']; ?></b></h5> 
          <?php unset($_SESSION['success']); } ?>


          <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
              <h5 class="alert text-danger" role="alert"><b><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></b></h5>
          <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


          <?php  if(isset($_SESSION['exists'])) { ?>
              <h5 class="alert text-danger" role="alert"><b><?php echo $_SESSION['exists']; ?></b></h5>
          <?php unset($_SESSION['exists']); } ?>
        </div>

        <form action="register_code.php" method="post" class="bg-body pb-4" enctype="multipart/form-data">
          <div class="row bg-body p-3">
            <div class="col-md-4 form-group">
              <input type="text" class="form-control" placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
            </div>
            <div class="col-md-3 form-group">
              <input type="text" class="form-control" placeholder="Middle name" name="middlename" required onkeyup="lettersOnly(this)">
            </div>
            <div class="col-md-3 form-group">
              <input type="text" class="form-control" placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
            </div>
            <div class="col-md-2 form-group">
              <input type="text" class="form-control" placeholder="Suffix" name="suffix">
            </div>
            <div class="col-md-3 form-group mt-3">
              <select name="gender" class="form-select" required>
                <option value="">Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="col-md-3 form-group mt-3">
              <input type="date" class="form-control"  placeholder="Date of birth" name="dob" required>
            </div>
            <div class="col-md-2 form-group mt-3">
              <input type="number" class="form-control" placeholder="Age" name="age" required>
            </div>
          
            <div class="col-md-4 form-group mt-3">
              <input type="number" class="form-control" placeholder="9123456789" name="contact"required>
            </div>
            <div class="col-md-4 form-group mt-3">
              <input type="email" class="form-control" placeholder="mail@email.com" name="email"required>
            </div>
            <div class="col-md-4 form-group mt-3">
              <input type="password" class="form-control" placeholder="Password" name="password" id="newpassword" required>
            </div>
            <div class="col-md-4 form-group mt-3">
              <input type="password" class="form-control" placeholder="Confirm password" name="cpassword" id="confirmpassword" onkeyup="validate_password()" required>
            </div>
            <div class="col-md-12 form-group mt-3">
              <textarea class="form-control" name="address" rows="3" placeholder="Address"></textarea>
            </div>
            <div class="col-md-6 form-group mt-3">
              <input type="file" class="form-control" name="fileToUpload" onchange="getImagePreview(event)" required>
              <p class="mt-3">Already have an account? <a href="" data-bs-toggle="modal" data-bs-target="#memberlogin">Click here!</a></p>
            </div>
            <div class="form-group col-lg-6 mb-4">
                    <div class="form-group" id="preview">
                    </div>
                </div>
            
          </div>

         <!--  <div class="form-group mt-3">
            
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div> -->
          <div class="text-center"><button class="btn btn-primary" type="submit" name="create_user">Register</button></div>
        </form>

      </div>
    </section><!-- End Appointment Section -->


<?php include 'footer.php'; ?>


 
<script>
   function getImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="215px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
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
    imagediv.appendChild(text);
  }

</script>

<script>
    function validate_password() {

      var pass = document.getElementById('newpassword').value;
      var confirm_pass = document.getElementById('confirmpassword').value;
      if (pass != confirm_pass) {
        document.getElementById('wrong_pass_alert').style.color = 'red';
        document.getElementById('wrong_pass_alert').innerHTML = 'X Password did not matched!';
        document.getElementById('register').disabled = true;
        document.getElementById('register').style.opacity = (0.4);
      } else {
        document.getElementById('wrong_pass_alert').style.color = 'green';
        document.getElementById('wrong_pass_alert').innerHTML = '✓ Password matched!';
        document.getElementById('register').disabled = false;
        document.getElementById('register').style.opacity = (1);
      }
    }




    function lettersOnly(input) {
      var regex = /[^a-z ]/gi;
      input.value = input.value.replace(regex, "");
    }

</script>