<title>Enrollment System | Code verification</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Enter security </b>code</a>
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
        <p class="login-box-msg">Please check your email for a message with your code. Your code is 6 numbers long.</p>
        <form id="verifyCodeForm">
          <input type="hidden" class="form-control mb-3" name="email" id="email" value="<?php echo $user['email']; ?>">
          <input type="hidden" class="form-control mb-3" name="type" id="type" value="<?php echo $type; ?>">
          <input type="hidden" class="form-control mb-3" name="id" id="id" value="<?php echo $id; ?>">
          <div class="input-group mb-3">
            <input type="number" class="form-control" placeholder="Enter verification code" name="code" id="code" minlength="6" maxlength="6" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group">
            <p>We sent your code to: <b><?php echo $email; ?></b></p>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn bg-gradient-primary btn-block"  name="verify_code">Continue</button>
              <a href="sendcode.php?email=<?= $email ?>&&type=<?= $type ?>&&id=<?= $id ?>">Didn't get a code?</a>
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
    $('#verifyCodeForm').submit(function(e) {
      e.preventDefault();
      
      var email = $('#email').val();
      var type  = $('#type').val();
      var id    = $('#id').val();
      var code  = $('#code').val();
      
      $.ajax({
        type: 'POST',
        url: 'includes/processes.php',
        data: {
          action: 'verifyCode',
          email: email,
          type: type,
          id: id,
          code: code
        },
        success: function(response) {
          if (response.success) {
            window.location.href = response.redirect;
          } else {
            Swal.fire({
                title: "Error",
                text: response.message,
                icon: "error",
                timer: 2000,
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
