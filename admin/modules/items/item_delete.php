<?php
include('../../includes/connection.php');

$item_id  = mysqli_real_escape_string($db, trim($_POST['item_id']));
$item_stock_id  = mysqli_real_escape_string($db, trim($_POST['item_stock_id']));

$data        = array();
$res_success = 0;
$res_message = '';

$query = "
DELETE FROM tbl_item_stock
WHERE item_stock_id = '$item_stock_id'
";

if(mysqli_query($db,$query)){
    $res_success = 1;

}else{
    $res_message = '$query Failed';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>