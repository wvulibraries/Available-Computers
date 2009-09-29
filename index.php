<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line
$localVars['pageTitle'] = "Available Computers";

$accessControl = array(); //Do not delete this line

include($engineDir ."/engineHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?
isset($_GET['building']) ? $building = dbSanitize($_GET['building']) : $building = 1;
isset($_GET['floor']) ? $floor = dbSanitize($_GET['floor']) : $floor = 1;

// If there is no css file for the given building and floor
if (!file_exists("includes/css/$building-$floor.css")) {
	echo "No data yet.";
	exit;
}
?>

<link rel="stylesheet" href="/availableComputers/includes/css/<?= $building."-".$floor ?>.css" type="text/css" media="screen" />

<?
$engineVars['openDB']->sanitize = FALSE;
$sql = "SELECT name, floor_name FROM ".dbSanitize($dbTables["buildings"]["prod"])." AS b LEFT JOIN ".dbSanitize($dbTables["floors"]["prod"])." AS f ON b.building_id = f.building_id WHERE b.building_id = '$building' AND f.floor = '$floor'";
$resultArray = $engineVars['openDB']->query($sql);

$row = mysql_fetch_assoc($resultArray['result']);
?>

<h2><?= $row['name']." - ".$row['floor_name'] ?></h2>

<br />

<div id="map-<?= $building."-".$floor ?>" class="imgContainer">
	
	<?
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT DISTINCT table_name, table_type FROM ".dbSanitize($dbTables["computers"]["prod"])." WHERE building = '$building' AND floor = '$floor'";
	$outerResultArray = $engineVars['openDB']->query($sql);

	while ($table = mysql_fetch_assoc($outerResultArray['result'])) {
		
		echo "<div class=\"".$table['table_type']."\" id=\"".$table['table_name']."\">\n";
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "SELECT table_location, availability, computer_name FROM ".dbSanitize($dbTables["computers"]["prod"])." WHERE building = '$building' AND floor = '$floor' AND table_name = '".$table['table_name']."'";
		$innerResultArray = $engineVars['openDB']->query($sql);
		
		while ($row = mysql_fetch_assoc($innerResultArray['result'])) {
			
			if (!isnull($row['availability'])) {
				
				if ($row['availability'] == "available") {
					$color = "g";
				}
				else if ($row['availability'] == "offline" && checkGroup('webAvailableComputersAdmin')) {
					$color = "b";
				}
				else {
					$color = "r";
				}
				
				echo "<img class=\"".$row['table_location']."\" alt=\"".$row['computer_name']."\" title=\"".$row['computer_name']."\" src=\"/availableComputers/images/".$table['table_type']."/".$color."-".$row['table_location'].".gif\" />\n";
				
			}
			
		}
		
		echo "</div>\n";
		
	}
	?>
	
</div>
<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>