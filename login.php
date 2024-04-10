<title>Enrollment System | Login</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary ">
      <div class="card-header text-center">
        <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->
        <a href="login.php" class="h1">
          <img src="images/logo.jpg" alt="logo" class="img-fluid shadow-sm img-circle" width="130" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form id="loginForm">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <!-- FOR INVALID EMAIL -->
          <div class="input-group mb-3">
            <small id="text" style="font-style: italic;"></small>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password" minlength="8" required style="text-transform: none;">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" onclick="showPassword()">
                <label for="remember">
                  Show password
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block"  id="submit_button">Sign In</button>
            </div>
          </div>
        </form>
        <!-- <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
        <p class="mb-1">
          <a href="forgot-password.php">Forgot password?</a>
        </p>
        <p class="mb-0">
          No account? <a href="register.php" class="text-center">Register here!</a>
        </p>
      </div>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; ?>


<script>
  document.addEventListener('DOMContentLoaded', function() {
   // LOGIN REQUEST
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/processes.php',
            data: {
                action: 'login',
                email: $('#email').val(),
                password: $('#password').val()
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Login successful",
                        // text: "Login successful",
                        icon: "success",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    }).then((result) => {
                        // Redirect to the dashboard regardless of the user's action
                        window.location.href = response.redirect;
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        timer: 1500,
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