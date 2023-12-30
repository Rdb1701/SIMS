<?php
include('../../includes/connection.php');

$items = array();

$query = "
SELECT it.*, its.item_id, its.model, its.brand, its.description, its.raw_stock, its.price, its.photo, c.category_desc
FROM tbl_item_stock as it
LEFT JOIN tbl_items as its ON its.item_id = it.item_id
LEFT JOIN tbl_category as c ON c.category_id = its.category_id
ORDER by its.brand ASC
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $item_status= "";
    if($row['item_status'] == 0){
      $item_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">OLD</span>';
    }
    if($row['item_status'] == 1){
      $item_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">NEW</span>';
    }
    if($row['item_status'] == 2){
      $item_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DAMAGED</span>';
    }

      $temp_arr['item_id']       = $row['item_id'];
      $temp_arr['item_stock_id'] = $row['item_stock_id'];
      $temp_arr['model']         = $row['model'];
      $temp_arr['category']      = $row['category_desc'];
      $temp_arr['brand']         = $row['brand'];
      $temp_arr['description']   = $row['description'];
      $temp_arr['raw_stock']     = $row['raw_stock'];
      $temp_arr['quantity_left'] = $row['quantity'];
      $temp_arr['price']         = $row['price'];
      $temp_arr['status']        = $item_status;
      $temp_arr['item_stock']    = $row['quantity'];
      $temp_arr['photo']         = $row['photo'];

      $items[] = $temp_arr;
    }

}

foreach($items as $key => $value){

  $image = "<img src='items/".$value['photo']."' alt='Photo' width='70px'>";

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-warning'  onclick='item_upload(".$value['item_id'].")'><i class='fa fa-upload'></i></button>&nbsp;
    <button class = 'btn btn-primary'  onclick='edit_item(".$value['item_id'].",".$value['item_stock_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
    <button class = 'btn btn-success'  onclick='item_add_stock(".$value['item_id'].",".$value['item_stock_id'].")'><i class='fa fa-plus'></i></button>&nbsp;
    <button class = 'btn btn-danger'  onclick='delete_item(".$value['item_id'].",".$value['item_stock_id'].")'><i class='fa fa-trash'></i></button>
    </div>
  </td>

    ";
    $data['data'][] = array($image,$value['model'],$value['category'],$value['brand'],$value['description'],$value['raw_stock'],$value['quantity_left'],$button);
  }
  
  
  echo json_encode($data);



?>