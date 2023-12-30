<?php
include('../../includes/connection.php');
$data        = array();
$res_message = '';
$res_success = 0;

$model          = mysqli_real_escape_string($db, trim($_POST['model']));
$category       = mysqli_real_escape_string($db, trim($_POST['category']));
$brand          = mysqli_real_escape_string($db, trim($_POST['brand']));
$stock          = mysqli_real_escape_string($db, trim($_POST['stock']));
$price          = mysqli_real_escape_string($db, trim($_POST['price']));
$desc           = mysqli_real_escape_string($db, trim($_POST['desc']));
$item_id        = mysqli_real_escape_string($db, trim($_POST['item_id']));
$item_stock_id  = mysqli_real_escape_string($db, trim($_POST['item_stock_id']));
$type           = mysqli_real_escape_string($db, trim($_POST['type']));


$query = "
UPDATE tbl_items
SET
model         = '$model',
category_id   = '$category',
brand         = '$brand',
raw_stock     = '$stock',
price         = '$price',
description   = '$desc',
type          = '$type'
WHERE item_id = '$item_id'
";

if(mysqli_query($db, $query)){
    
    $res_success = 1;
}else{
    $res_message = 'Query Failed!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>