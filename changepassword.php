<title>Enrollment System | Change Password</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Create new </b>Password</a>
      </div>
      <div class="card-body">
        <?php
          if(isset($_GET['email']) && isset($_GET['type']) && isset($_GET['id'])) {
            $email = $_GET['email'];
            $type  = $_GET['type'];
            $id    = $_GET['id'];

            $fetch_user = $db->getUserByType($email, $type, $id);

            if ($fetch_user->num_rows > 0) {
              $user = $fetch_user->fetch_array();
        ?>
        <p class="login-box-msg">Create a new password that is at least 6 characters long. A strong password is combination of letters, numbers, and punctuation marks.</p>
        <form id="changePasswordForm">
          <input type="hidden" class="form-control mb-3" name="email" id="email" value="<?php echo $user['email']; ?>">
          <input type="hidden" class="form-control mb-3" name="type" id="type" value="<?php echo $type; ?>">
          <input type="hidden" class="form-control mb-3" name="id" id="id" value="<?php echo $id; ?>">
        
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="New password" name="password" id="password" minlength="8">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></p>
          
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm new password" name="cpassword" id="cpassword" onkeyup="validate_confirm_password()" minlength="8">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></p>
          <div class="icheck-primary mt-3">
            <input type="checkbox" id="remember" onclick="showBothPassword()">
            <label for="remember">
              Show password
            </label>
          </div>
          <div class="row">
            <div class="col-12">
              <button class="btn btn-block bg-gradient-primary" type="submit" name="changepassword" id="submit_button">Change password</button>
            </div>
          </div>
        </form>
        <p>
          <a href="login.php">Login</a>
        </p>
        <?php } else { ?>
        <div class="container">
            <div class="row gy-4 d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card rounded-4 mt-5">
                        <div class="card-header p-md-3 p-xl-3">
                            <h3>User Not Found</h3>
                        </div>
                        <div class="card-body">
                            <p>The user you are looking for cannot be found.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a type="button" href="forgotPassword.php" class="btn btn-secondary">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } } else { require_once '404.php'; } ?>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>


<script>
  $(document).ready(function() {


    $('#changePasswordForm').submit(function(e) {
      e.preventDefault();
      
      var email = $('#email').val();
      var type  = $('#type').val();
      var id    = $('#id').val();
      var password  = $('#password').val();
      var cpassword  = $('#cpassword').val();

      
      $.ajax({
        type: 'POST',
        url: 'includes/processes.php',
        data: {
          action: 'changePassword',
          email: email,
          type: type,
          id: id,
          password: password,
          cpassword: cpassword
        },
        success: function(response) {
          if (response.success) {
            // Show success message
            Swal.fire({
              title: "Success",
              text: "Password has been successfully changed. Please login.",
              icon: "success",
              timer: 3000,
              timerProgressBar: true,
              showConfirmButton: true
            }).then(function() {
              // Redirect to the specified page
              window.location.href = response.redirect;
            });
          } else {
            Swal.fire({
                title: "Error",
                text: response.message,
                icon: "error",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: true
            })
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>
