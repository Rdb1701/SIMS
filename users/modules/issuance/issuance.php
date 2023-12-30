<?php
include('../../../admin/includes/connection.php');
date_default_timezone_set('Asia/Manila');

$issuance_list = array();

$query = "
SELECT it.*, us.fname, us.lname, tis.item_stock_id, i.description, c.category_desc, i.brand, i.model, d.dept_name
FROM tbl_issuance_transaction as it
LEFT JOIN tbl_users as us ON us.user_id = it.issued_to
LEFT JOIN tbl_item_stock as tis ON tis.item_stock_id = it.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = tis.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE it.issued_to = '".$_SESSION['staff']['user_id']."'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

     $issuance_status= "";
    if($row['issuance_status'] == 0){
      $issuance_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">OLD</span>';
    }
    if($row['issuance_status'] == 1){
      $issuance_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">NEW</span>';
    }
    if($row['issuance_status'] == 2){
      $issuance_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DAMAGED</span>';
    }

    $temp_arr['issuance_id']   = $row['issuance_id'];
    $temp_arr['item_stock_id'] = $row['item_stock_id'];
    $temp_arr['model']         = $row['model'];
    $temp_arr['category']      = $row['category_desc'];
    $temp_arr['brand']         = $row['brand'];
    $temp_arr['description']   = $row['description'];
    $temp_arr['fname']         = $row['fname'];
    $temp_arr['lname']         = $row['lname'];
    $temp_arr['dept_name']     = $row['dept_name'];
    $temp_arr['issuance_code'] = $row['issuance_code'];
    $temp_arr['date_issued']   = date('F d,Y', strtotime($row['date_issued']));
    $temp_arr['status']        = $issuance_status;
    $temp_arr['date_issued_to'] = $row['date_issued'];

    $issuance_list[] = $temp_arr;

  }

}

foreach($issuance_list as $key => $value){


    $data['data'][] = array($value['issuance_code'], $value['brand'].' '.$value['model'], $value['description'], $value['date_issued']);
 
}

echo json_encode($data);
?>