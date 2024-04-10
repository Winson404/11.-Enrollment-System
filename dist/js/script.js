// SHOW NEW AND CONFIRM PASSWORD
 function showBothPassword() {
  var x = document.getElementById("password");
  var y = document.getElementById("cpassword");
  if (x.type === "password" || y.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}


 // HIDE/SHOW PASSWORD
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


// PASSWORD MATCHING
function validate_confirm_password() {
  var pass = document.getElementById('password').value;
  var confirm_pass = document.getElementById('cpassword').value;
  if (pass != confirm_pass) {
    document.getElementById('wrong_pass_alert').style.color = '#e60000';
    document.getElementById('wrong_pass_alert').innerHTML = 'X Password did not matched!';
    document.getElementById('submit_button').disabled = true;
    document.getElementById('submit_button').style.opacity = (0.4);
  } else {
    document.getElementById('wrong_pass_alert').style.color = 'green';
    document.getElementById('wrong_pass_alert').innerHTML = '✓ Password matched!';
    document.getElementById('submit_button').disabled = false;
    document.getElementById('submit_button').style.opacity = (1);
  }
}


// SHOW/HIDE PASSWORD - REGISTRATION/SAVING/UPDATING RECORDS
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var eyeToggle = document.getElementById("eye-toggle-" + inputId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeToggle.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    } else {
        passwordInput.type = "password";
        eyeToggle.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
    }
}



// IMAGE PREVIEW
function getImagePreview(event) {
  const fileInput = event.target;
  const previewImage = document.getElementById('imagePreview');
  const file = fileInput.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      previewImage.src = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    // If no file is selected, revert to the placeholder image
    previewImage.src = "../images/image-holder.png";
  }
}


// LETTER ONLY
function lettersOnly(input) {
  var regex = /[^a-z ]/gi;
  input.value = input.value.replace(regex, "");
}



// EMAIL VALIDATION
function validation() {
  var email = document.getElementById("email").value;
  var pattern =/.+@(gmail)\.com$/;
  // var pattern =/.+@(gmail|yahoo)\.com$/;
  var form = document.getElementById("form");

  if(email.match(pattern)) {
      document.getElementById('text').style.color = 'green';
      document.getElementById('text').innerHTML = '';
      document.getElementById('submit_button').disabled = false;
      document.getElementById('submit_button').style.opacity = (1);
  } 
  else {
      document.getElementById('text').style.color = 'red';
      document.getElementById('text').innerHTML = 'Domain must be @gmail.com';
      document.getElementById('submit_button').disabled = true;
      document.getElementById('submit_button').style.opacity = (0.4);
      
  }
}



// AUTO CALCULATE AGE
function calculateAge() {
  var birthdate = new Date(document.getElementById("birthdate").value);
  var now = new Date();

  var ageInMilliseconds = now.getTime() - birthdate.getTime();
  var ageInSeconds = ageInMilliseconds / 1000;
  var ageInMinutes = ageInSeconds / 60;
  var ageInHours = ageInMinutes / 60;
  var ageInDays = ageInHours / 24;
  var ageInWeeks = ageInDays / 7;
  var ageInMonths = ageInDays / 30.44;
  var ageInYears = ageInDays / 365;

  var age = Math.floor(ageInYears);

  // Check if the person is at least 15 years old
  if (age >= 15) {
    if (ageInDays >= 365) {
      var ageDescription = age + " year" + (age > 1 ? "s" : "") + " old";
    } else if (ageInDays >= 30) {
      var ageDescription = Math.floor(ageInMonths) + " month" + (Math.floor(ageInMonths) > 1 ? "s" : "") + " old";
    } else if (ageInDays >= 7) {
      var ageDescription = Math.floor(ageInWeeks) + " week" + (Math.floor(ageInWeeks) > 1 ? "s" : "") + " old";
    } else {
      var ageDescription = Math.floor(ageInDays) + " day" + (Math.floor(ageInDays) > 1 ? "s" : "") + " old";
    }

    document.getElementById("txtage").value = ageDescription;
  } else {
    // If the person is under 15, display an error message or take appropriate action
    alert("Age must be 15 years or older.");
    // You might also consider preventing form submission or displaying an alert.
  }
}





/*MAKE PASSWORD MORE SECURED / VALIDATE PASSWORD*/
const passwordField = document.getElementById('password');
const passwordMessage = document.getElementById('password-message');
passwordField.addEventListener('input', () => {
  const password = passwordField.value;
  let errors = [];

  // Check password length
  if (password.length < 8) {
    errors.push('Password must be at least 8 characters long.');
  }

  // Check if password contains a special character
  if (!/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password)) {
    errors.push('Password must contain at least one special character.');
  }

  // Display error messages if any
  if (errors.length > 0) {
    passwordMessage.innerText = errors.join(' ');
    passwordMessage.classList.add('error');
  } else {
    passwordMessage.innerText = '';
    passwordMessage.classList.remove('error');
  }
});




