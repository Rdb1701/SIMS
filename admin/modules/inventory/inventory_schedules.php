<?php
include('../../includes/connection.php');

$data        = array();
$res_success = 0;
$res_message = '';
$date_schedule = array();
$result1 = array();


$query = "SELECT DISTINCT DATE(date_inserted) as date_now FROM tbl_inventory";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();
        $res_success = 1;

        $temp_arr['date_now'] = date('F d,Y', strtotime($row['date_now']));

        $date_schedule[] = $temp_arr;
    }
}else{
    $res_message = "Query Failed";
}

foreach ($date_schedule as $rows) {
    array_push($result1, $rows);  
} 

$data['inventory_sched']   = $result1;
$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>