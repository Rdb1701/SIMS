<?php
include('../../includes/connection.php');
date_default_timezone_set('Asia/Manila');

$issuance_list = array();

$query = "
SELECT it.*, us.fname, us.lname, tis.item_stock_id, i.description, c.category_desc, i.brand, i.model, d.dept_name
FROM tbl_issuance_transaction as it
LEFT JOIN tbl_users as us ON us.user_id = it.issued_to
LEFT JOIN tbl_item_stock as tis ON tis.item_stock_id = it.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = tis.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE it.status = '0'
ORDER by us.lname ASC
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

     $issuance_status= "";
    if($row['issuance_status'] == 0){
      $issuance_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">OLD</span>';
    }
    if($row['issuance_status'] == 1){
      $issuance_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">NEW</span>';
    }
    if($row['issuance_status'] == 2){
      $issuance_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DAMAGED</span>';
    }

    $temp_arr['issuance_id']   = $row['issuance_id'];
    $temp_arr['item_stock_id'] = $row['item_stock_id'];
    $temp_arr['model']         = $row['model'];
    $temp_arr['category']      = $row['category_desc'];
    $temp_arr['brand']         = $row['brand'];
    $temp_arr['description']   = $row['description'];
    $temp_arr['fname']         = $row['fname'];
    $temp_arr['lname']         = $row['lname'];
    $temp_arr['dept_name']     = $row['dept_name'];
    $temp_arr['issuance_code'] = $row['issuance_code'];
    $temp_arr['date_issued']   = date('F d,Y', strtotime($row['date_issued']));
    $temp_arr['status']        = $issuance_status;
    $temp_arr['date_issued_to'] = $row['date_issued'];

    $issuance_list[] = $temp_arr;

  }

}

foreach($issuance_list as $key => $value){


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-success' onclick='qr_upload(".$value['issuance_id'].")'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-qr-code' viewBox='0 0 16 16'>
    <path d='M2 2h2v2H2V2Z'/>
    <path d='M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z'/>
    <path d='M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z'/>
    <path d='M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z'/>
    <path d='M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z'/>
  </svg></button>&nbsp;
  <button class = 'btn btn-warning'  onclick='issuance_transfer(".$value['issuance_id'].")'><i class='fa fa-brush'></i></button>
</div>
  </td>
    ";
    $data['data'][] = array($value['issuance_code'],$value['dept_name'],$value['fname'].' '.$value['lname'], $value['brand'].' '.$value['model'], $value['description'], $value['date_issued'],$button);
 
}

echo json_encode($data);
?>