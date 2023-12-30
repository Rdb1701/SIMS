<?php
include('../../includes/connection.php');
$date_inv   = mysqli_real_escape_string($db, trim($_POST['tvalue']));

$data = array();
$inventory = array();
$res_success = 0;
$res_message = " ";
$result1 = array();

$query = "
SELECT DATE(inv.date_inserted) as date_inventory, inv.inventory_status, inv.reference_no, inv.date_inserted, us.fname, us.lname, its.item_stock_id, i.description, c.category_desc, i.brand, i.model, d.dept_name, i.photo, its.item_status, tis.issuance_code
FROM tbl_inventory as inv
LEFT JOIN tbl_issuance_transaction as tis ON tis.issuance_id = inv.issuance_id
LEFT JOIN tbl_item_stock as its ON its.item_stock_id = tis.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = its.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
LEFT JOIN tbl_users as us ON us.user_id = tis.issued_to
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE DATE(inv.date_inserted) = '$date_inv'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();
        $res_success = 1;

        $item_status= "";
        if($row['inventory_status'] == 0){
          $item_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">LOST ITEM</span>';
        }
        if($row['inventory_status'] == 1){
          $item_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">GOOD CONDITION</span>';
        }
        if($row['inventory_status'] == 2){
          $item_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DAMAGED</span>';
        }

        $temp_arr['brand']          = $row['brand'];
        $temp_arr['model']          = $row['model'];
        $temp_arr['category']       = $row['category_desc'];
        $temp_arr['specs']          = $row['description'];
        $temp_arr['category']       = $row['category_desc'];
        $temp_arr['date_inserted']  = date('F d,Y', strtotime($row['date_inserted']));
        $temp_arr['item_status']    = $item_status;
        $temp_arr['reference_no']   = $row['reference_no'];
        $temp_arr['issuance_code']  = $row['issuance_code'];

        $inventory[] = $temp_arr;

    }
}else{

    $res_message = "Query Failed";
}

foreach ($inventory as $rows) {
    array_push($result1, $rows);  
} 

$data['inventory']   = $result1;
$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

 echo json_encode($data);


 ?>