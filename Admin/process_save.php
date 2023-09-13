<?php 
	session_start();
	include '../config.php';

	// SAVE STUDENT
	if(isset($_POST['create_student'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$address         = $_POST['address'];
		$email           = $_POST['email'];
		$contact         = $_POST['contact'];
		$level					 = $_POST['level'];
		$password        = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');


		$check_email = mysqli_query($conn, "SELECT * FROM student WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
				$_SESSION['exists']  = "Email is already taken.";
        header("Location: student.php");
		} else {

				$save = mysqli_query($conn, "INSERT INTO student (fname, mname, lname, suffix, gender, dob, age, address, email, contact, level, password, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$level', '$password', '$date_registered')");
        if($save) {
          $_SESSION['success']  = "Student information has been saved!";
          header("Location: student.php");                                
        } else {
          $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
          header("Location: student.php");
        }

		}

	}





	// SAVE TEACHER
	if(isset($_POST['create_teacher'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$address         = $_POST['address'];
		$email           = $_POST['email'];
		$contact         = $_POST['contact'];
		$date_registered = date('Y-m-d');


		$check_email = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
				$_SESSION['exists']  = "Email is already taken.";
        header("Location: teacher.php");
		} else {

				$save = mysqli_query($conn, "INSERT INTO teacher (fname, mname, lname, suffix, gender, dob, age, address, email, contact, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$date_registered')");
        if($save) {
          $_SESSION['success']  = "Teacher information has been saved!";
          header("Location: teacher.php");                                
        } else {
          $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
          header("Location: teacher.php");
        }

		}

	}






	// SAVE TEACHER
	if(isset($_POST['create_subject'])) {

		$code        = $_POST['code'];
		$subjectname = $_POST['subjectname'];
		$instructor  = $_POST['instructor'];
		$date_added  = date('Y-m-d');


		$check_subject = mysqli_query($conn, "SELECT * FROM subject WHERE sub_name='$subjectname'");
		if(mysqli_num_rows($check_subject)>0) {
				$_SESSION['exists']  = "Subject already exists.";
        header("Location: subject.php");
		} else {

				$save = mysqli_query($conn, "INSERT INTO subject (sub_teacher_Id, sub_name, sub_code, date_added) VALUES ('$instructor', '$subjectname', '$code', '$date_added')");
        if($save) {
          $_SESSION['success']  = "Subject information has been saved!";
          header("Location: subject.php");                                
        } else {
          $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
          header("Location: subject.php");
        }

		}

	}






	// SAVE TEACHER
	if(isset($_POST['create_announcement'])) {

		$title   = $_POST['title'];
		$content = $_POST['content'];
		$date_added  = date('Y-m-d');

		$check_title = mysqli_query($conn, "SELECT * FROM announcement WHERE title='$title'");
		if(mysqli_num_rows($check_title)>0) {
				$_SESSION['exists']  = "Announcement already exists.";
        header("Location: announcement.php");
		} else {

				$save = mysqli_query($conn, "INSERT INTO announcement (title, content, date_added) VALUES ('$title', '$content', '$date_added')");
        if($save) {
          $_SESSION['success']  = "Announcement information has been saved!";
          header("Location: announcement.php");                                
        } else {
          $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
          header("Location: announcement.php");
        }

		}

	}





	// SAVE ADMIN
	if(isset($_POST['create_admin'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$contact         = $_POST['contact'];
		$email           = $_POST['email'];
		$address         = $_POST['address'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);


		$check_email = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
			$_SESSION['exists']  = "Email is already taken.";
            header("Location: admin.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['exists']  = "Password does not matched.";
            	header("Location: admin.php");
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
                     	
                      	$save = mysqli_query($conn, "INSERT INTO admin (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                            if($save) {
	                            $_SESSION['success']  = "Admin information has been successfully saved!";
	                            header("Location: admin.php");                                
                            } else {
                              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                              header("Location: admin.php");
                            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: admin.php");
                      }
				 }

			}

		}

	}








?>