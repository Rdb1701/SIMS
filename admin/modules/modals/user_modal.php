<!--------------------------------------- ADD USER  MODAL ------------------------------------------->
<?php

$sql = "SELECT DISTINCT name, user_type_id FROM tbl_user_types WHERE user_type_id != '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_user_type_id' required>";
$opt1 .= "<option value='' selected hidden>Select User Type</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['user_type_id'] . "'>" . $row['name'] . "</option>";
}

$opt1 .= "</select>";


$sql = "SELECT DISTINCT dept_name, department_id FROM tbl_department";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'add_department' required>";
$opt2 .= "<option value='' selected hidden>Select Department</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['department_id'] . "'>" . $row['dept_name'] . "</option>";
}

$opt2 .= "</select>";

?>

<div class="modal fade" id="list_add_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New User</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
            </div>
            <form id="form_insert">
                <div class="modal-body mx-4">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_username" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_fname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_lname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="add_gender" required>
                            <option value="" selected hidden>- Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email</label>
                        <input type="email" class="form-control validate" id="add_email" required>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
                        <?php echo $opt1;  ?>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Department <span class="text-danger">*</span></label>
                        <?php echo $opt2;  ?>
                    </div>
                    <!-- <div class="md-form">
                        <label data-error="wrong" data-success="right">Active</label>
                        <select class='form-control' id="add_active" required>
                            <option value="" selected hidden>Select Active</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div> -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>



<!--------------------------------------- EDIT USER  MODAL ------------------------------------------->
<?php

$sql = "SELECT DISTINCT name, user_type_id FROM tbl_user_types";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt3 = "<select class='form-control' name='type' id = 'edit_user_type_id'>";
$opt3 .= "<option value='' selected hidden>Select User Type</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt3 .= "<option value='" . $row['user_type_id'] . "'>" . $row['name'] . "</option>";
}

$opt3 .= "</select>";


$sql = "SELECT DISTINCT dept_name, department_id FROM tbl_department";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");
$opt4 = "<select class='form-control' name='type' id = 'edit_department'>";
$opt4 .= "<option value='' selected hidden>Select Department</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt4 .= "<option value='" . $row['department_id'] . "'>" . $row['dept_name'] . "</option>";
}

$opt4 .= "</select>";

?>

<div class="modal fade" id="list_edit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit User</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
            </div>
            <form id="form_update">
                <div class="modal-body mx-4">
                    <div class="md-form">
                    <input type="hidden" class="form-control validate" id="edit_user_id">
                        <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_username" disabled required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_fname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_lname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_gender" required>
                            <option value="" selected hidden>- Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email</label>
                        <input type="email" class="form-control validate" id="edit_email" required>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
                        <?php echo $opt3;  ?>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Department <span class="text-danger">*</span></label>
                        <?php echo $opt4;  ?>
                    </div>
                    <!-- <div class="md-form">
                        <label data-error="wrong" data-success="right">Active</label>
                        <select class='form-control' id="add_active" required>
                            <option value="" selected hidden>Select Active</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div> -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>


<!-------------------------------------------- Change Password modal ------------------------------------------------->
<div class="modal fade" id="changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>

            <input type="text" class="form-control validate" id="cp_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_new_password" required>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_re_new_password" required>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name="signupbtn">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>