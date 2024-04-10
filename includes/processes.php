<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    require_once 'db_config.php';
    require_once 'classes.php';
    $db = new db_class();
    
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require '../vendor/phpmailer/src/Exception.php';
    // require '../vendor/phpmailer/src/PHPMailer.php';
    // require '../vendor/phpmailer/src/SMTP.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            // HANDLE CHECK EXISTING ID NUMBER ACTION - REGISTRATION.PHP/PROFILE.PHP
            if ($action === "checkExistingID_number") {
                $user_ID = isset($_POST['user_ID']) ? $_POST['user_ID'] : '';
                $ID_number = $_POST['ID_number'];

                $db = new db_class();

                $result = $db->checkExistingID_number($ID_number, $user_ID);
                header('Content-Type: application/json');
                echo json_encode($result);
            }


            // HANDLE CHECK EXISTING CONTACT ACTION - REGISTRATION.PHP/PROFILE.PHP
            if ($action === "checkExistingContact") {
                $user_ID = isset($_POST['user_ID']) ? $_POST['user_ID'] : '';
                $contact = $_POST['contact'];

                $db = new db_class();

                $result = $db->checkExistingContact($contact, $user_ID);
                header('Content-Type: application/json');
                echo json_encode($result);
            }


            // HANDLE CHECK EXISTING EMAIL ACTION - REGISTRATION.PHP/PROFILE.PHP
            if ($action === "checkExistingEmail") {
                $user_ID = isset($_POST['user_ID']) ? $_POST['user_ID'] : '';
                $email = $_POST['email'];

                $db = new db_class();

                $result = $db->checkExistingEmail($email, $user_ID);
                header('Content-Type: application/json');
                echo json_encode($result);
            }


            // HANDLE CHECK EXISTING EMAIL ACTION FOR FORGOT PASSWORD - FORGOTPASSWORD.PHP
            if ($_POST['action'] === "checkEmail") {
                $email = $_POST['email'];

                $db = new db_class();

                $result = $db->checkEmail($email);

                if ($result['exists']) {
                    // If the record exists, include type and id in the response
                    header('Content-Type: application/json');
                    echo json_encode([
                        'exists' => true,
                        'type' => $result['type'], // Assuming the 'type' key exists in the $result array
                        'id' => $result['id'] // Assuming the 'id' key exists in the $result array
                    ]);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['exists' => false]);
                }
            }



            // HANDLE CHECK EXISTING ID NUMBER ACTION - SENDCODE.PHP
            if ($action === "sendCode") {
                $email = $_POST['email'];
                $type = $_POST['type'];
                $id = $_POST['id'];

                $db = new db_class();

                $result = $db->sendCode($email, $type, $id);
                if ($result) {
                    // Email sent successfully
                    $response['success'] = true;
                    $response['message'] = "A verification code has been sent to your email";
                    $response['redirect'] = "verifyCode.php?email=".$email."&&type=".$type."&&id=".$id." "; // Set the redirection page here
                } else {
                    // Email sending failed
                    $response['success'] = false;
                    $response['message'] = "Failed to send verification code";
                }

                header('Content-Type: application/json');
                echo json_encode($response);
            }


            // HANDLE VERIFICATION CODE ACTION - VERIFYCODE.PHP
            if ($action === "verifyCode") {
                $email = $_POST['email'];
                $type  = $_POST['type'];
                $id = $_POST['id'];
                $code  = $_POST['code'];

                $db = new db_class();

                $result = $db->verifyCode($email, $type, $id, $code);
                if ($result) {
                    $response['success'] = true;
                    $response['message'] = "Code is valid";
                    $response['redirect'] = "changepassword.php?email=".$email."&&type=".$type."&&id=".$id." "; // Set the redirection page here
                } else {
                    $response['success'] = false;
                    $response['message'] = "Invalid code";
                }

                header('Content-Type: application/json');
                echo json_encode($response);
            }



            // HANDLE CHANGE PASSWORD ACTION - CHANGEPASSWORD.PHP
            if ($action === "changePassword") {
                $email     = $_POST['email'];
                $type      = $_POST['type'];
                $id        = $_POST['id'];
                $password  = $_POST['password'];
                $cpassword = $_POST['cpassword'];

                $db = new db_class();

                $result = $db->changePassword($email, $type, $id, $password, $cpassword);
                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result) {
                    $response['success'] = true;
                    $response['message'] = "Password has been changed";
                    $response['redirect'] = "login.php";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error updating new password";
                }

                header('Content-Type: application/json');
                echo json_encode($response);
            }



            // HANDLE LOGIN ACTION - LOGIN.PHP
            if ($action === "login") {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Create instance of db_class
                $db = new db_class();

                // Call login methods
                $result = $db->login($email, $password);

                // Check login result
                if ($result['user_ID'] != 0) {
                    // Login successful
                    $_SESSION['id'] = $result['user_ID'];
                    $_SESSION['user_type'] = $result['user_type']; 
                    // Determine redirect based on user type
                    switch ($result['user_type']) {
                        case 'user':
                            $redirect = "Admin/dashboard.php";
                            break;
                        case 'student':
                            $redirect = "Student/enrollment.php";
                            break;
                        case 'instructor':
                            $redirect = "Instructor/subjects.php";
                            break;
                        default:
                            $redirect = "login.php"; 
                    }
                    // Prepare response
                    $response['success'] = true;
                    $response['message'] = "Login successful!";
                    $response['redirect'] = $redirect;
                } else {
                    // Login failed
                    $response['success'] = false;
                    $response['message'] = "Invalid email or password!";
                }

                // Send response back to AJAX request
                header('Content-Type: application/json');
                echo json_encode($response);
            }



            // HANDLE REGISTRATION ACTION - REGISTRATION.PHP
            if ($action === "register") {
                $firstname           = $_POST['firstname'];
                $middlename          = $_POST['middlename'];
                $lastname            = $_POST['lastname'];
                $suffix              = $_POST['suffix'];
                $contact             = $_POST['contact'];
                $email               = $_POST['email'];
                $institution_name    = $_POST['institution_name'];
                $address = $_POST['address'];               

                $db = new db_class();

                $result = $db->register($firstname, $middlename, $lastname, $suffix, $contact, $email, $institution_name, $address);
                if ($result) {
                    $response['success'] = true;
                    $response['message'] = "Registration successful!";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Registration failed!";
                }

                header('Content-Type: application/json');
                echo json_encode($response);
            } 



            // HANDLE UPDATE PROFILE INFO - USERS/PROFILE.PHP
            if ($action === "UpdateAdminDetails") {
                $user_Id          = $_POST['user_Id'];
                $firstname        = $_POST['firstname'];
                $middlename       = $_POST['middlename'];
                $lastname         = $_POST['lastname'];
                $suffix           = $_POST['suffix'];
                $birthdate        = $_POST['birthdate'];
                $birthplace       = $_POST['birthplace'];
                $gender           = $_POST['gender'];
                $civilstatus      = $_POST['civilstatus'];
                $occupation       = $_POST['occupation'];
                $religion         = $_POST['religion'];
                $email            = $_POST['email'];
                $contact          = $_POST['contact'];
                $house_no         = $_POST['house_no'];
                $street_name      = $_POST['street_name'];
                $purok            = $_POST['purok'];
                $zone             = $_POST['zone'];
                $barangay         = $_POST['barangay'];
                $municipality     = $_POST['municipality'];
                $province         = $_POST['province'];
                $region           = $_POST['region'];

                $db = new db_class();

                $result = $db->UpdateAdminDetails($user_Id, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region);
                
                $response = array();

                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result) {
                    $response['success'] = true;
                    $response['message'] = "Updating profile successful!";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Updating profile failed!";
                }

                header('Content-Type: application/json');
                echo json_encode($response);
            }




            // HANDLE UPDATE PROFILE PICTURE - USERS/PROFILE.PHP
            if ($action === 'updateProfileForm') {

                $user_ID = $_POST['updateProfile_user_Id'];

                $response = array('success' => false);
                header('Content-Type: application/json');

                // Retrieve image file data
                $image        = $_FILES['image'];

                $timestamp = time(); // Get current Unix timestamp
                $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Get the file extension
                $unique_filename = $timestamp . '.' . $file_extension;
                
                // Check file type
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                if (!in_array($image['type'], $allowed_types)) {
                    $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    echo json_encode($response);
                    exit;
                }

                // Check file size
                if ($image['size'] > 500000) { // 500 KB (in bytes)
                    $response['success'] = false;
                    $response['message'] = "File size exceeds the limit (500 KB).";
                    echo json_encode($response);
                    exit;
                }

                // Check file extension
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    echo json_encode($response);
                    exit;
                }

                // Move the uploaded file to your desired directory
                $destination = '../images-users/' . $unique_filename;
                if (move_uploaded_file($image['tmp_name'], $destination)) {
                    $db = new db_class();
                    $result = $db->updateProfileForm($user_ID, $unique_filename);

                    if (is_string($result)) {
                        $response['success'] = false;
                        $response['message'] = $result;
                    } else if ($result === true) {
                        $response['success'] = true;
                        $response['message'] = "Profile has been updated!";
                    } else {
                        $response['success'] = false;
                        $response['message'] = $result;
                    }
                    echo json_encode($response);
                } else {
                    // Failed to move the file
                    $response['message'] = "Failed to move the uploaded file.";
                    echo json_encode($response);
                    exit;
                }

            }



            // HANDLE CHANGE PASSWORD - USERS/PROFILE.PHP
            if ($action === 'updateAdminPassword') {
                $user_Id          = $_POST['user_Id'];
                $type             = $_POST['type'];
                $OldPassword      = $_POST['OldPassword'];
                $password         = $_POST['password'];
                $cpassword        = $_POST['cpassword'];

                $db = new db_class();

                $result = $db->updateAdminPassword($user_Id, $type, $OldPassword, $password, $cpassword);
                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result === true) {
                    $response['success'] = true;
                    $response['message'] = "Password successfully changed";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error changing password";
                }
                header('Content-Type: application/json');
                echo json_encode($response);
            }






