<?php date_default_timezone_set('Asia/Manila');

include('../../includes/connection.php');

extract($_POST);
$res_success  = 0;
$res_message  = '';
$data         = array();

$query = "
INSERT INTO tbl_department(
 dept_name
)VALUES(
 '$department'
)
";

if($db->query($query)){
    $res_success = 1;
}else{
    $res_message = "Query Failed";
}

$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);

?>