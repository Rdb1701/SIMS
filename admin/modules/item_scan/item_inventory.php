<?php
include('../../includes/connection.php');
date_default_timezone_set('Asia/Manila');

$issuance_id = mysqli_real_escape_string($db, trim($_POST['issuance_id']));
$status      = mysqli_real_escape_string($db, trim($_POST['inventory_status']));
$qr_code     = mysqli_real_escape_string($db, trim($_POST['qr_code']));

$data = array();
$res_success = 0;
$res_message = '';

$query = "
INSERT INTO tbl_inventory(issuance_id,
date_inserted,
reference_no,
inventory_status)VALUES(
'$issuance_id',
'".date("Y-m-d H:i:s")."',
'$qr_code',
'$status'
)
";

if($db->query($query)){
    $res_success = 1;

}else{

    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>