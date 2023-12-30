<?php date_default_timezone_set('Asia/Manila');

require_once '../../backend/connection.php';


$username    = mysqli_real_escape_string($db, trim($_POST['username']));
$lname       = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname       = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender      = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone       = mysqli_real_escape_string($db, trim($_POST['phone']));
$year_level  = mysqli_real_escape_string($db, trim($_POST['year_level']));
$course      = mysqli_real_escape_string($db, trim($_POST['course']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM tbl_students as stud
LEFT JOIN tbl_course as c ON stud.course_id = c.course_id
 WHERE username = '$username'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO tbl_students(username,
        password,
        fname,
        lname,
        gender,
        year_level,
        phone,
        course_id) VALUES('$username',
        '".md5($username)."',
        '$fname',
        '$lname',
        '$gender',
        '$year_level',
        '$phone',
        '$course'
    
    )
    ";
   

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);





?>