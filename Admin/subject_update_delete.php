

<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['sub_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-book"></i> Update subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['sub_Id']; ?>" name="sub_Id">
        <div class="row">
          <div class="col-lg-12">
              <div class="form-group">
                <label>Subject code</label>
                <input type="text" class="form-control form-control-sm"  placeholder="Subject code" name="code" value="<?php echo $row['sub_code']; ?>" required>
              </div>
          </div>
        </div>
        <div class="row">         
          <div class="col-lg-12">
            <div class="form-group">
                <label>Subject name</label>
                <input type="text" class="form-control form-control-sm"  placeholder="Subject name" name="subjectname" value="<?php echo $row['sub_name']; ?>" required>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Instructor</label>
              <?php                           
                  $teacher  = mysqli_query($conn, "SELECT * FROM teacher");
                  $id = $row['sub_teacher_Id'];
                  $all_teacher = mysqli_query($conn, "SELECT * FROM subject where sub_teacher_Id = '$id' ");
                  $row_teacher = mysqli_fetch_array($all_teacher);
              ?>
              <select class="custom-select custom-select-sm" name="instructor" required>
                  <?php foreach($teacher as $rows):?>
                        <option value="<?php echo $rows['teacher_Id']; ?>"  
                            <?php if($row_teacher['sub_teacher_Id'] == $rows['teacher_Id']) echo 'selected="selected"'; ?> 
                             > <!--/////   CLOSING OPTION TAG  -->
                            <?php echo ' '.$rows['fname'].' '.$rows['mname'].' '.$rows['lname'].' '.$rows['suffix'].' '; ?>                                  
                        </option>

                 <?php endforeach;?>
               </select> 
            </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-success" name="update_subject"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- ****************************************************END UPDATE*********************************************************************** -->



<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['sub_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-book"></i> Delete subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sub_Id']; ?>" name="sub_Id">
          <h6 class="text-center">Delete subject record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_subject"><i class="fa-solid fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->