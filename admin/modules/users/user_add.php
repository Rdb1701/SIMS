<?php date_default_timezone_set('Asia/Manila');

require_once '../../includes/connection.php';

$username     = mysqli_real_escape_string($db, trim($_POST['username']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$email        = mysqli_real_escape_string($db, trim($_POST['email']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type_id']));
$dept         = mysqli_real_escape_string($db, trim($_POST['department']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM tbl_users 
 WHERE username = '$username'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO tbl_users(username,
        password,
        fname,
        lname,
        gender,
        email,
        user_type_id,
        department_id,
        isActive) VALUES('$username',
        '".md5($username)."',
        '$fname',
        '$lname',
        '$gender',
        '$email',
        '$user_type_id',
        '$dept',
        '1'
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