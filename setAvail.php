<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";
$localVars['exclude_template'] = TRUE;

$accessControl = array(); //Do not delete this line

include($engineDir ."/engineHeader.php");

recurseInsert("headerIncludes.php","php");

//$name = getComputerName();
isset($_GET['name']) ? $name = dbSanitize($_GET['name']) : $name = NULL;

if (!isnull($name)) {
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "UPDATE ".dbSanitize($dbTables["computers"])." SET availability = 'available' WHERE computer_name = '$name'";
	$resultArray = $engineVars['openDB']->query($sql);
}

include($engineDir ."/engineFooter.php");
?>
