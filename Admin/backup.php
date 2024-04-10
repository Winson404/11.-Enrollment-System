<title>Concern and Complaint Reporting System | Database Backup</title>
<?php 

require_once 'sidebar.php';

$tables = [];
$result = mysqli_query($conn, "SHOW TABLES");

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$return = '';

foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT * FROM " . $table);
    $num_fields = mysqli_num_fields($result);

    $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
    $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE " . $table));
    $return .= "\n\n" . $row2[1] . ";\n\n";

    while ($row = mysqli_fetch_row($result)) {
        $return .= "INSERT INTO " . $table . " VALUES(";

        for ($j = 0; $j < $num_fields; $j++) {
            // Check for null values before applying addslashes
            if ($row[$j] !== null) {
                $row[$j] = addslashes($row[$j]);
            }
            $return .= '"' . $row[$j] . '"';
            if ($j < $num_fields - 1) {
                $return .= ',';
            }
        }

        $return .= ");\n";
    }

    $return .= "\n\n\n";
}

// Save file inside the "database" folder
$backupFileName = '../database/backup_' . date("Y-m-d_H-i-s") . '.sql';
$backupFilePath = __DIR__ . '/' . $backupFileName;

$handle = fopen($backupFilePath, "w+");

if ($handle === false) {
    die("Unable to open file for writing.");
}

fwrite($handle, $return);
fclose($handle);

$_SESSION['message'] = "Backup stored in the database folder successfully.";
$_SESSION['text'] = "Saved successfully!";
$_SESSION['status'] = "success";
echo '<meta http-equiv="refresh" content="5;url=dashboard.php">';
?>
<style>
    body {
        background-color: #f4f4f4;
    }

    .content {
        padding: 20px;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
    }

    .card-body {
        text-align: center;
    }

    img {
        max-width: 100%;
        height: auto;
    }
</style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Database Backup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Database Backup</li>
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
                            <div class="card-tools mr-1">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="../images/db.gif" alt="Database Backup Status">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'announcement_add.php'; require_once '../includes/footer.php'; ?>


<script>
    // JavaScript code to redirect after 3 seconds
    setTimeout(function () {
        window.location.href = 'dashboard.php';
    }, 3000);
</script>