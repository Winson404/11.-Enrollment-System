<title>Enrollment System | Forgot password</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Find your </b>ACCOUNT</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Please enter your email to search for your account.</p>
        <form id="forgotPasswordForm">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="email@gmail.com" name="email"  id="email" onkeydown="validation()" onkeyup="validation()" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <!-- FOR INVALID EMAIL -->
          <div class="input-group mt-1 mb-3">
            <small id="text" style="font-style: italic;"></small>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn bg-gradient-primary btn-block"  name="search" id="submit_button">Search</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>

<script>
  $(document).ready(function() {
    $('#forgotPasswordForm').submit(function(e) {
      e.preventDefault();
      
      var email = $('#email').val();

      $.ajax({
        type: 'POST',
        url: 'includes/processes.php',
        data: {
          action: 'checkEmail',
          email: email
        },
        success: function(response) {
    console.log(response); // Log the response object to check its structure
    if (response.exists) {
        var type = response.type;
        var id = response.id;
        window.location.href = 'sendcode.php?email=' + encodeURIComponent(email) + '&type=' + type + '&id=' + id;
    } else {
        Swal.fire({
            title: "Error",
            text: "Email or Contact number does not exist",
            icon: "error",
            timer: 3000,
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

