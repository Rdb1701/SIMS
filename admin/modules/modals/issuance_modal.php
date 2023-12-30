
<!------------------------------------- Clear Items------------------------------------------------>
<div class="modal fade" id="clear_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Clear?</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="clear_form">
        <div class="modal-body">
          <span>are you sure do you want to clear?</span>
          <input type="hidden" name="" id="clear_id">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>


<?php
$sql = "SELECT tis.*, c.category_desc, i.model, i.brand
 FROM tbl_item_stock as tis 
LEFT JOIN tbl_items as i ON i.item_id = tis.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
WHERE tis.quantity != '0'";

$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_item' required>";
$opt1 .= "<option value='' selected hidden>Select Item</option>";
while ($row = $result->fetch_assoc()) {
    $opt1 .= "<option value='" . $row['item_stock_id'] . "'>".$row['brand'] .' '.$row['model'] . " - " . $row['category_desc'] . " [" . $row['quantity'] . " in stock]</option>";
}
$opt1 .= "</select>";

$sql = "SELECT * FROM tbl_users WHERE user_type_id = '2'";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'add_staff' required>";
$opt2 .= "<option value='' selected hidden>Select Staff</option>";
while ($row = $result->fetch_assoc()) {
    $opt2 .= "<option value='" . $row['user_id'] . "'>" . $row['fname'] . " " . $row['lname'] . "</option>";
}
$opt2 .= "</select>";



$sql = "SELECT * FROM tbl_department";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt3 = "<select class='form-control' name='type' id = 'add_department' onchange = 'change_dept()' required>";
$opt3 .= "<option value='' selected hidden>Select Department</option>";
while ($row = $result->fetch_assoc()) {
    $opt3 .= "<option value='" . $row['department_id'] . "'>" . $row['dept_name'] . "</option>";
}
$opt3 .= "</select>";
?>

<div class="modal fade" id="issuance_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Item Issuance</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_issue">
        <div class="modal-body mx-4">
          <input type="hidden" class="form-control validate" id="edit_item_id">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Department<span class="text-danger">*</span></label>
            <?php echo $opt3; ?>
          </div>
          <div class="md-form" id ='users_data'>
           <!-- DATA USERS PER DEAPRTMENT -->
            
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">item<span class="text-danger">*</span></label>
            <?php echo $opt1; ?>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Date Issued<span class="text-danger">*</span></label>
            <input type="datetime-local" class="form-control validate" id="add_date">
       
          </div>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


