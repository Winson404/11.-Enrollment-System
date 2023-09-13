<title>Account security | TRHS</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Change password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center d-flex">
          <!-- left column -->
          <div class="col-lg-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Information</h3>
              </div>
                <?php if(isset($_SESSION['success'])) { ?> 
                    <p class="alert alert-success position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['success']; ?></p> 
                <?php unset($_SESSION['success']); } ?>

                <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                <?php  if(isset($_SESSION['exists'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['exists']; ?></p>
                <?php unset($_SESSION['exists']); } ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="process_update.php" method="POST" enctype="multipart/form-data">
                 <input type="hidden" class="form-control" value="<?php echo $row['stud_Id']; ?>" name="stud_Id">
                 <div class="card-body">
                    <div class="row d-flex justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>Old password</b></label>
                              <input type="password" class="form-control form-control-sm" placeholder="Old password" name="OldPassword" required>
                          </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>New password</b></label>
                              <input type="password" class="form-control form-control-sm" placeholder="Password" name="password" required id="new_password">
                          </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>Confirm password</b></label>
                              <input type="password" class="form-control form-control-sm" placeholder="Confirm password" name="cpassword" required id="new_cpassword" onkeyup="new_validate_password()">
                              <small id="new_wrong_pass_alert"></small>
                          </div>
                      </div>
                    </div>
                    <div class="row  d-flex justify-content-center">
                      <div class="col-lg-10 d-flex justify-content-center">
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary" name="password_student" id="new_create"><i class="fa-solid fa-floppy-disk"></i> Change password</button>
                        </div>
                      </div>
                    </div>  
               </div>
                <!-- /.card-body -->
                
              </form>
            </div>
            <!-- /.card -->
         </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

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

  <?php include 'footer.php'; ?>
 
</body>
</html>
