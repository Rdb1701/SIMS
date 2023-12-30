<?php
include('../../includes/connection.php');
require_once '../../../libraries/tcpdf/tcpdf.php';

$date_inv   = mysqli_real_escape_string($db, trim($_GET['inv_date']));


$data = array();
$res_success = 0;
$res_message = '';

$query = "
SELECT DATE(inv.date_inserted) as date_inventory, inv.inventory_status, inv.reference_no, inv.date_inserted, us.fname, us.lname, its.item_stock_id, i.description, c.category_desc, i.brand, i.model, d.dept_name, i.photo, its.item_status, tis.issuance_code
FROM tbl_inventory as inv
LEFT JOIN tbl_issuance_transaction as tis ON tis.issuance_id = inv.issuance_id
LEFT JOIN tbl_item_stock as its ON its.item_stock_id = tis.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = its.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
LEFT JOIN tbl_users as us ON us.user_id = tis.issued_to
LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE DATE(inv.date_inserted) = '$date_inv'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();
        $res_success = 1;

        $item_status= "";
        if($row['inventory_status'] == 0){
          $item_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">LOST ITEM</span>';
        }
        if($row['inventory_status'] == 1){
          $item_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">GOOD CONDITION</span>';
        }
        if($row['inventory_status'] == 2){
          $item_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">DAMAGED</span>';
        }

        $temp_arr['brand']          = $row['brand'];
        $temp_arr['model']          = $row['model'];
        $temp_arr['category']       = $row['category_desc'];
        $temp_arr['specs']          = $row['description'];
        $temp_arr['category']       = $row['category_desc'];
        $temp_arr['date_inserted']  = date('F d,Y', strtotime($row['date_inserted']));
        $temp_arr['item_status']    = $item_status;
        $temp_arr['reference_no']   = $row['reference_no'];
        $temp_arr['issuance_code']  = $row['issuance_code'];

        $inventory[] = $temp_arr;

    }
}else{

    $res_message = "Query Failed";
}


$dateToday = date("M j, Y", strtotime(date("Y-m-d")));

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Items Inventory');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 5, 5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

$d_html = '
<div>
<p style="margin: 0; padding: 0; text-align: center; line-height: 0;">
<img src="../../../assets/images/logo.png"></p><br><br>
<h1 style="margin: 0; padding: 0; text-align: center; line-height: 0;">ITEMS INVENTORY</h1>
<p></p>
<br>
</div>
<table style="width: 50%; font-size: 12px;">
  <tr>
    <td colspan="2"><b>FILTERS:</b></td>
  </tr>
     <tr>
     <td>Date:</td>
          <td><b>'.$dateToday.'</b></td>
     </tr>
 
';

$d_html .='
</table>
<br><br>';

$d_html .= '

<table border="1" style=" padding: 5px;">
        <tr style="border: 1px solid black;">
        <th class="text-center" style = "text-align: center;"><b>Item Code</b></th>
        <th class="text-center" style = "text-align: center;"><b>Item</b></th>
        <th class="text-center" style = "text-align: center;"><b>Specifications</b></th>
        <th class="text-center" style = "text-align: center;"><b>Date</b></th>
        <th class="text-center" style = "text-align: center;"><b>Status</b></th>
        <th class="text-center" style = "text-align: center;"><b>Reference No.</b></th>
        </tr>
';
if ($inventory) {
  foreach ($inventory as $inv) {

$d_html .= '
        <tr>
        <td >'.$inv['issuance_code']. '</td>
        <td>'.$inv['brand'].' '.$inv['model'].'</td>
        <td>'.$inv['specs'].'</td>
        <td>'.$inv['date_inserted'].'</td>
        <td>'.$inv['item_status'].'</td>
        <td>'.$inv['reference_no'].'</td>
        </tr>
';
     }
    }else{

$d_html .= '
<tr>
<td style ="color: red" colspan ="5">No Records Found</td>
</tr>';

}

$d_html .= '               
        </table>
';

// Set some content to print
$html = <<<EOD

$d_html

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('IInventory.pdf', 'I');


?>