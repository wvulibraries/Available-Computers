<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");



$localVars['listLabel'] = "Computers";
$localVars['listTable'] = $dbTables["computers"]["prod"];

$cols = array();
$cols[1]["table"] = "computer_name";
$cols[1]["label"] = "Name";

$cols[2]["table"] = "os";
$cols[2]["label"] = "OS";

$cols[3]["table"] = "function";
$cols[3]["label"] = "Function";

$cols[4]["table"] = "building";
$cols[4]["label"] = "Building";

$cols[5]["table"] = "floor";
$cols[5]["label"] = "Floor";

$cols[6]["table"] = "table_type";
$cols[6]["label"] = "Table Type";

$cols[7]["table"] = "table_location";
$cols[7]["label"] = "Table Loc.";

$cols[8]["table"] = "table_name";
$cols[8]["label"] = "Table ID";



// Form Submission
if(isset($cleanPost['MYSQL']['newSubmit'])) {
	
	$output = webHelper_listMultiInsert($localVars['listTable'],$localVars['listLabel'],$cols);

	echo $output;

}

else if (isset($cleanPost['MYSQL']['updateSubmit'])) {
	
	$output = webhelper_listMultiUpdate($localVars['listTable'],$cols);
	
	echo $output;
	
}
// Form Submission

?>

<!-- Page Content Goes Below This Line -->
<h2>Edit Computer Listings</h2>

<?
$output = "";

foreach ($cols as $I => $col) {
	
	$output .= "col".$I."=\"".$col["table"]."\" col".$I."label=\"".$col["label"]."\" ";
	
}
?>

{engine name="function" function="webHelper_listMultiAdd" table="{local var="listTable"}" label="{local var="listLabel"}" cols="<?= count($cols) ?>" <?= $output ?>}

<hr />

{engine name="function" function="webHelper_listMultiEditList" table="{local var="listTable"}" cols="<?= count($cols) ?>" <?= $output ?>}

<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>

