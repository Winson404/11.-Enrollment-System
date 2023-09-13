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
		$address    = $_POST['address'];
		$email      = $_POST['email'];
		$contact    = $_POST['contact'];
		$level      = $_POST['level'];
		
			$save = mysqli_query($conn, "UPDATE student SET fname='$firstname', mname='$middlename', lname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', level='$level' WHERE stud_Id='$stud_Id'");
	    if($save) {
	          $_SESSION['success']  = "Student information has been updated!";
	          header("Location: student.php");                                
	    } else {
	          $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
	          header("Location: student.php");
	    }
		
	}






	// UPDATE TEACHER
	if(isset($_POST['update_teacher'])) {

		$teacher_Id = $_POST['teacher_Id'];
		$firstname  = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname   = $_POST['lastname'];
		$suffix     = $_POST['suffix'];
		$gender     = $_POST['gender'];
		$dob        = $_POST['dob'];
		$age        = $_POST['age'];
		$address    = $_POST['address'];
		$email      = $_POST['email'];
		$contact    = $_POST['contact'];
		
			$save = mysqli_query($conn, "UPDATE teacher SET fname='$firstname', mname='$middlename', lname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE teacher_Id='$teacher_Id'");
	    if($save) {
	          $_SESSION['success']  = "Teacher information has been updated!";
	          header("Location: teacher.php");                                
	    } else {
	          $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
	          header("Location: teacher.php");
	    }
		
	}





	// UPDATE SUBJECT
	if(isset($_POST['update_subject'])) {

		$sub_Id      = $_POST['sub_Id'];
		$code        = $_POST['code'];
		$subjectname = $_POST['subjectname'];
		$instructor  = $_POST['instructor'];
		
			$save = mysqli_query($conn, "UPDATE subject SET sub_teacher_Id='$instructor', sub_name='$subjectname', sub_code='$code' WHERE sub_Id='$sub_Id'");
	    if($save) {
	          $_SESSION['success']  = "Subject information has been updated!";
	          header("Location: subject.php");                                
	    } else {
	          $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
	          header("Location: subject.php");
	    }
	}






	// UPDATE ANNOUNCEMENT
	if(isset($_POST['update_announcement'])) {

		$announce_Id = $_POST['announce_Id'];
		$title       = $_POST['title'];
		$content     = $_POST['content'];
		
			$save = mysqli_query($conn, "UPDATE announcement SET title='$title', content='$content' WHERE announce_Id='$announce_Id'");
	    if($save) {
	          $_SESSION['success']  = "Announcement information has been updated!";
	          header("Location: announcement.php");                                
	    } else {
	          $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
	          header("Location: announcement.php");
	    }
		
	}







    // UPDATE ADMIN
	if(isset($_POST['update_admin'])) {

		$admin_Id    = $_POST['admin_Id'];
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
		$file       = basename($_FILES["fileToUpload"]["name"]);

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE admin SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE admin_Id='$admin_Id'");
		            if($save) {
			                $_SESSION['success']  = "Admin information has been updated!";
			                header("Location: admin.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
			                header("Location: admin.php");
		            }

		} else {

				  // Check if image file is a actual image or fake image
		          $target_dir = "../images-admin/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  header("Location: admin.php");
                  $uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                  $_SESSION['error']  = "Your file was not uploaded.";
                  header("Location: admin.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	                      	$save = mysqli_query($conn, "UPDATE admin SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', image='$file' WHERE admin_Id='$admin_Id'");
				            if($save) {
					                $_SESSION['success']  = "Admin information has been updated!";
					                header("Location: admin.php");                                
				            } else {
					                $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
					                header("Location: admin.php");
				            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: admin.php");
                      }

				 }

		}
	}




	// CHANGE ADMIN PASSWORD
	if(isset($_POST['password_admin'])) {

    	$admin_Id    = $_POST['admin_Id'];	
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM admin WHERE password='$OldPassword' AND admin_Id='$admin_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: admin.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE admin SET password='$password' WHERE admin_Id='$admin_Id' ");

			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          					header("Location: admin.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          				header("Location: admin.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: admin.php");
    	}

    }










?>