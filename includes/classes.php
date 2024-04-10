<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    // require '../vendor/phpmailer/src/Exception.php';
    // require '../vendor/phpmailer/src/PHPMailer.php';
    // require '../vendor/phpmailer/src/SMTP.php';
    if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/phpmailer/src/Exception.php'; }
    if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php'; }
    if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/phpmailer/src/SMTP.php'; }

    class db_class extends db_connect {
        
        public function __construct(){
            $this->connect();
        }


        // CHECK EXISTING ID_number - REGISTRATION.PHP
        public function checkExistingID_number($ID_number, $user_ID = "") {

            if(!empty($user_ID)) {
                $queryID_number = $this->conn->prepare("SELECT * FROM user WHERE ID_number = ? AND user_ID != ?");
                $queryID_number->bind_param("si", $ID_number, $user_ID);
            } else {
                $queryID_number = $this->conn->prepare("SELECT * FROM user WHERE ID_number = ?");
                $queryID_number->bind_param("s", $ID_number);
            }

            $queryID_number->execute();
            $resultID_number = $queryID_number->get_result();
            
            $response = array('ID_numberExists' => false);

            if ($resultID_number->num_rows > 0) {
                $response['ID_numberExists'] = true;
            }

            $queryID_number->close();

            return $response;
        }



        // HANDLE CHECK EXISTING EMAIL ACTION FOR FORGOT PASSWORD - FORGOTPASSWORD.PHP
        public function checkEmail($email) {
            $response = array('exists' => false);
            
            // Check in the users table
            $query = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response['exists'] = true;
                $response['type'] = 'user'; // Set type to 'user' for users table
                $response['id'] = $row['user_Id']; // Set user ID
                return $response;
            }
            
            $query->close();
            
            // Check in the students table
            $query = $this->conn->prepare("SELECT * FROM students WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response['exists'] = true;
                $response['type'] = 'student'; // Set type to 'student' for students table
                $response['id'] = $row['stud_ID']; // Set student ID
                return $response;
            }
            
            $query->close();
            
            // Check in the instructors table
            $query = $this->conn->prepare("SELECT * FROM instructor WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response['exists'] = true;
                $response['type'] = 'instructor'; // Set type to 'instructor' for instructors table
                $response['id'] = $row['instructor_ID']; // Set instructor ID
                return $response;
            }
            
            $query->close();

            return $response;
        }




        // GET USER BY TYPE - SENDCODE.PHP
        public function getUserByType($email, $type, $id) {

          if($type === 'user') {
            $query = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND user_Id = ?");
          } elseif($type === 'student') {
            $query = $this->conn->prepare("SELECT * FROM students WHERE email = ? AND stud_ID = ?");
          } else {
            $query = $this->conn->prepare("SELECT * FROM instructor WHERE email = ? AND instructor_ID = ?");
          }

            $query->bind_param("si", $email, $id);

            if ($query->execute()) {
                $result = $query->get_result();
                return $result; // Return the result object directly
            }
            return false;
        }



        // HANDLE SENDING VERIFICATION CODE - SENDCODE.PHP
        public function sendCode($email, $type, $id) {

            $key = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $fetch_user = $this->getUserByType($email, $type, $id);
            $user = $fetch_user->fetch_array();

            if($type === 'user') {
                $query = $this->conn->prepare("UPDATE users SET verification_code=? WHERE email = ? AND user_Id= ?") or die($this->conn->error);
            } elseif($type === 'student') {
                $query = $this->conn->prepare("UPDATE students SET verification_code=? WHERE email = ? AND stud_ID= ?") or die($this->conn->error);
            } else {
                $query = $this->conn->prepare("UPDATE instructor SET verification_code=? WHERE email = ? AND instructor_ID= ?") or die($this->conn->error);
            }
            
            $query->bind_param("isi", $key, $email, $id);
            if($query->execute()) {

                $subject = 'Verification Code';

                $message = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; margin: 0; padding: 2px; background-color: #f4f4f4;">

                        <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                            <!-- Header with logo and system name -->
                            <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;">
                                <!-- <img src="images-users/academia.png" alt="Logo" style="max-width: 100px; height: auto; border-radius: 50%; margin-bottom: 10px;"> -->
                                <div style="font-size: 20px; font-weight: bold; color: #007BFF;">Docsify</div>
                            </div>

                            <!-- Heading and message section -->
                            <h2 style="color: #333;">Verification Code</h2>
                            <p style="color: #666; margin-bottom: 15px;">Dear '.$user['firstname'].',</p>
                            <p style="color: #666; margin-bottom: 15px;">Your verification code is: <b>'.$key.'</b>. Please keep this code confidential and do not share it with others. Thank you!</p>
                            <p style="color: #666; margin-bottom: 15px;">To change your password, simply click <a href="http://localhost/Enrollment%20System/changePassword.php?email='.$email.'">here</a>.</p>

                            <!-- Add more paragraphs or customize as needed -->

                            <!-- Closing note -->
                            <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
                        </div>

                    </body>
                    </html>
                ';
                $this->sendEmail($subject, $message, $email); 

                $query->close();
                $this->conn->close();
                return true;
            }
        }


        // VERIFY EMAIL BY VERIFICATION CODE - VERIFYCODE.PHP
        public function verifyEmail_by_code($email, $type, $id, $code) {

          if($type === 'user') {
            $query = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND user_Id = ? AND verification_code = ? LIMIT 1 ");
          } elseif($type === 'student') {
            $query = $this->conn->prepare("SELECT * FROM students WHERE email = ? AND stud_ID = ? AND verification_code = ? LIMIT 1");
          } else {
            $query = $this->conn->prepare("SELECT * FROM instructor WHERE email = ? AND instructor_ID = ? AND verification_code = ? LIMIT 1");
          }
            
            $query->bind_param("sii", $email, $id, $code);

            if ($query->execute()) {
                $result = $query->get_result();
                return $result; // Return the result object directly
            }
            return false;
        }


        // HANDLE VERIFICATION CODE - VERIFYCODE.PHP
        public function verifyCode($email, $type, $id, $code) {

            $fetch_user = $this->verifyEmail_by_code($email, $type, $id, $code);
            
            if ($fetch_user->num_rows > 0) {
                $user = $fetch_user->fetch_array();

                  if($type === 'user') {
                    $query = $this->conn->prepare("UPDATE users SET verification_code=NULL WHERE email = ? AND user_Id = ?") or die($this->conn->error);
                  } elseif($type === 'student') {
                    $query = $this->conn->prepare("UPDATE students SET verification_code=NULL WHERE email = ? AND stud_ID = ?") or die($this->conn->error);
                  } else {
                    $query = $this->conn->prepare("UPDATE instructor SET verification_code=NULL WHERE email = ? AND instructor_ID = ?") or die($this->conn->error);
                  }

                $query->bind_param("si", $email, $id);
                if($query->execute()) {
                    $query->close();
                    $this->conn->close();
                    return true;
                }
            } 
            return false;
            
        }

      
        // HANDLE CHANGEPASSWORD ACTION - CHANGEPASSWORD.PHP
        public function changePassword($email, $type, $id, $password, $cpassword) {

          if ($password !== $cpassword) {
            return "Password does not matched";
            return false;
          }  else {
              $hashedPassword = password_hash($cpassword, PASSWORD_DEFAULT);

              if($type === 'user') {
                $query=$this->conn->prepare("UPDATE users SET password = ? WHERE email = ? AND user_Id = ?") or die($this->conn->error);
              } elseif($type === 'student') {
                $query=$this->conn->prepare("UPDATE students SET password = ? WHERE email = ? AND stud_ID = ?") or die($this->conn->error);
              } else {
                $query=$this->conn->prepare("UPDATE instructor SET password = ? WHERE email = ? AND instructor_ID = ?") or die($this->conn->error);
              }
                
                $query->bind_param("ssi", $hashedPassword, $email, $id);
                if($query->execute()){
                    $query->close();
                    $this->conn->close();
                    return true;
                }
                return false;
          }

        }
        


        // HANDLE LOGIN PROCESS - LOGIN.PHP
        public function login($email, $password){
            // Check in the users table
            $query = $this->conn->prepare("SELECT * FROM users WHERE email = ?") or die($this->conn->error);
            $query->bind_param("s", $email);
            if ($query->execute()) {
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $fetch = $result->fetch_array();
                    $hashedPasswordFromDB = $fetch['password'];

                    if (password_verify($password, $hashedPasswordFromDB)) {
                        return array(
                            'user_ID' => isset($fetch['user_Id']) ? $fetch['user_Id'] : 0,
                            'user_type' => 'user'
                        );
                    }
                } 
            }

            // Check in the students table
            $query = $this->conn->prepare("SELECT * FROM students WHERE email = ?") or die($this->conn->error);
            $query->bind_param("s", $email);
            if ($query->execute()) {
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $fetch = $result->fetch_array();
                    $hashedPasswordFromDB = $fetch['password'];

                    if (password_verify($password, $hashedPasswordFromDB)) {
                        return array(
                            'user_ID' => isset($fetch['stud_ID']) ? $fetch['stud_ID'] : 0,
                            'user_type' => 'student' // Indicates user type
                        );
                    }
                } 
            }

            // Check in the instructors table
            $query = $this->conn->prepare("SELECT * FROM instructor WHERE email = ?") or die($this->conn->error);
            $query->bind_param("s", $email);
            if ($query->execute()) {
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $fetch = $result->fetch_array();
                    $hashedPasswordFromDB = $fetch['password'];

                    if (password_verify($password, $hashedPasswordFromDB)) {
                        return array(
                            'user_ID' => isset($fetch['instructor_ID']) ? $fetch['instructor_ID'] : 0,
                            'user_type' => 'instructor' // Indicates user type
                        );
                    }
                } 
            }

            return array('user_ID' => 0);
        }





