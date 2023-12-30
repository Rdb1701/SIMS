<?php
include('../../includes/connection.php');
$data = array();
$res_success = 0;
$res_message = '';

$item_id        = mysqli_real_escape_string($db, trim($_POST['item_id']));
$item_stock_id  = mysqli_real_escape_string($db, trim($_POST['item_stock_id']));
$add_quantity  = mysqli_real_escape_string($db, trim($_POST['add_quantity']));
$quantity = 0;
$query = "
SELECT quantity 
FROM tbl_item_stock
WHERE item_stock_id = '$item_stock_id'
";
$result = mysqli_query($db, $query);
$numRows = $result->num_rows;
if ($numRows > 0) {
    $row = $result->fetch_assoc();

    $quantity = $row['quantity'];
}
$quantity_total = $add_quantity + $quantity; 

//UPDATING QUANTITY
$query = "
UPDATE tbl_item_stock
SET 
quantity = '$quantity_total'
WHERE item_stock_id = '$item_stock_id'
";

if(mysqli_query($db,$query)){
    $res_success = 1;

}else{
    $res_message = "Query Failed!";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>