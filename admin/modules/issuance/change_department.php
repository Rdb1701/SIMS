<?php

include('../../includes/connection.php');

extract($_POST);

$data         = array();
$res_success  = 0;
$res_message  = '';
$users        = array();
$result1      = array();

$query = "
SELECT * FROM tbl_users
WHERE department_id = '$department'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();
        $res_success = 1;

        $temp_arr['user_id'] = $row['user_id'];
        $temp_arr['fname']   = $row['fname'];
        $temp_arr['lname']   = $row['lname'];

        $users[] = $temp_arr;

    }
}else{
    $res_message = "Query Failed";
}

foreach ($users as $rows) {
    array_push($result1, $rows);  
} 

$data['users']       = $result1;
$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

 echo json_encode($data);
?>