// ACADEMIC YEAR FUNCTION**********************************************************

    if ($action === "AddAcadForm") {
        $year_from = $_POST['year_from'];
        $year_to   = $_POST['year_to'];

        $db = new db_class();

        $result = $db->AddAcadForm($year_from, $year_to);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Academic year has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = "Adding new academic year failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    if ($action === "UpdateAcadForm") {
        $year_ID   = $_POST['year_ID'];
        $year_from = $_POST['year_from'];
        $year_to   = $_POST['year_to'];
        $status    = $_POST['status'];

        $db = new db_class();

        $result = $db->UpdateAcadForm($year_ID, $year_from, $year_to, $status);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Academic year has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating Academic year failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    if ($action === "DeleteAcadForm") {
        $year_ID = $_POST['year_ID'];
        $db = new db_class();
        $result = $db->DeleteRecordForm("academic_year", "year_ID", $year_ID);
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Academic year has been deleted!";
        } else {
            $response['success'] = false;
            $response['message'] = "Deleting academic year failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END ACADEMIC YEAR FUNCTION**********************************************************



// SUBJECT FUNCTION**********************************************************

    if ($action === "AddSubjectForm") {
        $semester_ID = $_POST['semester_ID'];
        $course_ID   = $_POST['course_ID'];
        $level_ID = $_POST['level_ID'];
        $sub_no   = $_POST['sub_no'];
        $descriptive_title = $_POST['descriptive_title'];
        $units   = $_POST['units'];
        $offer_code = $_POST['offer_code'];
        $instructor_ID   = $_POST['instructor_ID'];

        $db = new db_class();

        $result = $db->AddSubjectForm($semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Subject has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = "Adding new Subject failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    if ($action === "UpdateSubjectForm") {
        $sub_ID   = $_POST['sub_ID'];
        $semester_ID = $_POST['semester_ID'];
        $course_ID   = $_POST['course_ID'];
        $level_ID    = $_POST['level_ID'];
        $sub_no   = $_POST['sub_no'];
        $descriptive_title = $_POST['descriptive_title'];
        $units   = $_POST['units'];
        $offer_code    = $_POST['offer_code'];
        $instructor_ID    = $_POST['instructor_ID'];

        $db = new db_class();

        $result = $db->UpdateSubjectForm($sub_ID, $semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Subject has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating Subject failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    if ($action === "DeleteSubjectForm") {
        $sub_ID = $_POST['sub_ID'];
        $db = new db_class();
        $result = $db->DeleteRecordForm("subject", "sub_ID", $sub_ID);
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Subject has been deleted!";
        } else {
            $response['success'] = false;
            $response['message'] = "Deleting Subject failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END SUBJECT FUNCTION**********************************************************


// SEMESTER FUNCTION**********************************************************
    if ($action === "AddSemesterForm") {
        $year_ID = $_POST['year_ID'];
        $semester   = $_POST['semester'];

        $db = new db_class();

        $result = $db->AddSemesterForm($year_ID, $semester);

        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "New Semester has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = "Adding New Semester failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    if ($action === "UpdateSemForm") {
        $semester_ID   = $_POST['semester_ID'];
        $year_ID   = $_POST['year_ID'];
        $semester = $_POST['semester'];
        $status    = $_POST['status'];

        $db = new db_class();

        $result = $db->UpdateSemForm($semester_ID, $year_ID, $semester, $status);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Semester has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating Semester failed!";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    if ($action === "DeleteSemForm") {
        $semester_ID = $_POST['semester_ID'];
        $db = new db_class();
        $result = $db->DeleteRecordForm("semester", "semester_ID", $semester_ID);
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Semester has been deleted!";
        } else {
            $response['success'] = false;
            $response['message'] = "Deleting Semester failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END SEMESTER FUNCTION**********************************************************




// COURSE FUNCTION**********************************************************
    if ($action === "AddCourseForm") {
        $dept_ID     = $_POST['dept_ID'];
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];

        $db = new db_class();

        $result = $db->AddCourseForm($dept_ID, $course_name, $course_desc);
        if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Course has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    if ($action === "UpdateCourseForm") {
        $course_ID   = $_POST['course_ID'];
        $dept_ID     = $_POST['dept_ID'];
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];

        $db = new db_class();

        $result = $db->UpdateCourseForm($course_ID, $dept_ID, $course_name, $course_desc);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Course has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating course failed!";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    if ($action === "DeleteCourseForm") {
        $course_ID = $_POST['course_ID'];

        $db = new db_class();

        $result = $db->DeleteRecordForm("course", "course_ID", $course_ID);
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Course has been deleted!";
        } else {
            $response['success'] = false;
            $response['message'] = "Deleting course failed!";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END COURSE FUNCTION**********************************************************




// DEPARTMENT FUNCTION**********************************************************
    if ($action === "AddDepartmentForm") {
        $year_ID     = $_POST['year_ID'];
        $dept_name = $_POST['dept_name'];
        $motto = $_POST['motto'];

        $db = new db_class();

        $result = $db->AddDepartmentForm($year_ID, $dept_name, $motto);
        if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Department has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }
        header('Content-Type: application/json');
        echo json_encode($response);

    }
              

    if ($action === "UpdateDepartmentForm") {
        $dept_ID   = $_POST['dept_ID'];
        $year_ID     = $_POST['year_ID'];
        $dept_name = $_POST['dept_name'];
        $motto = $_POST['motto'];

        $db = new db_class();
        $result = $db->UpdateDepartmentForm($dept_ID, $year_ID, $dept_name, $motto);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Course has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating course failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    if ($action === "DeleteDepartmentForm") {
        if(isset($_POST['dept_ID'])) {
            $dept_ID = $_POST['dept_ID'];

            $db = new db_class();

            $result = $db->DeleteRecordForm("department", "dept_ID", $dept_ID);
            if ($result) {
                $response['success'] = true;
                $response['message'] = "Department has been deleted!";
            } else {
                $response['success'] = false;
                $response['message'] = "Deleting Department failed!";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: 'delete_dept_ID' key is not set in the POST request.";
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END DEPARTMENT FUNCTION**********************************************************




// YEAR LEVEL FUNCTION**********************************************************
    if ($action === "AddLevelForm") {
        $level     = $_POST['level'];
        $db = new db_class();

        $result = $db->AddLevelForm($level);
        if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Department has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }
        header('Content-Type: application/json');
        echo json_encode($response);

    }
              

    if ($action === "UpdateLevelForm") {
        $level_ID   = $_POST['level_ID'];
        $level     = $_POST['level'];

        $db = new db_class();

        $result = $db->UpdateLevelForm($level_ID, $level);
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result) {
            $response['success'] = true;
            $response['message'] = "Year level has been updated!";
        } else {
            $response['success'] = false;
            $response['message'] = "Updating Year level failed!";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    if ($action === "DeleteLevelForm") {
        if(isset($_POST['level_ID'])) {
            $level_ID = $_POST['level_ID'];

            $db = new db_class();

            $result = $db->DeleteRecordForm("level", "level_ID", $level_ID);
            if ($result) {
                $response['success'] = true;
                $response['message'] = "Year level has been deleted!";
            } else {
                $response['success'] = false;
                $response['message'] = "Deleting Year level failed!";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: 'level_ID' key is not set in the POST request.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END YEAR LEVEL FUNCTION**********************************************************



// INSTRUCTOR FUNCTION**********************************************************
    if ($action === "AddInstructorForm") {
        $year_ID      = $_POST['year_ID'];
        $firstname    = $_POST['firstname'];
        $middlename   = $_POST['middlename'];
        $lastname     = $_POST['lastname'];
        $suffix       = $_POST['suffix'];
        $gender       = $_POST['gender'];
        $birthdate    = $_POST['birthdate'];
        $contact      = $_POST['contact'];
        $email        = $_POST['email'];
        $address      = $_POST['address'];
        $emp_ID       = $_POST['emp_ID'];
        $dept_ID      = $_POST['dept_ID'];
        $position     = $_POST['position'];
        $emp_status   = $_POST['emp_status'];
        $hired_date   = $_POST['hired_date'];
        $contract_end = $_POST['contract_end'];
        $degrees_held = $_POST['degrees_held'];
        $major_study  = $_POST['major_study'];
        $password     = $_POST['password'];
        $cpassword    = $_POST['cpassword'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        if ($password !== $cpassword) {
            $response['message'] = "Passwords do not match.";
            echo json_encode($response);
            exit;
        }
        

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve image file data
            $image        = $_FILES['image'];

            $timestamp = time(); // Get current Unix timestamp
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Get the file extension
            $unique_filename = $timestamp . '.' . $file_extension;
            
            // Check file type
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($image['type'], $allowed_types)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Check file size
            if ($image['size'] > 500000) { // 500 KB (in bytes)
                $response['success'] = false;
                $response['message'] = "File size exceeds the limit (500 KB).";
                echo json_encode($response);
                exit;
            }

            // Check file extension
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to your desired directory
            $destination = '../images-users/' . $unique_filename;
            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $db = new db_class();
                $result = $db->AddInstructorForm($year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename, $password);

                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result === true) {
                    $response['success'] = true;
                    $response['message'] = "New instructor has been added!";
                } else {
                    $response['success'] = false;
                    $response['message'] = $result;
                }
                echo json_encode($response);
            } else {
                // Failed to move the file
                $response['message'] = "Failed to move the uploaded file.";
                echo json_encode($response);
                exit;
            }
        } else {
            // No image uploaded, set default image
            $unique_filename = "user.jpg";
            $db = new db_class();
            $result = $db->AddInstructorForm($year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename, $password);

            if (is_string($result)) {
                $response['success'] = false;
                $response['message'] = $result;
            } else if ($result === true) {
                $response['success'] = true;
                $response['message'] = "New instructor has been added!";
            } else {
                $response['success'] = false;
                $response['message'] = $result;
            }
            echo json_encode($response);
        }
    }


      

    if ($action === "UpdateInstructorForm") {
        $instructor_ID= $_POST['instructor_ID'];
        $year_ID      = $_POST['year_ID'];
        $firstname    = $_POST['firstname'];
        $middlename   = $_POST['middlename'];
        $lastname     = $_POST['lastname'];
        $suffix       = $_POST['suffix'];
        $gender       = $_POST['gender'];
        $birthdate    = $_POST['birthdate'];
        $contact        = $_POST['contact'];
        $email        = $_POST['email'];
        $address      = $_POST['address'];
        $emp_ID       = $_POST['emp_ID'];
        $dept_ID      = $_POST['dept_ID'];
        $position     = $_POST['position'];
        $emp_status   = $_POST['emp_status'];
        $hired_date   = $_POST['hired_date'];
        $contract_end = $_POST['contract_end'];
        $degrees_held = $_POST['degrees_held'];
        $major_study  = $_POST['major_study'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        $instructor = $db->getInstructor($instructor_ID);
        $row2 = $instructor->fetch_assoc();


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve image file data
            $image        = $_FILES['image'];

            $timestamp = time(); // Get current Unix timestamp
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Get the file extension
            $unique_filename = $timestamp . '.' . $file_extension;
            
            // Check file type
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($image['type'], $allowed_types)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Check file size
            if ($image['size'] > 500000) { // 500 KB (in bytes)
                $response['success'] = false;
                $response['message'] = "File size exceeds the limit (500 KB).";
                echo json_encode($response);
                exit;
            }

            // Check file extension
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to your desired directory
            $destination = '../images-users/' . $unique_filename;
            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $db = new db_class();
                $result = $db->UpdateInstructorForm($instructor_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename);

                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result === true) {
                    $response['success'] = true;
                    $response['message'] = "Instructor has been updated!";
                } else {
                    $response['success'] = false;
                    $response['message'] = $result;
                }
                echo json_encode($response);
            } else {
                // Failed to move the file
                $response['message'] = "Failed to move the uploaded file.";
                echo json_encode($response);
                exit;
            }
        } else {
            // No image uploaded, set default image
            $unique_filename = $row2['image'];
            $db = new db_class();
            $result = $db->UpdateInstructorForm($instructor_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename);

            if (is_string($result)) {
                $response['success'] = false;
                $response['message'] = $result;
            } else if ($result === true) {
                $response['success'] = true;
                $response['message'] = "Instructor has been updated!";
            } else {
                $response['success'] = false;
                $response['message'] = $result;
            }
            echo json_encode($response);
        }
    }




    if ($action === "DeleteInstructorForm") {
        if(isset($_POST['instructor_ID'])) {
            $instructor_ID = $_POST['instructor_ID'];

            $db = new db_class();

            $result = $db->DeleteRecordForm("instructor", "instructor_ID", $instructor_ID);
            if ($result) {
                $response['success'] = true;
                $response['message'] = "Instructor has been deleted!";
            } else {
                $response['success'] = false;
                $response['message'] = "Deleting Instructor failed!";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: 'instructor_ID' key is not set in the POST request.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END INSTRUCTOR FUNCTION**********************************************************



// ADMINISTRATOR FUNCTION**********************************************************
    if ($action === "AddAdminForm") {

        $user_type    = $_POST['user_type'];
        $firstname    = $_POST['firstname'];
        $middlename   = $_POST['middlename'];
        $lastname     = $_POST['lastname'];
        $suffix       = $_POST['suffix'];
        $birthdate    = $_POST['birthdate'];
        $birthplace   = $_POST['birthplace'];
        $gender       = $_POST['gender'];
        $civilstatus  = $_POST['civilstatus'];
        $occupation   = $_POST['occupation'];
        $religion     = $_POST['religion'];
        $email        = $_POST['email'];
        $contact      = $_POST['contact'];
        $house_no     = $_POST['house_no'];
        $street_name  = $_POST['street_name'];
        $purok        = $_POST['purok'];
        $zone         = $_POST['zone'];
        $barangay     = $_POST['barangay'];
        $municipality = $_POST['municipality'];
        $province     = $_POST['province'];
        $region       = $_POST['region'];
        $password     = $_POST['password'];
        $cpassword    = $_POST['cpassword'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        if ($password !== $cpassword) {
            $response['message'] = "Passwords do not match.";
            echo json_encode($response);
            exit;
        }
        

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve image file data
            $image        = $_FILES['image'];

            $timestamp = time(); // Get current Unix timestamp
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Get the file extension
            $unique_filename = $timestamp . '.' . $file_extension;
            
            // Check file type
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($image['type'], $allowed_types)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Check file size
            if ($image['size'] > 500000) { // 500 KB (in bytes)
                $response['success'] = false;
                $response['message'] = "File size exceeds the limit (500 KB).";
                echo json_encode($response);
                exit;
            }

            // Check file extension
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to your desired directory
            $destination = '../images-users/' . $unique_filename;
            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $db = new db_class();
                $result = $db->AddAdminForm($user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $password, $unique_filename);

                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result === true) {
                    $response['success'] = true;
                    $response['message'] = "New administrator has been added!";
                } else {
                    $response['success'] = false;
                    $response['message'] = $result;
                }
                echo json_encode($response);
            } else {
                // Failed to move the file
                $response['message'] = "Failed to move the uploaded file.";
                echo json_encode($response);
                exit;
            }
        } else {
            // No image uploaded, set default image
            $unique_filename = "user.jpg";
            $db = new db_class();
            $result = $db->AddAdminForm($user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $password, $unique_filename);

            if (is_string($result)) {
                $response['success'] = false;
                $response['message'] = $result;
            } else if ($result === true) {
                $response['success'] = true;
                $response['message'] = "New administrator has been added!";
            } else {
                $response['success'] = false;
                $response['message'] = $result;
            }
            echo json_encode($response);
        }
    }


      


    if ($action === "UpdateAdminForm") {
        $user_Id      = $_POST['user_Id'];
        $user_type    = $_POST['user_type'];
        $firstname    = $_POST['firstname'];
        $middlename   = $_POST['middlename'];
        $lastname     = $_POST['lastname'];
        $suffix       = $_POST['suffix'];
        $birthdate    = $_POST['birthdate'];
        $birthplace   = $_POST['birthplace'];
        $gender       = $_POST['gender'];
        $civilstatus  = $_POST['civilstatus'];
        $occupation   = $_POST['occupation'];
        $religion     = $_POST['religion'];
        $email        = $_POST['email'];
        $contact      = $_POST['contact'];
        $house_no     = $_POST['house_no'];
        $street_name  = $_POST['street_name'];
        $purok        = $_POST['purok'];
        $zone         = $_POST['zone'];
        $barangay     = $_POST['barangay'];
        $municipality = $_POST['municipality'];
        $province     = $_POST['province'];
        $region       = $_POST['region'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        $users = $db->getUsers($user_Id);
        $row2 = $users->fetch_assoc();


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve image file data
            $image        = $_FILES['image'];

            $timestamp = time(); // Get current Unix timestamp
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION); // Get the file extension
            $unique_filename = $timestamp . '.' . $file_extension;
            
            // Check file type
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($image['type'], $allowed_types)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Check file size
            if ($image['size'] > 500000) { // 500 KB (in bytes)
                $response['success'] = false;
                $response['message'] = "File size exceeds the limit (500 KB).";
                echo json_encode($response);
                exit;
            }

            // Check file extension
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to your desired directory
            $destination = '../images-users/' . $unique_filename;
            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $db = new db_class();
                $result = $db->UpdateAdminForm($user_Id, $user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $unique_filename);

                if (is_string($result)) {
                    $response['success'] = false;
                    $response['message'] = $result;
                } else if ($result === true) {
                    $response['success'] = true;
                    $response['message'] = "Administrator has been updated!";
                } else {
                    $response['success'] = false;
                    $response['message'] = $result;
                }
                echo json_encode($response);
            } else {
                // Failed to move the file
                $response['message'] = "Failed to move the uploaded file.";
                echo json_encode($response);
                exit;
            }
        } else {
            // No image uploaded, set default image
            $unique_filename = $row2['image'];
            $db = new db_class();
            $result = $db->UpdateAdminForm($user_Id, $user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $unique_filename);

            if (is_string($result)) {
                $response['success'] = false;
                $response['message'] = $result;
            } else if ($result === true) {
                $response['success'] = true;
                $response['message'] = "Administrator has been updated!";
            } else {
                $response['success'] = false;
                $response['message'] = $result;
            }
            echo json_encode($response);
        }
    }





    if ($action === "DeleteAdminForm") {
        if(isset($_POST['user_Id'])) {
            $user_Id = $_POST['user_Id'];

            $db = new db_class();

            $result = $db->DeleteRecordForm("users", "user_Id", $user_Id);
            if ($result) {
                $response['success'] = true;
                $response['message'] = "Administrator has been deleted!";
            } else {
                $response['success'] = false;
                $response['message'] = "Deleting Administrator failed!";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: 'user_Id' key is not set in the POST request.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END ADMINISTRATOR FUNCTION**********************************************************



// STUDENTS FUNCTION**********************************************************
    if ($action === "AddStudentForm") {

        $stud_type               = $_POST['stud_type'];
        $student_ID              = $_POST['student_ID'];
        $year_ID                 = $_POST['year_ID'];
        $firstname               = $_POST['firstname'];
        $middlename              = $_POST['middlename'];
        $lastname                = $_POST['lastname'];
        $suffix                  = $_POST['suffix'];
        $gender                  = $_POST['gender'];
        $birthdate               = $_POST['birthdate'];
        $address                 = $_POST['address'];
        $citizenship             = $_POST['citizenship'];
        $contact                 = $_POST['contact'];
        $email                   = $_POST['email'];
        $GWA                     = $_POST['GWA'];
        $year_level_ID           = $_POST['year_level_ID'];
        $course_ID               = $_POST['course_ID'];
        $school_name             = $_POST['school_name'];
        $school_address          = $_POST['school_address'];
        $emergency_contact_name  = $_POST['emergency_contact_name'];
        $relationship_to_student = $_POST['relationship_to_student'];
        $emergency_contact       = $_POST['emergency_contact'];
        $parent_name             = $_POST['parent_name'];
        $parent_relationship     = $_POST['parent_relationship'];
        $parent_contact          = $_POST['parent_contact'];
        $password                = $_POST['password'];
        $cpassword               = $_POST['cpassword'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        if ($password !== $cpassword) {
            $response['message'] = "Passwords do not match.";
            echo json_encode($response);
            exit;
        }

        if (!empty($_FILES['documents']['name'][0])) {
            $uploaded_files = array();
            
            foreach ($_FILES['documents']['name'] as $key => $file_name) {
                $file_tmp = $_FILES['documents']['tmp_name'][$key];
                $file_size = $_FILES['documents']['size'][$key];
                $file_error = $_FILES['documents']['error'][$key];

                if ($file_error === UPLOAD_ERR_OK) {
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($file_ext, $allowed_ext)) {
                        if ($file_size <= 500000) {
                            $unique_filename = uniqid('file_') . '.' . $file_ext;
                            
                            $upload_dir = '../documents/';
                            $upload_path = $upload_dir . $unique_filename;
                            if (move_uploaded_file($file_tmp, $upload_path)) {
                                $uploaded_files[] = $unique_filename;
                            } else {
                                $response['message'] = "Failed to move uploaded file.";
                                echo json_encode($response);
                                exit;
                            }
                        } else {
                            $response['message'] = "File size exceeds the limit (500 KB).";
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['message'] = "Error uploading file.";
                    echo json_encode($response);
                    exit;
                }
            }

            $documents = implode(',', $uploaded_files);
        } else {
            $documents = '';
        }

        $db = new db_class();
        $result = $db->AddStudentForm($stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $password, $uploaded_files);

        // Process the result
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result === true) {
            $response['success'] = true;
            $response['message'] = "New student has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }

        // Send JSON response
        echo json_encode($response);
    }


    if ($action === "UpdateStudentForm") {

        $stud_ID                 = $_POST['stud_ID'];
        $stud_type               = $_POST['stud_type'];
        $student_ID              = $_POST['student_ID'];
        $year_ID                 = $_POST['year_ID'];
        $firstname               = $_POST['firstname'];
        $middlename              = $_POST['middlename'];
        $lastname                = $_POST['lastname'];
        $suffix                  = $_POST['suffix'];
        $gender                  = $_POST['gender'];
        $birthdate               = $_POST['birthdate'];
        $address                 = $_POST['address'];
        $citizenship             = $_POST['citizenship'];
        $contact                 = $_POST['contact'];
        $email                   = $_POST['email'];
        $GWA                     = $_POST['GWA'];
        $year_level_ID           = $_POST['year_level_ID'];
        $course_ID               = $_POST['course_ID'];
        $school_name             = $_POST['school_name'];
        $school_address          = $_POST['school_address'];
        $emergency_contact_name  = $_POST['emergency_contact_name'];
        $relationship_to_student = $_POST['relationship_to_student'];
        $emergency_contact       = $_POST['emergency_contact'];
        $parent_name             = $_POST['parent_name'];
        $parent_relationship     = $_POST['parent_relationship'];
        $parent_contact          = $_POST['parent_contact'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        $students = $db->getStudents($stud_ID);
        $row2 = $students->fetch_assoc();

        // Check for uploaded files
        if (!empty($_FILES['documents']['name'][0])) {
            $uploaded_files = array();
            
            foreach ($_FILES['documents']['name'] as $key => $file_name) {
                $file_tmp = $_FILES['documents']['tmp_name'][$key];
                $file_size = $_FILES['documents']['size'][$key];
                $file_error = $_FILES['documents']['error'][$key];

                if ($file_error === UPLOAD_ERR_OK) {
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($file_ext, $allowed_ext)) {
                        if ($file_size <= 500000) {
                            $unique_filename = uniqid('file_') . '.' . $file_ext;
                            
                            $upload_dir = '../documents/';
                            $upload_path = $upload_dir . $unique_filename;
                            if (move_uploaded_file($file_tmp, $upload_path)) {
                                $uploaded_files[] = $unique_filename;
                            } else {
                                $response['message'] = "Failed to move uploaded file.";
                                echo json_encode($response);
                                exit;
                            }
                        } else {
                            $response['message'] = "File size exceeds the limit (500 KB).";
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['message'] = "Error uploading file.";
                    echo json_encode($response);
                    exit;
                }
            }

            $documents = implode(',', $uploaded_files);
        } else {
            $documents = $row2['documents'];    
        }


        $db = new db_class();
        $result = $db->UpdateStudentForm($stud_ID, $stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $documents);

        // Process the result
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Student record has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }

        // Send JSON response
        echo json_encode($response);
    }



    if ($action === "VerifyStudentForm") {
        $stud_ID = $_POST['stud_ID'];

        $response = array('success' => false);
        header('Content-Type: application/json');

        $db = new db_class();
        $result = $db->VerifyStudentForm($stud_ID);

        // Process the result
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Student record has been verified!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }
        // Send JSON response
        echo json_encode($response);
    }



    
    if ($action === "DeleteStudentForm") {
        if(isset($_POST['stud_ID'])) {
            $stud_ID = $_POST['stud_ID'];

            $db = new db_class();

            $result = $db->DeleteRecordForm("students", "stud_ID", $stud_ID);
            if ($result) {
                $response['success'] = true;
                $response['message'] = "Student has been deleted!";
            } else {
                $response['success'] = false;
                $response['message'] = "Deleting Student failed!";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: 'stud_ID' key is not set in the POST request.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
// END STUDENTS FUNCTION**********************************************************


// ENROLLMENT FUNCTION**********************************************************

    
    if ($action === "getStudentCourse") {
        if(isset($_POST['course_ID'])) {
            $course_ID = $_POST['course_ID'];

            $db = new db_class();

            $result = $db->getStudentsCourse($course_ID);
            if ($result) {
                $response['success'] = true;
                $response['students'] = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $response['success'] = false;
                $response['message'] = "Error fetching students!";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    if ($action === "enrollStudentForm") {
        $semester_ID = $_POST['semester_ID'];
        $course_ID   = $_POST['course_ID'];
        $stud_ID     = $_POST['stud_ID'];

        $db = new db_class();

        $result = $db->enrollStudentForm($semester_ID, $course_ID, $stud_ID);
        if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Student has been enrolled!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

// END ENROLLMENT FUNCTION**********************************************************
    if ($action === "uploadPaymentForm") {

        $stud_ID = $_POST['stud_ID'];

        $response = array('success' => false);
        header('Content-Type: application/json');


        if (!empty($_FILES['receipt']['name'][0])) {
            $uploaded_files = array();
            
            foreach ($_FILES['receipt']['name'] as $key => $file_name) {
                $file_tmp = $_FILES['receipt']['tmp_name'][$key];
                $file_size = $_FILES['receipt']['size'][$key];
                $file_error = $_FILES['receipt']['error'][$key];

                if ($file_error === UPLOAD_ERR_OK) {
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($file_ext, $allowed_ext)) {
                        if ($file_size <= 500000) {
                            $unique_filename = uniqid('file_') . '.' . $file_ext;
                            
                            $upload_dir = '../Receipt/';
                            $upload_path = $upload_dir . $unique_filename;
                            if (move_uploaded_file($file_tmp, $upload_path)) {
                                $uploaded_files[] = $unique_filename;
                            } else {
                                $response['message'] = "Failed to move uploaded file.";
                                echo json_encode($response);
                                exit;
                            }
                        } else {
                            $response['message'] = "File size exceeds the limit (500 KB).";
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['message'] = "Error uploading file.";
                    echo json_encode($response);
                    exit;
                }
            }

            $documents = implode(',', $uploaded_files);
        } else {
            $documents = '';
        }

        $db = new db_class();
        $result = $db->uploadPaymentForm($stud_ID, $uploaded_files);

        // Process the result
        if (is_string($result)) {
            $response['success'] = false;
            $response['message'] = $result;
        } else if ($result === true) {
            $response['success'] = true;
            $response['message'] = "Receipt has been added!";
        } else {
            $response['success'] = false;
            $response['message'] = $result;
        }

        // Send JSON response
        echo json_encode($response);
    }


        }
    }

    

?>
