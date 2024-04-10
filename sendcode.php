<title>Enrollment System | Send verification code</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Send code to </b>email</a>
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
        <p class="login-box-msg">A verification code will be sent to your email to reset your password.</p>
        <form id="sendCodeForm">
          <input type="hidden" class="form-control mb-3" name="email" id="email" value="<?php echo $user['email']; ?>">
          <input type="hidden" class="form-control mb-3" name="type" id="type" value="<?php echo $type; ?>">
          <input type="hidden" class="form-control mb-3" name="id" id="id" value="<?php echo $id; ?>">
          <div class="row">
            <div class="col-md-12">
              <div class="input-group mb-3">
                <img src="images-users/<?php echo $user['image']; ?>" alt="" style="width: 60px;height: 60px; border-radius: 50%; display: block;margin-left: auto;margin-right: auto;margin-bottom: -12px;">
              </div>
              <p class="text-center mb-4"><?php echo ' '.$user['firstname'].' '.$user['middlename'].' '.$user['lastname'].' '.$user['suffix'].' '; ?></p>
            </div>
            
            <div class="col-md-12">
              <div class="input-group">
                <p>We can send a login code to:</p>
              </div>
            </div>
            <div class="col-md-12" style="margin-top: -18px;">
              <div class="input-group">
                <p><b><?php echo $user['email']; ?></b></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn bg-gradient-primary btn-block"  name="sendcode">Continue</button>
              <p class="mt-1"><a href="forgot-password.php" class="text-center">Not you?</a></p>
            </div>
          </div>
        </form>
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
    $('#sendCodeForm').submit(function(e) {
      e.preventDefault();
      
      var email = $('#email').val();
      var type = $('#type').val();
      var id = $('#id').val();
      // Show loading message
      Swal.fire({
        title: "Please wait",
        text: "An email message will be sent to your email shortly.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false
      });
      
      $.ajax({
        type: 'POST',
        url: 'includes/processes.php',
        data: {
          action: 'sendCode',
          email: email,
          type: type,
          id: id
        },
        success: function(response) {
          if (response.success) {
            // Show success message
            Swal.fire({
              title: "Success",
              text: "A message with verification code has been sent to your email",
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
