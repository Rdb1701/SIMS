<?php
include('../../includes/connection.php');

$data = array();

extract($_POST);

$department = '';

$query = "
SELECT * FROM tbl_department
WHERE department_id = '$department_id'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $department    = $row['dept_name'];
}

$data['department'] = $department;
$data['department_id']  = $department_id;


echo json_encode($data);


?>