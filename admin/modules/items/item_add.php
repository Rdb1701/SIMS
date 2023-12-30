<?php
include('../../includes/connection.php');

date_default_timezone_set('Asia/Manila');
$model = mysqli_real_escape_string($db, trim($_POST['model']));
$category = mysqli_real_escape_string($db, trim($_POST['category']));
$brand = mysqli_real_escape_string($db, trim($_POST['brand']));
$stock = mysqli_real_escape_string($db, trim($_POST['stock']));
$price = mysqli_real_escape_string($db, trim($_POST['price']));
$desc  = mysqli_real_escape_string($db, trim($_POST['desc']));
$type  = mysqli_real_escape_string($db, trim($_POST['type']));

$data        = array();
$res_message = '';
$res_success = 0;

$query ="
INSERT INTO tbl_items(
 model,
 category_id,
 brand,
 raw_stock,
 price,
 description,
 date_inserted,
 type
  )VALUES(
'$model',
'$category',
'$brand',
'$stock',
'$price',
'$desc',
'".date("Y-m-d H:i:s")."',
'$type')
";

if (mysqli_query($db, $query)) {
    $last_insert_item_id = mysqli_insert_id($db);

$sql = "
INSERT INTO tbl_item_stock(item_id,
quantity)VALUES(
'$last_insert_item_id',
'$stock'
)
";
if (mysqli_query($db, $sql)) {
    $res_success = 1;

} else {
    $res_message = "Query Failed";
}
    
} else {
    $res_message = "Query Failed";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>