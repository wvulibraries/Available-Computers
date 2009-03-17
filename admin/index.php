<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");

$localVars['siteRoot'] = $engineVars['WVULSERVER']."/availableComputers";
?>

<!-- Page Content Goes Below This Line -->
<?
header("Location: " . $localVars['siteRoot']);
?>
<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>