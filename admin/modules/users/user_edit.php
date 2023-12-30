<?php 

require_once '../../includes/connection.php';

$user_id = mysqli_real_escape_string($db, trim($_POST['user_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$email       = '';
$user_type_id = '';
$department    = '';

$user_types = array();

$query = "
  SELECT *
  FROM tbl_users
  WHERE user_id = '$user_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $username      = $row['username'];
  $lname         = $row['lname'];
  $fname         = $row['fname'];
  $gender        = $row['gender'];
  $email         = $row['email'];
  $user_type_id  = $row['user_type_id'];
  $department    = $row['department_id'];

}

$data['user_id']        = $user_id;
$data['username']       = $username;
$data['lname']          = $lname;
$data['fname']          = $fname;
$data['gender']         = $gender;
$data['email']          = $email;
$data['department']     = $department;
$data['user_type_id']   = $user_type_id;



echo json_encode($data);


?>
