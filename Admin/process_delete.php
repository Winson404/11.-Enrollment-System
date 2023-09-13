<?php 
	session_start();
	include '../config.php';

	// DELETE STUDENT
	if(isset($_POST['delete_student'])) {
		$stud_Id = $_POST['stud_Id'];

		$delete = mysqli_query($conn, "DELETE FROM student WHERE stud_Id='$stud_Id'");
		if($delete) {
			$_SESSION['success']  = "Student information has been deleted!";
	        header("Location: student.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: student.php");
		}
	}



	// DELETE TEACHER
	if(isset($_POST['delete_teacher'])) {
		$teacher_Id = $_POST['teacher_Id'];

		$delete = mysqli_query($conn, "DELETE FROM teacher WHERE teacher_Id='$teacher_Id'");
		if($delete) {
			$_SESSION['success']  = "Teacher information has been deleted!";
	        header("Location: teacher.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: teacher.php");
		}
	}




	// DELETE SUBJECT
	if(isset($_POST['delete_subject'])) {
		$sub_Id = $_POST['sub_Id'];

		$delete = mysqli_query($conn, "DELETE FROM subject WHERE sub_Id='$sub_Id'");
		if($delete) {
			$_SESSION['success']  = "Subject information has been deleted!";
	        header("Location: subject.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: subject.php");
		}
	}




	// DELETE ANNOUNCEMENT
	if(isset($_POST['delete_announcement'])) {
		$announce_Id = $_POST['announce_Id'];

		$delete = mysqli_query($conn, "DELETE FROM announcement WHERE announce_Id='$announce_Id'");
		if($delete) {
			$_SESSION['success']  = "Announcement information has been deleted!";
	        header("Location: announcement.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: announcement.php");
		}
	}





	// DELETE ADMIN
	if(isset($_POST['delete_admin'])) {
		$admin_Id = $_POST['admin_Id'];

		$delete = mysqli_query($conn, "DELETE FROM admin WHERE admin_Id='$admin_Id'");
		if($delete) {
			$_SESSION['success']  = "Admin information has been deleted!";
	        header("Location: admin.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: admin.php");
		}
	}



?>