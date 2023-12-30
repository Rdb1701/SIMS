<?php

require_once '../../backend/connection.php';

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE tbl_staff
  SET password = '".md5($password)."' 
  WHERE staff_id= '".$_SESSION['user']['staff_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
