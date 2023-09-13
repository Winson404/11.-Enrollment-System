<?php 
	session_start();
	include '../config.php';

	// UPDATE PATIENT
	if(isset($_POST['update_student'])) {

		$stud_Id    = $_POST['stud_Id'];
		$firstname  = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname   = $_POST['lastname'];
		$suffix     = $_POST['suffix'];
		$gender     = $_POST['gender'];
		$dob        = $_POST['dob'];
		$age        = $_POST['age'];
		$contact    = $_POST['contact'];
		$email      = $_POST['email'];
		$address    = $_POST['address'];

			$save = mysqli_query($conn, "UPDATE student SET fname='$firstname', mname='$middlename', lname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE stud_Id='$stud_Id'");
      if($save) {
            $_SESSION['success']  = "Your information has been updated!";
            header("Location: about_me_update.php");                                
      } else {
            $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
            header("Location: about_me_update.php");
      }
	}




	// CHANGE PATIENT PASSWORD
	if(isset($_POST['password_student'])) {

    	$stud_Id     = $_POST['stud_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM student WHERE password='$OldPassword' AND stud_Id='$stud_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
    				
		    		$update_password = mysqli_query($conn, "UPDATE student SET password='$password' WHERE stud_Id='$stud_Id' ");
	    			if($update_password) {
	    					$_SESSION['success']  = "Password has been changed.";
          			header("Location: changepassword.php");
	    			} else {
	    					$_SESSION['exists']  = "Something went wrong while changing the password.";
	          		header("Location: changepassword.php");
	    			}
    	} else {
    			$_SESSION['exists']  = "Old password is incorrect.";
          header("Location: changepassword.php");
    	}

    }




?>