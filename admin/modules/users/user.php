<?php
include('../../includes/connection.php');
$users = array();

$query = "
SELECT us.*, ust.name, d.dept_name
FROM tbl_users as us
LEFT JOIN tbl_user_types as ust ON ust.user_type_id = us.user_type_id
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
ORDER BY us.lname DESC
";


$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


    $gender_status = "";
    if($row['gender'] == 1){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Female</span>';

    }
    if($row['gender'] == 2){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Male</span>';

    }

   $active = "";
    if($row['isActive'] == 1){
      $active = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>';

    }
    if($row['isActive'] == 2){
      $active = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';

    }

    $temp_arr['user_id']   = $row['user_id'];
    $temp_arr['username']  = $row['username'];
    $temp_arr['lname']     = $row['lname'];
    $temp_arr['fname']     = $row['fname'];
    $temp_arr['gender']    = $gender_status;
    $temp_arr['email']     = $row['email'];
    $temp_arr['type']      = $row['name'];
    $temp_arr['department'] = $row['dept_name'];
    $temp_arr['isActive']  = $active;
 

    $users[] = $temp_arr;
  }
}

foreach($users as $key => $value){

  $button= "
  <td class='text-center'>
  <div class='d-flex justify-content-center order-actions'>
  <button class = 'btn btn-primary'  onclick='user_edit(".$value['user_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
    <button class = 'btn btn-warning'  onclick='list_changepassword(".$value['user_id'].",\"".$value['username']."\")'><i class='fa fa-key'></i></button>
  </div>
</td>
  ";
  $data['data'][] = array($value['username'],$value['fname']. ' '.$value['lname'],$value['email'],$value['department'],$value['type'],$button);
}


echo json_encode($data);

?>




