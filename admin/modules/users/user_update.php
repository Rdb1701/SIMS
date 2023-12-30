<?php
date_default_timezone_set('Asia/Manila');

require_once '../../includes/connection.php';

$user_id      = mysqli_real_escape_string($db, trim($_POST['user_id']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$email        = mysqli_real_escape_string($db, trim($_POST['email']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type']));
$department   = mysqli_real_escape_string($db, trim($_POST['department']));

$data = array();

$res_success = 0;
$res_message = '';


    $query = "
    UPDATE tbl_users
    SET
    lname = '$lname',
    fname =  '$fname',
    gender = '$gender ',
    email = '$email',
    user_type_id = '$user_type_id',
    department_id = '$department'
    WHERE user_id = '$user_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;

    }else{
        $res_message = "Query Failed";
    }


    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>