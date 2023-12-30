<?php
include('../../../admin/includes/connection.php');
date_default_timezone_set('Asia/Manila');

$qr_message = mysqli_real_escape_string($db, trim($_POST['qr_message']));
$fname = '';
$lname = '';
$brand = '';
$model = '';
$specs = '';
$category = '';
$department = '';
$photo      = '';
$item_status = '';
$item_code = '';
$issuance_id = '';
$qr_code = '';

$data = array();

//getting item information
$query = "
SELECT tis.*, us.fname, us.lname, its.item_stock_id, i.description, c.category_desc, i.brand, i.model, d.dept_name, i.photo, its.item_status
FROM tbl_issuance_transaction as tis
LEFT JOIN tbl_item_stock as its ON its.item_stock_id = tis.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = its.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
LEFT JOIN tbl_users as us ON us.user_id = tis.issued_to
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE qr_code = '$qr_message'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row          = $result->fetch_assoc();
    $issuance_id  = $row['issuance_id'];
    $brand        = $row['brand'];
    $model        = $row['model'];
    $category     = $row['category_desc'];
    $specs        = $row['description'];
    $fname        = $row['fname'];
    $lname        = $row['lname'];
    $department   = $row['dept_name'];
    $photo        = $row['photo'];
    $item_status  = $row['item_status'];
    $item_code    = $row['issuance_code'];
    $qr_code      = $row['qr_code'];
}


$data['brand']       = $brand;
$data['model']       = $model;
$data['category']    = $category;
$data['specs']       = $specs;
$data['fname']       = $fname;
$data['lname']       = $lname;
$data['department']  = $department;
$data['photo']       = $photo;
$data['item_status'] = $item_status;
$data['item_code']   = $item_code;
$data['issuance_id'] = $issuance_id;
$data['qr_code']     = $qr_code;


echo json_encode($data);

?>