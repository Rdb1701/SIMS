<?php
include('../../includes/connection.php');

extract($_POST);

$data = array();
$res_success  = 0;
$res_message  = '';

$query = "
UPDATE tbl_issuance_transaction
SET
status = '1'
WHERE issuance_id = '$clear_id'
";

if($db->query($query)){
    $res_success = 1;
}else{
    $res_message = 'Query Failed';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>