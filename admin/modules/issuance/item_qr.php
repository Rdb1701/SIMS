<?php
include('../../includes/connection.php');
date_default_timezone_set('Asia/Manila');

require_once '../../../libraries/tcpdf/tcpdf.php';

$issuance_id = mysqli_real_escape_string($db, trim($_GET['IssuanceID']));
$reference_no = '';
$qr        = '';
$model     = '';
$brand     = '';
$category  = '';
$specs     = '';
$fname     = '';
$lname     = '';
$issuance_code = '';
$department = '';


$query = "
SELECT tis.*, i.model, i.brand, c.category_desc, i.description, us.fname, us.lname, d.dept_name
 FROM  tbl_issuance_transaction as tis
 LEFT JOIN tbl_item_stock as its ON its.item_stock_id = tis.item_stock_id
 LEFT JOIN tbl_items as i ON i.item_id = its.item_id
 LEFT JOIN tbl_category as c ON c.category_id = i.category_id
 LEFT JOIN tbl_users as us ON us.user_id = tis.issued_to
 LEFT JOIN tbl_department as d ON d.department_id = us.department_id
WHERE issuance_id = '$issuance_id'
";
$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    $row = $result->fetch_assoc();

    $qr            = $row['qr'];
    $model         = $row['model'];
    $brand         = $row['brand'];
    $category      = $row['category_desc'];
    $specs         = $row['description'];
    $fname         = $row['fname'];
    $lname         = $row['lname'];
    $issuance_code = $row['issuance_code'];
    $department    = $row['dept_name'];

}else{
    echo 'Cannot Execute!';
}

// For the contatanation of the qr/bar code
$q   =  substr("$reference_no",0,4);
$w   =  substr("$reference_no",5,-12);
$e   =  substr("$reference_no",8,-9);
$r   =  substr("$reference_no",11,-6);
$t   =  substr("$reference_no",14,-3);
$y   =  substr("$reference_no",-2);

// $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
$concatqr = $q.$w.$e.$r.$t.$y;

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OSA');
$pdf->SetTitle('Clearance');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15, 15, 15);

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

<p></p>

<br>

</div>

<table border="1" style=" padding: 5px;">
<tr style="border: 1px solid black;">
    <th style="font-size: 15px; padding: 10%; text-align: center;  font-weight: bold;"><b><img src="'.$qr.'" style=" display: flex; margin: 0; padding: 0; line-height: 0;"></b></th>
    <th style="font-size: 15px;  padding: 10%; text-align: left;  "><b>Item:</b> '.$brand.' '.$model.'<br><b>Specs:</b> '.$specs.'<br><b>Item Code:</b> '.$issuance_code.'</th>
</tr>
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
$pdf->Output('item_Qr.pdf', 'I');

?>