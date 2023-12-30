<?php
include('../../includes/connection.php');

$department= array();

$query = "
  SELECT * FROM tbl_category
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
 
    $temp_arr['category_id']      = $row['category_id'];
    $temp_arr['category_desc']    = $row['category_desc'];


    $department[] = $temp_arr;
  }
}


foreach($department as $key => $value){

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-primary'  onclick='category_edit(".$value['category_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
      <button class = 'btn btn-danger'  onclick='category_delete(".$value['category_id'].")'><i class='fa fa-trash'></i></button>
    </div>
  </td>
    ";

    $data['data'][] = array($value['category_desc'],$button);
  }
  
  
  echo json_encode($data);


?>




