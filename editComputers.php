<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");



$localVars['listLabel'] = "Computers";
$localVars['listTable'] = $dbTables["computers"];

$cols = array();
$cols[1]["table"] = "computer_name";
$cols[1]["label"] = "Name";

$cols[2]["table"] = "building";
$cols[2]["label"] = "Building";

$cols[3]["table"] = "floor";
$cols[3]["label"] = "Floor";

$cols[4]["table"] = "number";
$cols[4]["label"] = "Computer Number";

$cols[5]["table"] = "table_type";
$cols[5]["label"] = "Table Type";

$cols[6]["table"] = "table_location";
$cols[6]["label"] = "Table Location";

$cols[7]["table"] = "table_name";
$cols[7]["label"] = "Table Name";
?>

<!-- Page Content Goes Below This Line -->
<h3>Edit Computers</h3>

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

