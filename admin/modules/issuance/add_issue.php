<?php
include('../../includes/connection.php');
//QR LIBRARY
require '../../../libraries/phpqrcode/qrlib.php';
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

//GETTING UNIQUE FOR PRN
$item_code = 'ITM-2023';
$reference_no = date("Y-m-d H:i:s");
   // For the contatanation of the qr/bar code
   $t1   =  substr("$reference_no",14,-3);
   $y1   =  substr("$reference_no",-2);
   // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
   $concatqr1 = $t1.$y1;


$quantity = 0;
$query = "
SELECT * FROM tbl_item_stock
WHERE item_stock_id = '$item_id'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    $row = $result->fetch_assoc();

    $quantity = $row['quantity'];
}else{
    $res_message= "Query failed for geting quantity";
}

//Minus the Item
$quantity_minus = $quantity - 1;

$query_minus = "
UPDATE tbl_item_stock
SET 
quantity = '$quantity_minus'
WHERE item_stock_id = '$item_id'
";

if($db->query($query_minus)){

    // INSERT ISSUANCE
    $query_insert = "
    INSERT INTO tbl_issuance_transaction(
     item_stock_id,
     issued_to,
     issuance_code,
     date_issued,
     issuance_status)VALUES(
    '$item_id',
    '$staff_id',
    '".$item_code.$concatqr1."',
    '$add_date',
    '1'
     )
    ";

    if($db->query($query_insert)){
        $res_success = 1;
        $new_inserted_id = $db->insert_id;

        $q   =  substr("$reference_no",0,4);
        $w   =  substr("$reference_no",5,-12);
        $e   =  substr("$reference_no",8,-9);
        $r   =  substr("$reference_no",11,-6);
        $t   =  substr("$reference_no",14,-3);
        $y   =  substr("$reference_no",-2);
        // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
      $concatqr = $q.$w.$e.$r.$t.$y;
    
       //----------------------------------------------GENERATING QR CODE----------------------------------------------------------->
    $tempDir = 'qr_images/';
    $codeContents =  $concatqr;
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {

        //UPDATING FILE NAME
        $query = "UPDATE tbl_issuance_transaction
        SET
        qr = '$pngAbsoluteFilePath',
        qr_code = '$concatqr'
        WHERE issuance_id = '$new_inserted_id'
        ";
        mysqli_query($db, $query);
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        $res_success = 1;
    } else {
        $res_message =  'File already generated! We can use this cached file to speed up site on common codes!';
        $res_message = '<hr />';
    }


    }else{
        $res_message = "Query Failed Inserting";
    }

}else{
    $res_message = "Query Failed Updating Quantity";

}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>