<title>Enrollment System | Log History records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Log History</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Log History records</li>
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
            <!-- <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div> -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>SYSTEM USER</th>
                    <th>USERTYPE</th>
                    <th>DATE AND TIME LOGGED IN</th>
                    <th>DATE AND TIME LOGGED OUT</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM log_history JOIN users ON log_history.user_Id=users.user_Id ORDER BY log_Id DESC");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?= $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'] ?></td>
                    <td><?= $row['user_type'] ?></td>
                    <td><?= date("F d, Y h:i:s A", strtotime($row['login_datetime'])) ?></td>
                    <td>
                        <?php
                        if ($row['logout_datetime'] == '0000-00-00 00:00:00' && $row['logout_remarks'] == 1) {
                            echo '<span class="badge badge-warning">Unable to logout last login</span>';
                        } else {
                            // echo $row['logout_datetime'] != '0000-00-00 00:00:00' ? $row['logout_datetime'] : '<span class="badge badge-success">On-going session</span>';
                            // DISPLAY F D, Y FORMAT
                            echo $row['logout_datetime'] != '0000-00-00 00:00:00' ? date("F d, Y h:i:s A", strtotime($row['logout_datetime'])) : '<span class="badge badge-success">On-going session</span>';
                        }
                        ?>
                    </td>

                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>