// USER FUNCTION**********************************************************
        public function checkExistingUsersContact($contact, $user_Id = "") {

            if (!empty($user_Id)) {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM users WHERE user_Id != ? 
                        UNION 
                        SELECT contact FROM instructor 
                        UNION 
                        SELECT contact FROM students
                    ) AS all_contacts WHERE contact = ?");
                $queryContact->bind_param("is", $user_Id, $contact);
            } else {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM instructor 
                        UNION 
                        SELECT contact FROM users 
                        UNION 
                        SELECT contact FROM students
                    ) AS all_contacts WHERE contact = ?");
                $queryContact->bind_param("s", $contact);
            }

            $queryContact->execute();
            $resultContact = $queryContact->get_result();

            $response = array('contactExists' => false);

            if ($resultContact->num_rows > 0) {
                $response['contactExists'] = true;
            }

            $queryContact->close();

            return $response;
        }
        

        public function checkExistingUsersEmail($email, $user_Id = "") {

            if (!empty($user_Id)) {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM users WHERE user_Id != ? 
                        UNION 
                        SELECT email FROM instructor 
                        UNION 
                        SELECT email FROM students
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("is", $user_Id, $email);
            } else {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM instructor 
                        UNION 
                        SELECT email FROM users 
                        UNION 
                        SELECT email FROM students
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("s", $email);
            }

            $queryEmail->execute();
            $resultEmail = $queryEmail->get_result();

            $response = array('emailExists' => false);

            if ($resultEmail->num_rows > 0) {
                $response['emailExists'] = true;
            }

            $queryEmail->close();

            return $response;
        }

            
        public function UpdateAdminDetails($user_Id, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region) {
            // Check for existing contact and email
            $existingPhone = $this->checkExistingUsersContact($contact, $user_Id);
            $existingEmail = $this->checkExistingUsersEmail($email, $user_Id);

            // If contact number already exists, return error
            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            // If email address already exists, return error
            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            // Proceed with the update if no existing contact or email found
            $updateQuery = $this->conn->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, suffix=?, birthdate=?, birthplace=?, gender=?, civilstatus=?, occupation=?, religion=?, email=?, contact=?, house_no=?, street_name=?, purok=?, zone=?, barangay=?, municipality=?, province=?, region=? WHERE user_ID=?");
            $updateQuery->bind_param("ssssssssssssssssssssi", $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $user_Id);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }



        public function updateProfileForm($user_ID, $unique_filename) {
            $query = $this->conn->prepare("UPDATE users SET image = ? WHERE user_Id = ?");
            $query->bind_param("si", $unique_filename, $user_ID);
            $success = $query->execute();
            $query->close();
            return $success;
        }



        public function updateAdminPassword($user_Id, $type, $OldPassword, $password, $cpassword) {
            if($type == 'Administrator') {
                // Retrieve the stored password for the user
                $query = $this->conn->prepare("SELECT password FROM users WHERE user_Id = ?");
            } elseif($type == 'Student') {
                // Retrieve the stored password for the user
                $query = $this->conn->prepare("SELECT password FROM students WHERE stud_ID = ?");
            } else {
                // Retrieve the stored password for the user
                $query = $this->conn->prepare("SELECT password FROM instructor WHERE instructor_ID = ?");
            }
            
            $query->bind_param("i", $user_Id);
            $query->execute();
            $query->store_result(); // Store the result to check the number of rows
            if ($query->num_rows === 0) {
                $query->close();
                return 'User not found'; // Or handle this scenario as appropriate
            }
            $query->bind_result($stored_password);
            $query->fetch();
            $query->close();

            // Verify if the old password matches the stored password
            if (!password_verify($OldPassword, $stored_password)) {
                return 'Old password is incorrect';
            }

            // Check if the new password and confirm password match
            if ($password !== $cpassword) {
                return 'New password and Confirm password does not matched';
            }

            // Hash the new password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if($type == 'Administrator') {
                // Update the password in the database
                $query = $this->conn->prepare("UPDATE users SET password = ? WHERE user_Id = ?");
            } elseif($type == 'Student') {
                // Update the password in the database
                $query = $this->conn->prepare("UPDATE students SET password = ? WHERE stud_ID = ?");
            } else {
                // Update the password in the database
                $query = $this->conn->prepare("UPDATE instructor SET password = ? WHERE instructor_ID = ?");
            }

            // // Update the password in the database
            // $query = $this->conn->prepare("UPDATE users SET password = ? WHERE user_Id = ?");
            $query->bind_param("si", $hashedPassword, $user_Id);
            $success = $query->execute();
            $query->close();

            return $success;
        }


       
        public function register($firstname, $middlename, $lastname, $suffix, $contact, $email, $institution_name, $address){
            $existingContact = $this->checkExistingContact($contact);
            $existingEmail = $this->checkExistingEmail($email);

            if ($existingContact['contactExists'] || $existingEmail['emailExists']) {
                return false;
            }

            $insertQuery = $this->conn->prepare("INSERT INTO user (firstname, middlename, lastname, suffix, contact, email, institution_name, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insertQuery->bind_param("ssssssss", $firstname, $middlename, $lastname, $suffix, $contact, $email, $institution_name, $address);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }



        public function getUsers($id = ""){
            if(!empty($id)) {
                $query=$this->conn->prepare("SELECT * FROM users WHERE user_Id='$id'") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT * FROM users") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        
        public function AddAdminForm($user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $password, $unique_filename) {
            $response = array('success' => false);
            $existingPhone = $this->checkExistingUsersContact($contact);
            $existingEmail = $this->checkExistingUsersEmail($email);

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = $this->conn->prepare("INSERT INTO users (user_type, firstname, middlename, lastname, suffix, birthdate, birthplace, gender, civilstatus, occupation, religion, email, contact, house_no, street_name, purok, zone, barangay, municipality, province, region, password, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertQuery->bind_param("issssssssssssssssssssss", $user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $hashedPassword, $unique_filename);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }



       public function UpdateAdminForm($user_Id, $user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $unique_filename) {
            $response = array('success' => false);
            $existingPhone = $this->checkExistingUsersContact($contact, $user_Id);
            $existingEmail = $this->checkExistingUsersEmail($email, $user_Id);

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            // Update query with all fields
            $updateQuery = $this->conn->prepare("UPDATE users SET user_type=?, firstname=?, middlename=?, lastname=?, suffix=?, birthdate=?, birthplace=?, gender=?, civilstatus=?, occupation=?, religion=?, email=?, contact=?, house_no=?, street_name=?, purok=?, zone=?, barangay=?, municipality=?, province=?, region=?, image=? WHERE user_Id = ?");
            $updateQuery->bind_param("isssssssssssssssssssssi", $user_type, $firstname, $middlename, $lastname, $suffix, $birthdate, $birthplace, $gender, $civilstatus, $occupation, $religion, $email, $contact, $house_no, $street_name, $purok, $zone, $barangay, $municipality, $province, $region, $unique_filename, $user_Id);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }



        public function getUserDepartment($user_ID){
            $query=$this->conn->prepare("SELECT * FROM user u JOIN department d ON u.dept_ID=d.dept_ID WHERE u.user_ID='$user_ID'") or die($this->conn->error);
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

// END USER FUNCTION**********************************************************





// SEMESTER FUNCTION**********************************************************
        public function existingSem($year_ID, $semester, $semester_ID = "") {
            $response = array('SemExists' => false);

            if(!empty($semester_ID)) {
                $query = $this->conn->prepare("SELECT * FROM semester WHERE year_ID = ? AND semester = ? AND semester_ID != ?");
                $query->bind_param("isi", $year_ID, $semester, $semester_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM semester WHERE year_ID = ? AND semester = ?");
                $query->bind_param("is", $year_ID, $semester);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['SemExists'] = true;
            }

            $query->close();

            return $response;
        }

        public function getSemester($semester_ID=""){
            if(!empty($semester_ID )) {
                $query=$this->conn->prepare("SELECT *, s.created_at AS date_created FROM semester s JOIN academic_year a ON s.year_ID=a.year_ID WHERE s.semester_ID = $semester_ID ORDER BY s.semester") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, s.created_at AS date_created FROM semester s JOIN academic_year a ON s.year_ID=a.year_ID ORDER BY s.semester") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        public function AddSemesterForm($year_ID, $semester) {
            $response = array('success' => false);
            $existingSem = $this->existingSem($year_ID, $semester);

            if ($existingSem['SemExists']) {
                return "Semester already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO semester (year_ID, semester) VALUES (?, ?)");
            $insertQuery->bind_param("is", $year_ID, $semester);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }

        public function UpdateSemForm($semester_ID, $year_ID, $semester, $status) {
            $response = array('success' => false);
            $existingSem = $this->existingSem($year_ID, $semester, $semester_ID);

            if ($existingSem['SemExists']) {
                return "Semester already exists";
            }

            if($status == 1) {
                $query=$this->conn->prepare("SELECT * FROM semester WHERE sem_status=1 AND semester_ID != ?") or die($this->conn->error);
                $query->bind_param("i", $semester_ID);
                $query->execute();
                $result = $query->get_result();

                if($result->num_rows > 0) {
                    return "An active semester already exists";
                } else {
                    $updateQuery = $this->conn->prepare("UPDATE semester SET year_ID = ?, semester = ?, sem_status = ? WHERE semester_ID = ?");
                    $updateQuery->bind_param("isii", $year_ID, $semester, $status, $semester_ID);

                    if ($updateQuery->execute()) {
                        $updateQuery->close();
                        $this->conn->close();
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                $updateQuery = $this->conn->prepare("UPDATE semester SET year_ID = ?, semester = ?, sem_status = ? WHERE semester_ID = ?");
                $updateQuery->bind_param("isii", $year_ID, $semester, $status, $semester_ID);

                if ($updateQuery->execute()) {
                    $updateQuery->close();
                    $this->conn->close();
                    return true;
                } else {
                    return false;
                }
            }
        }
    
// SEMESTER FUNCTION**********************************************************
  



// SUBJECT FUNCTION**********************************************************
        public function checkExistingSubject($course_ID, $descriptive_title, $sub_ID = "") {
            $response = array('subjectExists' => false);

            if(!empty($sub_ID)) {
                $query = $this->conn->prepare("SELECT * FROM subject WHERE course_ID = ? AND descriptive_title = ? AND sub_ID != ?");
                $query->bind_param("isi", $course_ID, $year_to, $sub_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM subject WHERE course_ID = ? AND descriptive_title = ?");
                $query->bind_param("is", $course_ID, $descriptive_title);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['subjectExists'] = true;
            }

            $query->close();

            return $response;
        }

        public function getSubject($sub_ID = ""){
            if(!empty($sub_ID)) {
                $query=$this->conn->prepare("SELECT *, sub.created_at AS date_created FROM subject sub JOIN semester sem ON sub.semester_ID=sem.semester_ID JOIN academic_year a ON sem.year_ID=a.year_ID JOIN course c ON sub.course_ID=c.course_ID JOIN level l ON sub.level_ID=l.level_ID JOIN instructor i ON sub.instructor_ID=i.instructor_ID WHERE sub.sub_ID = $sub_ID") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, sub.created_at AS date_created FROM subject sub JOIN semester sem ON sub.semester_ID=sem.semester_ID JOIN academic_year a ON sem.year_ID=a.year_ID JOIN course c ON sub.course_ID=c.course_ID JOIN level l ON sub.level_ID=l.level_ID JOIN instructor i ON sub.instructor_ID=i.instructor_ID") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        public function AddSubjectForm($semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID) {
            $response = array('success' => false);
            $existingSub = $this->checkExistingSubject($course_ID, $descriptive_title);

            if ($existingSub['subjectExists']) {
                return "Subject already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO subject (semester_ID, course_ID, level_ID, sub_no, descriptive_title, units, offer_code, instructor_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insertQuery->bind_param("iiisssss", $semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }

        
        public function UpdateSubjectForm($sub_ID, $semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID) {
            $response = array('success' => false);
            $existingSub = $this->checkExistingSubject($course_ID, $descriptive_title, $sub_ID);

            if ($existingSub['subjectExists']) {
                return "Subject already exists";
            }

            $updateQuery = $this->conn->prepare("UPDATE subject SET semester_ID = ?, course_ID = ?, level_ID = ?, sub_no = ?, descriptive_title = ?, units = ?, offer_code = ?, instructor_ID = ? WHERE sub_ID = ?");
            $updateQuery->bind_param("iiissssii", $semester_ID, $course_ID, $level_ID, $sub_no, $descriptive_title, $units, $offer_code, $instructor_ID, $sub_ID);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }
// SUBJECT FUNCTION**********************************************************



// ACADEMIC YEAR FUNCTION**********************************************************
        public function checkExistingYear($year_from, $year_to, $year_ID = "") {
            $response = array('yearExists' => false);

            if(!empty($year_ID)) {
                $query = $this->conn->prepare("SELECT * FROM academic_year WHERE year_from = ? AND year_to = ? AND year_ID != ?");
                $query->bind_param("iii", $year_from, $year_to, $year_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM academic_year WHERE year_from = ? AND year_to = ?");
                $query->bind_param("ii", $year_from, $year_to);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['yearExists'] = true;
            }

            $query->close();

            return $response;
        }



        public function getActiveAcadYear(){
            $query=$this->conn->prepare("SELECT * FROM academic_year WHERE status=1") or die($this->conn->error);
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }




        public function getAcadYear($year_ID = ""){
            if(!empty($year_ID)) {
                $query=$this->conn->prepare("SELECT * FROM academic_year WHERE year_ID = $year_ID") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT * FROM academic_year") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }


        public function AddAcadForm($year_from, $year_to) {
            $response = array('success' => false);
            $existingYear = $this->checkExistingYear($year_from, $year_to);

            if ($existingYear['yearExists']) {
                return "Academic year already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO academic_year (year_from, year_to) VALUES (?, ?)");
            $insertQuery->bind_param("ii", $year_from, $year_to);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }


        public function UpdateAcadForm($year_ID, $year_from, $year_to, $status) {
            $response = array('success' => false);
            $existingYear = $this->checkExistingYear($year_from, $year_to, $year_ID);

            if ($existingYear['yearExists']) {
                return "Academic year already exists";
            }

            if($status == 1) {
                $query=$this->conn->prepare("SELECT * FROM academic_year WHERE status=1 AND year_ID != ?") or die($this->conn->error);
                $query->bind_param("i", $year_ID);
                $query->execute();
                $result = $query->get_result();

                if($result->num_rows > 0) {
                    return "An active academic year already exists";
                } else {
                    $updateQuery = $this->conn->prepare("UPDATE academic_year SET year_from = ?, year_to = ?, status = ? WHERE year_ID = ?");
                    $updateQuery->bind_param("iiii", $year_from, $year_to, $status, $year_ID);

                    if ($updateQuery->execute()) {
                        $updateQuery->close();
                        $this->conn->close();
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                $updateQuery = $this->conn->prepare("UPDATE academic_year SET year_from = ?, year_to = ?, status = ? WHERE year_ID = ?");
                $updateQuery->bind_param("iiii", $year_from, $year_to, $status, $year_ID);

                if ($updateQuery->execute()) {
                    $updateQuery->close();
                    $this->conn->close();
                    return true;
                } else {
                    return false;
                }
            }
        }
// END ACADEMIC YEAR FUNCTION**********************************************************




// COURSE FUNCTION**********************************************************
        public function checkExistingCourse($dept_ID, $course_name, $course_ID = "") {
            $response = array('Exists' => false);

            if(!empty($course_ID)) {
                $query = $this->conn->prepare("SELECT * FROM course WHERE dept_ID = ? AND course_name = ? AND course_ID != ?");
                $query->bind_param("isi", $dept_ID, $course_name, $course_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM course WHERE dept_ID = ? AND course_name = ?");
                $query->bind_param("is", $dept_ID, $course_name);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['Exists'] = true;
            }

            $query->close();

            return $response;
        }

        public function getCourse($course_ID = ""){
            if(!empty($course_ID)) {
                $query=$this->conn->prepare("SELECT *, c.created_at AS date_created FROM course c JOIN department d ON c.dept_ID=d.dept_ID WHERE course_ID = $course_ID") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, c.created_at AS date_created FROM course c JOIN department d ON c.dept_ID=d.dept_ID") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        public function AddCourseForm($dept_ID, $course_name, $course_desc) {
            $response = array('success' => false);
            $existingCourse = $this->checkExistingCourse($dept_ID, $course_name);

            if ($existingCourse['Exists']) {
                return "Course already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO course (dept_ID, course_name, course_desc) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iss", $dept_ID, $course_name, $course_desc);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }


        public function UpdateCourseForm($course_ID, $dept_ID, $course_name, $course_desc) {
            $response = array('success' => false);
            $existingCourse = $this->checkExistingCourse($dept_ID, $course_name, $course_ID);

            if ($existingCourse['Exists']) {
                return "Course already exists";
            }

            $updateQuery = $this->conn->prepare("UPDATE course SET dept_ID = ?, course_name = ?, course_desc = ? WHERE course_ID = ?");
            $updateQuery->bind_param("issi", $dept_ID, $course_name, $course_desc, $course_ID);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }
// END COURSE FUNCTION**********************************************************




// DEPARTMENT FUNCTION**********************************************************
        public function getDepartment($dept_ID = ""){
            if(!empty($dept_ID)) {
                $query=$this->conn->prepare("SELECT *, d.created_at AS date_created FROM department d JOIN academic_year a ON d.year_ID=a.year_ID WHERE d.dept_ID = $dept_ID ORDER BY d.dept_name") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, d.created_at AS date_created FROM department d JOIN academic_year a ON d.year_ID=a.year_ID ORDER BY d.dept_name") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }


        public function checkExistingDepartment($year_ID, $dept_name, $dept_ID = "") {
            $response = array('Exists' => false);

            if(!empty($dept_ID)) {
                $query = $this->conn->prepare("SELECT * FROM department WHERE year_ID = ? AND dept_name = ? AND dept_ID != ?");
                $query->bind_param("isi", $year_ID, $dept_name, $dept_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM department WHERE year_ID = ? AND dept_name = ?");
                $query->bind_param("is", $year_ID, $dept_name);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['Exists'] = true;
            }

            $query->close();

            return $response;
        }


        public function AddDepartmentForm($year_ID, $dept_name, $motto) {
            $response = array('success' => false);
            $existing = $this->checkExistingDepartment($year_ID, $dept_name);

            if ($existing['Exists']) {
                return "Department already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO department (year_ID, dept_name, motto) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iss", $year_ID, $dept_name, $motto);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }


        public function UpdateDepartmentForm($dept_ID, $year_ID, $dept_name, $motto) {
            $response = array('success' => false);
            $existing = $this->checkExistingDepartment($year_ID, $dept_name, $dept_ID);

            if ($existing['Exists']) {
                return "Department already exists";
            }

            $updateQuery = $this->conn->prepare("UPDATE department SET year_ID = ?, dept_name = ?, motto = ? WHERE dept_ID = ?");
            $updateQuery->bind_param("issi", $year_ID, $dept_name, $motto, $dept_ID);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }
// END DEPARTMENT FUNCTION**********************************************************




// YEAR LEVEL FUNCTION**********************************************************
        public function getLevel($level_ID  = ""){
            if(!empty($level_ID )) {
                $query=$this->conn->prepare("SELECT * FROM level WHERE level_ID = $level_ID ORDER BY level") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT * FROM level ORDER BY level") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        public function checkExistingLevel($level, $level_ID = "") {
            $response = array('Exists' => false);

            if(!empty($level_ID)) {
                $query = $this->conn->prepare("SELECT * FROM level WHERE level = ? AND level_ID != ?");
                $query->bind_param("si", $level, $level_ID);
            } else {
                $query = $this->conn->prepare("SELECT * FROM level WHERE level = ?");
                $query->bind_param("s", $level);
            }

            $query->execute();
            $resultYear = $query->get_result();

            if ($resultYear->num_rows > 0) {
                $response['Exists'] = true;
            }

            $query->close();

            return $response;
        }

        public function AddLevelForm($level) {
            $response = array('success' => false);
            $existing = $this->checkExistingLevel($level);

            if ($existing['Exists']) {
                return "Year level already exists";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO level (level) VALUES (?)");
            $insertQuery->bind_param("s", $level);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }   

        public function UpdateLevelForm($level_ID, $level) {
            $response = array('success' => false);
            $existing = $this->checkExistingLevel($level, $level_ID);

            if ($existing['Exists']) {
                return "Year level already exists";
            }

            $updateQuery = $this->conn->prepare("UPDATE level SET level = ? WHERE level_ID = ?");
            $updateQuery->bind_param("si", $level, $level_ID);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }
// END YEAR LEVEL FUNCTION**********************************************************




// INSTRUCTOR FUNCTION**********************************************************
        public function checkExistingContact($contact, $instructor_ID = "") {

            if (!empty($instructor_ID)) {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM instructor WHERE instructor_ID != ? 
                        UNION 
                        SELECT contact AS contact FROM users 
                        UNION 
                        SELECT contact AS contact FROM students
                    ) AS all_contacts WHERE contact = ?");
                $queryContact->bind_param("is", $instructor_ID, $contact);
            } else {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM instructor 
                        UNION 
                        SELECT contact FROM users 
                        UNION 
                        SELECT contact FROM students
                    ) AS all_contacts WHERE contact = ?");
                $queryContact->bind_param("s", $contact);
            }

            $queryContact->execute();
            $resultContact = $queryContact->get_result();

            $response = array('contactExists' => false);

            if ($resultContact->num_rows > 0) {
                $response['contactExists'] = true;
            }

            $queryContact->close();

            return $response;
        }
        

        public function checkExistingEmail($email, $instructor_ID = "") {

            if (!empty($instructor_ID)) {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM instructor WHERE instructor_ID != ? 
                        UNION 
                        SELECT email FROM users 
                        UNION 
                        SELECT email FROM students
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("is", $instructor_ID, $email);
            } else {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM instructor 
                        UNION 
                        SELECT email FROM users 
                        UNION 
                        SELECT email FROM students
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("s", $email);
            }

            $queryEmail->execute();
            $resultEmail = $queryEmail->get_result();

            $response = array('emailExists' => false);

            if ($resultEmail->num_rows > 0) {
                $response['emailExists'] = true;
            }

            $queryEmail->close();

            return $response;
        }



        public function checkExistingEmp_ID($emp_ID, $instructor_ID = "") {

            if(!empty($instructor_ID)) {
                $queryEmail = $this->conn->prepare("SELECT * FROM instructor WHERE emp_ID = ? AND instructor_ID != ?");
                $queryEmail->bind_param("si", $emp_ID, $instructor_ID);
            } else {
                $queryEmail = $this->conn->prepare("SELECT * FROM instructor WHERE emp_ID = ?");
                $queryEmail->bind_param("s", $emp_ID);
            }

            
            $queryEmail->execute();
            $resultEmail = $queryEmail->get_result();
            
            $response = array('emp_IDExists' => false);

            if ($resultEmail->num_rows > 0) {
                $response['emp_IDExists'] = true;
            }

            $queryEmail->close();

            return $response;
        }


        public function getInstructor($instructor_ID  = ""){
            if(!empty($instructor_ID )) {
                $query=$this->conn->prepare("SELECT *, i.created_at AS date_created FROM instructor i JOIN academic_year a ON i.year_ID=a.year_ID JOIN department d ON i.dept_ID=d.dept_ID WHERE instructor_ID = $instructor_ID ") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, i.created_at AS date_created FROM instructor i JOIN academic_year a ON i.year_ID=a.year_ID JOIN department d ON i.dept_ID=d.dept_ID") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }


        public function getAssignedSubjects($instructor_ID){
            $query=$this->conn->prepare("SELECT *, sub.created_at AS date_created FROM subject sub JOIN semester sem ON sub.semester_ID=sem.semester_ID JOIN academic_year a ON sem.year_ID=a.year_ID JOIN course c ON sub.course_ID=c.course_ID JOIN level l ON sub.level_ID=l.level_ID JOIN instructor i ON sub.instructor_ID=i.instructor_ID WHERE i.instructor_ID = $instructor_ID") or die($this->conn->error);
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }

        

        public function AddInstructorForm($year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename, $password) {

            $response = array('success' => false);
            $existingPhone = $this->checkExistingContact($contact);
            $existingEmail = $this->checkExistingEmail($email);
            $existingEmp_ID = $this->checkExistingEmp_ID($emp_ID);

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            if ($existingEmp_ID['emp_IDExists']) {
                return "Employee ID already exists";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = $this->conn->prepare("INSERT INTO instructor (year_ID, firstname, middlename, lastname, suffix, gender, birthdate, contact, email, address, emp_ID, dept_ID, position, emp_status, hired_date, contract_end, degrees_held, major_study, image, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertQuery->bind_param("isssssssssiissssssss", $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename, $hashedPassword);

            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }


        public function UpdateInstructorForm($instructor_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename) {

            $response = array('success' => false);
            $existingPhone = $this->checkExistingContact($contact, $instructor_ID);
            $existingEmail = $this->checkExistingEmail($email, $instructor_ID);
            $existingEmp_ID = $this->checkExistingEmp_ID($emp_ID, $instructor_ID);

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            if ($existingEmp_ID['emp_IDExists']) {
                return "Employee ID already exists";
            }

            // Update query with all fields
            $updateQuery = $this->conn->prepare("UPDATE instructor SET year_ID = ?, firstname = ?, middlename = ?, lastname = ?, suffix = ?, gender = ?, birthdate = ?, contact = ?, email = ?, address = ?, emp_ID = ?, dept_ID = ?, position = ?, emp_status = ?, hired_date = ?, contract_end = ?, degrees_held = ?, major_study = ?, image = ? WHERE instructor_ID = ?");
            $updateQuery->bind_param("isssssssssiisssssssi", $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $contact, $email, $address, $emp_ID, $dept_ID, $position, $emp_status, $hired_date, $contract_end, $degrees_held, $major_study, $unique_filename, $instructor_ID);

            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                return false;
            }
        }
// END INSTRUCTOR FUNCTION**********************************************************



// STUDENTS FUNCTION**********************************************************
        public function checkExistingStudent_ID($student_ID, $stud_ID = "") {

            if (!empty($stud_ID)) {
                $queryStud_ID = $this->conn->prepare("SELECT * FROM students WHERE student_ID = ? AND stud_ID != ?");
                $queryStud_ID->bind_param("si", $student_ID, $stud_ID);
            } else {
                $queryStud_ID = $this->conn->prepare("SELECT * FROM students WHERE student_ID = ?");
                $queryStud_ID->bind_param("s", $student_ID);
            }

            $queryStud_ID->execute();
            $resultContact = $queryStud_ID->get_result();

            $response = array('stud_IDExists' => false);

            if ($resultContact->num_rows > 0) {
                $response['stud_IDExists'] = true;
            }

            $queryStud_ID->close();

            return $response;
        }
        

        public function checkExistingStudentEmail($email, $stud_ID = "") {

            if (!empty($stud_ID)) {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM students WHERE stud_ID != ? 
                        UNION 
                        SELECT email FROM instructor 
                        UNION 
                        SELECT email FROM users
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("is", $stud_ID, $email);
            } else {
                $queryEmail = $this->conn->prepare("SELECT * FROM (
                        SELECT email FROM students 
                        UNION 
                        SELECT email FROM instructor 
                        UNION 
                        SELECT email FROM users
                    ) AS all_emails WHERE email = ?");
                $queryEmail->bind_param("s", $email);
            }

            $queryEmail->execute();
            $resultEmail = $queryEmail->get_result();

            $response = array('emailExists' => false);

            if ($resultEmail->num_rows > 0) {
                $response['emailExists'] = true;
            }

            $queryEmail->close();

            return $response;
        }


        public function checkExistingStudentContact($contact, $stud_ID = "") {

            if (!empty($stud_ID)) {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM students WHERE stud_ID != ? 
                        UNION 
                        SELECT contact FROM instructor 
                        UNION 
                        SELECT contact FROM users
                    ) AS all_emails WHERE contact = ?");
                $queryContact->bind_param("is", $stud_ID, $contact);
            } else {
                $queryContact = $this->conn->prepare("SELECT * FROM (
                        SELECT contact FROM students 
                        UNION 
                        SELECT contact FROM instructor 
                        UNION 
                        SELECT contact FROM users
                    ) AS all_contact WHERE contact = ?");
                $queryContact->bind_param("s", $contact);
            }

            $queryContact->execute();
            $resultContact = $queryContact->get_result();

            $response = array('contactExists' => false);

            if ($resultContact->num_rows > 0) {
                $response['contactExists'] = true;
            }

            $queryContact->close();

            return $response;
        }


        public function getStudents($stud_ID = ""){
            if(!empty($stud_ID )) {
                $query=$this->conn->prepare("SELECT *, s.created_at AS date_created FROM students s JOIN academic_year a ON s.year_ID=a.year_ID JOIN course c ON s.course_ID=c.course_ID JOIN level l ON s.year_level_ID=l.level_ID JOIN department d ON c.dept_ID=d.dept_ID WHERE s.stud_ID = $stud_ID ") or die($this->conn->error);
            } else {
                $query=$this->conn->prepare("SELECT *, s.created_at AS date_created FROM students s JOIN academic_year a ON s.year_ID=a.year_ID JOIN course c ON s.course_ID=c.course_ID JOIN level l ON s.year_level_ID=l.level_ID JOIN department d ON c.dept_ID=d.dept_ID") or die($this->conn->error);
            }
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }


        public function AddStudentForm($stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $password, $uploaded_files) {

            $response = array('success' => false);

            // Check for existing student ID, email, and contact
            $existingStud_ID = $this->checkExistingStudent_ID($student_ID);
            $existingEmail = $this->checkExistingStudentEmail($email);
            $existingPhone = $this->checkExistingStudentContact($contact);

            if ($existingStud_ID['stud_IDExists']) {
                return "Student ID already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Implode uploaded files array with commas
            $documents = implode(',', $uploaded_files);

            $default_img = "user.jpg";

            // Prepare the SQL statement for inserting student data
            $insertQuery = $this->conn->prepare("INSERT INTO students (stud_type, student_ID, year_ID, firstname, middlename, lastname, suffix, gender, birthdate, address, citizenship, contact, email, GWA, year_level_ID, course_ID, school_name, school_address, emergency_contact_name, relationship_to_student, emergency_contact, parent_name, parent_relationship, parent_contact, password, image, documents) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind parameters for the SQL statement
            $insertQuery->bind_param("ssisssssssssssiisssssssssss", $stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $hashedPassword, $default_img, $documents);

            // Execute the SQL statement
            if ($insertQuery->execute()) {
                $insertQuery->close();
                $this->conn->close();
                return true;
            } else {
                $insertQuery->close();
                return false;
            }
        }



        public function UpdateStudentForm($stud_ID, $stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $uploaded_files) {

            $response = array('success' => false);

            // Check for existing student ID, email, and contact
            $existingStud_ID = $this->checkExistingStudent_ID($student_ID, $stud_ID);
            $existingEmail = $this->checkExistingStudentEmail($email, $stud_ID);
            $existingPhone = $this->checkExistingStudentContact($contact, $stud_ID);

            if ($existingStud_ID['stud_IDExists']) {
                return "Student ID already exists";
            }

            if ($existingEmail['emailExists']) {
                return "Email address already exists";
            }

            if ($existingPhone['contactExists']) {
                return "Contact number already exists";
            }

            // Implode uploaded files array with commas
            // $documents = implode(',', $uploaded_files);

            // Prepare the SQL statement for updating student data
            $updateQuery = $this->conn->prepare("UPDATE students SET stud_type = ?, student_ID = ?, year_ID = ?, firstname = ?, middlename = ?, lastname = ?, suffix = ?, gender = ?, birthdate = ?, address = ?, citizenship = ?, contact = ?, email = ?, GWA = ?, year_level_ID = ?, course_ID = ?, school_name = ?, school_address = ?, emergency_contact_name = ?, relationship_to_student = ?, emergency_contact = ?, parent_name = ?, parent_relationship = ?, parent_contact = ?, documents = ? WHERE stud_ID = ?");

            // Bind parameters for the SQL statement
            $updateQuery->bind_param("ssisssssssssssiisssssssssi", $stud_type, $student_ID, $year_ID, $firstname, $middlename, $lastname, $suffix, $gender, $birthdate, $address, $citizenship, $contact, $email, $GWA, $year_level_ID, $course_ID, $school_name, $school_address, $emergency_contact_name, $relationship_to_student, $emergency_contact, $parent_name, $parent_relationship, $parent_contact, $uploaded_files, $stud_ID);

            // Execute the SQL statement
            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                $updateQuery->close();
                return false;
            }
        }



        public function VerifyStudentForm($stud_ID) {
            $response = array('success' => false);
            $updateQuery = $this->conn->prepare("UPDATE students SET student_status = 1 WHERE stud_ID = ?");
            $updateQuery->bind_param("i", $stud_ID);
            if ($updateQuery->execute()) {
                $updateQuery->close();
                $this->conn->close();
                return true;
            } else {
                $updateQuery->close();
                return false;
            }
        }


        

// END STUDENTS FUNCTION**********************************************************




// ENROLLMENT FUNCTION**********************************************************
        public function getEnrolledStudents() {
            $query=$this->conn->prepare("SELECT *, s.created_at AS date_created FROM enrollment e JOIN students s ON e.stud_ID=s.stud_ID JOIN semester sem ON e.semester_ID=sem.semester_ID JOIN academic_year a ON sem.year_ID=a.year_ID JOIN course c ON e.course_ID=c.course_ID JOIN department d ON c.dept_ID=d.dept_ID JOIN level l ON s.year_level_ID=l.level_ID WHERE a.status=1") or die($this->conn->error);
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }




        public function checkExistingEnrolled($semester_ID, $course_ID, $stud_ID) {

            $queryStud_ID = $this->conn->prepare("SELECT * FROM enrollment WHERE semester_ID = ? AND course_ID = ? AND stud_ID = ?");
            $queryStud_ID->bind_param("iii", $semester_ID, $course_ID, $stud_ID);

            $queryStud_ID->execute();
            $resultContact = $queryStud_ID->get_result();

            $response = array('existingEnrollment' => false);

            if ($resultContact->num_rows > 0) {
                $response['existingEnrollment'] = true;
            }

            $queryStud_ID->close();

            return $response;
        }

        


        public function getActiveSemester() {
            $query=$this->conn->prepare("SELECT * FROM semester s JOIN academic_year a ON s.year_ID=a.year_ID WHERE s.sem_status=1") or die($this->conn->error);
            if($query->execute()){
                $result=$query->get_result();
                return $result;  
            }
        }


        public function getStudentsCourse($course_ID){
            $query = $this->conn->prepare("SELECT * FROM students WHERE course_ID = ? AND is_enrolled = 0");
            $query->bind_param("i", $course_ID);

            if($query->execute()){
                $result = $query->get_result();
                if($result->num_rows > 0) {
                    return $result;
                } else {
                    return false; // No students found for the specified course
                }
            } else {
                error_log("Error executing SQL query: " . $query->error);
                return false; // Return false if query execution fails
            }
        }



        // public function enrollStudentForm($semester_ID, $course_ID, $stud_ID) {
        //     $response = array('success' => false);
        //     $existingSub = $this->checkExistingEnrolled($semester_ID, $course_ID, $stud_ID);

        //     if ($existingSub['existingEnrollment']) {
        //         return "Student already enrolled";
        //     }

        //     $insertQuery = $this->conn->prepare("INSERT INTO enrollment (semester_ID, course_ID, stud_ID) VALUES (?, ?, ?)");
        //     $insertQuery->bind_param("iii", $semester_ID, $course_ID, $stud_ID);

        //     if ($insertQuery->execute()) {
        //         $insertQuery->close();
        //         $this->conn->close();
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
        public function enrollStudentForm($semester_ID, $course_ID, $stud_ID) {
            $response = array('success' => false);
            $existingSub = $this->checkExistingEnrolled($semester_ID, $course_ID, $stud_ID);

            if ($existingSub['existingEnrollment']) {
                return "Student already enrolled";
            }

            $insertQuery = $this->conn->prepare("INSERT INTO enrollment (semester_ID, course_ID, stud_ID) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iii", $semester_ID, $course_ID, $stud_ID);

            if ($insertQuery->execute()) {
                $insertQuery->close();

                // Update students table to mark the student as enrolled
                $updateQuery = $this->conn->prepare("UPDATE students SET is_enrolled = 1 WHERE stud_ID = ?");
                $updateQuery->bind_param("i", $stud_ID);
                $updateSuccess = $updateQuery->execute();
                $updateQuery->close();

                if ($updateSuccess) {
                    $this->conn->close();
                    return true;
                } else {
                    // Handle the case where the update failed
                    // You might want to log the error or handle it differently
                    return false;
                }
            } else {
                return false;
            }
        }


        



        
// END ENROLLMENT FUNCTION**********************************************************


// CONTACT EMAIL MESSAGING**********************************************************
        public function sendEmail($subject, $message, $recipientEmail) {
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'tatakmedellin@gmail.com';
                $mail->Password = 'nzctaagwhqlcgbqq';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Send Email
                $mail->setFrom('tatakmedellin@gmail.com', 'St.Paul Colleges Foundation Inc.');

                // Recipients
                $mail->addAddress($recipientEmail);
                $mail->addReplyTo('tatakmedellin@gmail.com');

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();

            } catch (Exception $e) {
                $mail->ErrorInfo;
            }
        }
// END CONTACT EMAIL MESSAGING**********************************************************
       


// ENROLLED SUBJECTS FUNCTION**********************************************************
        
        public function getEnrolledSubjects($id) {
            $get_stud = $this->getStudents($id);
            $row = $get_stud->fetch_assoc();
            $course = $row['course_ID'];
            $level = $row['year_level_ID'];

            $query=$this->conn->prepare("SELECT *, sub.created_at AS date_created FROM subject sub JOIN semester sem ON sub.semester_ID=sem.semester_ID JOIN academic_year a ON sem.year_ID=a.year_ID JOIN course c ON sub.course_ID=c.course_ID JOIN level l ON sub.level_ID=l.level_ID JOIN instructor i ON sub.instructor_ID=i.instructor_ID WHERE sub.course_ID = ? AND sub.level_ID = ?") or die($this->conn->error);
            // $query = $this->conn->prepare("SELECT * FROM subject WHERE course_ID = ? AND level_ID = ?");
            $query->bind_param("ii", $course, $level);

            if($query->execute()){
                $result = $query->get_result();
                if($result->num_rows > 0) {
                    return $result;
                } else {
                    return false; // No students found for the specified course
                }
            } else {
                error_log("Error executing SQL query: " . $query->error);
                return false; // Return false if query execution fails
            }
        }
// END ENROLLED SUBJECTS FUNCTION**********************************************************

        public function uploadPaymentForm($stud_ID, $uploaded_files) {
    $response = array('success' => false);

    // Implode uploaded files array with commas
    $documents = implode(',', $uploaded_files);

    

    // Prepare and execute the update query
    $updateQuery = $this->conn->prepare("UPDATE students SET payment = ? WHERE stud_ID = ?");
    $updateQuery->bind_param("si", $documents, $stud_ID);

    if ($updateQuery->execute()) {
        $updateQuery->close();
        $this->conn->close();
        return true;
    } else {
        $updateQuery->close();
        return false;
    }
}

        

// FUNCTION TO DELETE RECORDS**********************************************************
        public function DeleteRecordForm($table, $idColumn, $idValue, $audit_ID="") {
            $query = $this->conn->prepare("DELETE FROM $table WHERE $idColumn = ?");
            $query->bind_param("i", $idValue);

            if ($query->execute()) {
                $query->close();
                return true;
            } else {
                // Log error message and SQL query execution error
                error_log("Error deleting record: " . $query->error);
                return false;
            }
        }
// END FUNCTION TO DELETE RECORDS**********************************************************
        
    }
?>