
<?php

// Include XLSX generator library
require_once 'PhpXlsxGenerator.php';

// Excel file name for download
$fileName = "v2fbaazar_membership_number-" . date('d-M-Y') . ".xlsx";

// Define column names
$excelData[] = array('Sl.', 'Membership Number', 'Vivah Mitra', 'Vivah Mitra Code');


if($membership_list){
    foreach($membership_list as $key => $row){
		//$status = ($row->status == 1)?'Active':'Inactive';
		$lineData = array($key+1, $row->membership_number, $row->vivahMitraName, $row->vivahMitraCode);
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData );
$xlsx->downloadAs($fileName);
exit;

?>

