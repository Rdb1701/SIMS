<!------------------------------------- UPLOAD PHOTO-------------------------------------------------->
<div class="modal fade" id="upload_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="upload_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="item_id" id="item_id">
            <input type="file" name="file" id="file" accept="image/*" class="form-control"><br><br>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>

  </div>
</div>


<!--------------------------------------- ADD ITEM  MODAL ------------------------------------------->
<?php


$sql = "SELECT DISTINCT category_id, category_desc FROM tbl_category";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_category'>";
$opt1 .= "<option value='' selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='".$row['category_id']."'>".$row['category_desc']."</option>";
  }

$opt1 .= "</select>";



$sql = "SELECT DISTINCT category_id, category_desc FROM tbl_category";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'edit_category'>";
$opt2 .= "<option value='' selected hidden>Select Catrgory</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='".$row['category_id']."'>".$row['category_desc']."</option>";
  }

$opt2 .= "</select>";
?>
 <!-- ADD ITEM -->
<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New item</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_insert">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Model<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_model">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Category<span class="text-danger">*</span></label>
            <?php echo $opt1; ?>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Brand<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_brand">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Quantity<span class="text-danger">*</span></label>
            <input type="number" class="form-control validate" id="add_quantity">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Type<span class="text-danger">*</span></label>
            <select class='form-control' id="add_type" required>
              <option value="" selected hidden>Select Item Type</option>
              <option value="0">Physical</option>
              <option value="1">Consumable</option>
            </select>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Price</label>
            <input type="number" class="form-control validate" id="add_price">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Specification</label>
            <textarea class="form-control" id="add_desc" cols="30" rows="3" maxlength="255"></textarea>
          </div>
          <div class="md-form" id="dept1">

          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!-- EDIT ITEM -->
<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit New item</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_update">
        <div class="modal-body mx-4">
          <div class="md-form">
          <input type="hidden" class="form-control validate" id="edit_item_id">
          <input type="hidden" class="form-control validate" id="edit_item_stock_id">
            <label data-error="wrong" data-success="right">Model<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_model">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Category<span class="text-danger">*</span></label>
            <?php echo $opt2; ?>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Brand<span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_brand">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Quantity<span class="text-danger">*</span></label>
            <input type="number" class="form-control validate" id="edit_quantity">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Type<span class="text-danger">*</span></label>
            <select class='form-control' id="edit_type" required>
              <option value="" selected hidden>Select Item Type</option>
              <option value="0">Physical</option>
              <option value="1">Consumable</option>
            </select>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Price</label>
            <input type="number" class="form-control validate" id="edit_price">
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Description</label>
            <textarea class="form-control" id="edit_desc" cols="30" rows="3" maxlength="255"></textarea>
          </div>
          <div class="md-form" id="dept1">

          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!------------------------------------- ADD QUANTITY----------------------------------------------->
<div class="modal fade" id="add_quantity_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Add Quantity</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="quantity_form">
        <div class="modal-body">
        <div class="md-form">
        <input type="hidden" name="" id="quantity_item_id">
          <input type="hidden" name="" id="quantity_item_stock_id">
            <label data-error="wrong" data-success="right">Add Quantity<span class="text-danger">*</span></label>
            <input type="number" class="form-control validate" id="add_quantity_stock">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>

<!------------------------------------- Delete Items------------------------------------------------>
<div class="modal fade" id="delete_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="delete_form">
        <div class="modal-body">
          <span>are you sure do you want to delete?</span>
          <input type="hidden" name="" id="delete_item_id">
          <input type="hidden" name="" id="delete_item_stock_id">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>