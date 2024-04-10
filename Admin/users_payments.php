<title>Enrollment System | Manage Student</title>
<?php 
    require_once 'sidebar.php'; 
    if(isset($_GET['stud_ID'])) {
      $stud_ID = $_GET['stud_ID'];
      $students = $db->getStudents($stud_ID);
      $row2 = $students->fetch_assoc();
      $documents = $row2['payment'];
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student payments</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <form id="VerifyStudentForm" method="POST" enctype="multipart/form-data">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title"><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?>'s payment receipt</h3>
            <div class="card-tools mt-2">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
              <input type="hidden" class="form-control" name="stud_ID" id="stud_ID" value="<?= $stud_ID ?>" required>
              
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <?php
                      // Split the documents string into an array of filenames
                      $document_files = explode(',', $documents);
                      // Iterate through each filename
                      foreach ($document_files as $index => $filename) {
                          // Generate the path to the image
                          $image_path = '../Receipt/' . $filename;
                          ?>
                          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                              <img src="<?= $image_path ?>" class="d-block w-100" alt="Document Image">
                          </div>
                      <?php } ?>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
              </div>
          </div>

          <div class="card-footer d-flex justify-content-end">
            <a href="users.php" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-times"></i> Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_button" <?php if($row2['student_status'] == 1) { echo 'disabled'; } ?>><i class="fas fa-check"></i> Verify</button>
          </div>
        </div>
      </form>
    </div>
  </section>
<?php } else { require_once '../includes/404.php'; } ?>
<br>
<br>
<br>
<?php require_once '../includes/footer.php'; ?>
<script>
  $(document).ready(function() {

    // Add event listener to form submission
    $('#VerifyStudentForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'VerifyStudentForm');

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = "users.php";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        timer: 1500,
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
