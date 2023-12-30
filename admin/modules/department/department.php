<?php
include('../../includes/connection.php');

$department= array();

$query = "
  SELECT * FROM tbl_department
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
 
    $temp_arr['department_id']      = $row['department_id'];
    $temp_arr['dept_name']    = $row['dept_name'];


    $department[] = $temp_arr;
  }
}


foreach($department as $key => $value){


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-primary'  onclick='department_edit(".$value['department_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
      <button class = 'btn btn-danger'  onclick='department_delete(".$value['department_id'].")'><i class='fa fa-trash'></i></button>
    </div>
  </td>
    ";

    $data['data'][] = array($value['dept_name'],$button);
  }
  
  
  echo json_encode($data);


?>




