<title>Enrollment System | Database Restoration</title>
<?php 
  require_once 'sidebar.php';
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Database Restoration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Database Restoration</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <form action="process_save.php" method="post" enctype="multipart/form-data">
              <div class="card">
                <div class="card-body">
                  <label>Restore database file</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToRestore" accept=".sql" required>
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary d-block m-auto" name="restore">Restore Database</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php require_once 'announcement_add.php'; require_once '../includes/footer.php'; ?>
