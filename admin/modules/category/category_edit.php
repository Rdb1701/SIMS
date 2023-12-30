<?php
include('../../includes/connection.php');

$data = array();

extract($_POST);

$category = '';

$query = "
SELECT * FROM tbl_category
WHERE category_id = '$category_id'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $category    = $row['category_desc'];
}

$data['category'] = $category;
$data['category_id']  = $category_id;

echo json_encode($data);


?>