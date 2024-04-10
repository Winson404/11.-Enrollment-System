<title>Enrollment System | Payment records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payment records</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header p-2">
                <button class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#addModal"><i class="fa-sharp fa-solid fa-square-plus"></i> Upload payment receipt</button>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <?php
                      $documents = $row['payment'];
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
            </div>
          </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="uploadPaymentForm" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header bg-light">
                  <h5 class="modal-title" id="exampleModalLabel">Upload payment receipt</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                  </button>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" class="form-control" name="stud_ID" id="stud_ID" value="<?= $id ?>" required>

                <div class="form-group">
                  <span class="text-dark"><b>Upload payment reciept</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="receipt" name="receipt[]" multiple required>
                      <label class="custom-file-label" for="receipt">Choose file</label>
                    </div>
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Confirm</button>
                </div>
              </div>
            </form>
          </div>
        </div>

       
      </div>
    </section>

<?php require_once '../includes/footer.php'; ?>

<script>
$(document).ready(function() {

    // Add event listener to form submission
    $('#uploadPaymentForm').submit(function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData($(this)[0]);

        // Add action parameter
        formData.append('action', 'uploadPaymentForm');

        $.ajax({
            type: 'POST',
            url: '../includes/processes.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: true
                    }).then(function() {
                        // Redirect to profile.php after success
                        window.location.href = "payment.php";
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
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