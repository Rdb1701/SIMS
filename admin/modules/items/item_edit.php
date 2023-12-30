<?php
include('../../includes/connection.php');

$item_id  = mysqli_real_escape_string($db, trim($_POST['item_id']));
$item_stock_id  = mysqli_real_escape_string($db, trim($_POST['item_stock_id']));

$data = array();
$res_meesage= '';
$res_success = 0;

$model      = '';
$category   = '';
$brand      = '';
$stock      = '';
$price      = '';
$desc       = '';


$query = "
SELECT it.*, its.item_id, its.model, its.brand, its.description, its.raw_stock, its.price, its.photo, c.category_id, its.type
FROM tbl_item_stock as it
LEFT JOIN tbl_items as its ON its.item_id = it.item_id
LEFT JOIN tbl_category as c ON c.category_id = its.category_id
WHERE it.item_stock_id = '$item_stock_id'
";
$result = $db->query($query);
if ($result->num_rows) {

 $row = $result->fetch_assoc();

 $model         = $row['model'];
 $category      = $row['category_id'];
 $brand         = $row['brand'];
 $stock         = $row['raw_stock'];
 $price         = $row['price'];
 $desc          = $row['description'];
 $type          = $row['type'];

}

$data['item_id']   = $item_id;
$data['item_stock_id']   = $item_stock_id;
$data['model']     = $model;
$data['category']  = $category;
$data['brand']     = $brand;
$data['stock']     = $stock;
$data['price']     = $price;
$data['item_desc'] = $desc ;
$data['type']      = $type ;

echo json_encode($data);



?>