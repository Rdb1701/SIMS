<?php

date_default_timezone_set('Asia/Manila');

require_once '../../backend/connection.php';


$student_id  = mysqli_real_escape_string($db, trim($_POST['student_id']));
$lname       = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname       = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender      = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone       = mysqli_real_escape_string($db, trim($_POST['phone']));
$year_level  = mysqli_real_escape_string($db, trim($_POST['year_level']));
$course      = mysqli_real_escape_string($db, trim($_POST['course']));


$data = array();

$res_success = 0;
$res_message = '';


    $query = "
    UPDATE tbl_students
    SET
    lname       = '$lname',
    fname       = '$fname',
    gender      = '$gender',
    year_level  = '$year_level',
    course_id   = '$course',
    phone       = '$phone'
    WHERE student_id = '$student_id'
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