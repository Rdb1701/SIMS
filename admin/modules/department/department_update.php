<?php
include('../../includes/connection.php');

$data = array();
$res_success = 1;
$res_message = '';

extract($_POST);

$query = "
UPDATE tbl_department
SET
dept_name     = '$department'
WHERE department_id = '$department_id'
";

if($db->query($query)){
    $res_success = 1;
}else{
    $res_message = "Query Failed!";
}

$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);

?>