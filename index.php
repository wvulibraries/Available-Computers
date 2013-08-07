<?php
include("header.php");

$errorMsg = NULL;
$output   = NULL;
$map      = isset($engine->cleanGet['MYSQL']['map']) ? $engine->cleanGet['MYSQL']['map'] : 2;

// Redirect old links
if (isset($engine->cleanGet['MYSQL']['building'])) {
	$floor = isset($engine->cleanGet['MYSQL']['floor']) ? $engine->cleanGet['MYSQL']['floor'] : 1;

	$sql = sprintf("SELECT `buildingFloors`.`ID`
					FROM `buildingFloors`
					LEFT JOIN `floors` ON `buildingFloors`.`floorID`=`floors`.`ID`
					WHERE `buildingFloors`.`buildingID`='%s' AND `floors`.`code`='%s'
					LIMIT 1",
		$engine->cleanGet['MYSQL']['building'],
		$floor
		);
	$sqlResult = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		$row = mysql_fetch_array($sqlResult['result'], MYSQL_NUM);
		header("Location: ?map=".$row[0], TRUE, 301);
	}
}
// Redirect old links

$sql = sprintf("SELECT * FROM `buildingFloors` WHERE ID='%s' LIMIT 1",
	$engine->openDB->escape($map)
	);
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	$row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC);
}

$availability = array(1=>'g','r',(checkGroup('webAvailableComputersAdmin') ? 'b' : 'r'));

$engine->eTemplate("include","header");

// If there is no css file for the given map
if (!file_exists('includes/css/map-'.$map.'.css')) {
	echo "No data yet.";
	exit;
}
?>

<link rel="stylesheet" href="/availableComputers/includes/css/map-<?php echo htmlSanitize($map) ?>.css" type="text/css" media="screen" />

<?php
$output .= '<div id="map-'.htmlSanitize($map).'" class="imgContainer">';

$sql = sprintf("SELECT DISTINCT `tableNameID`, `tableNames`.`name` AS `tableName`, `tableTypes`.`name` AS `tableType`
				FROM `computers`
				LEFT JOIN `tableNames` ON `computers`.`tableNameID`=`tableNames`.`ID`
				LEFT JOIN `tableTypes` ON `tableNames`.`tableTypeID`=`tableTypes`.`ID`
				WHERE `tableNames`.`buildingFloorID`='%s'",
	$engine->openDB->escape($map)
	);
$sqlResult = $engine->openDB->query($sql);

if (!$sqlResult['result']) {
	$errorMsg .= webHelper_errorMsg("Failed to retrieve tables.");
}
else {
	while ($table = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

		$output .= '<div class="'.$table['tableType'].'" id="'.$table['tableName'].'">';

		$sql = sprintf("SELECT `tableLocations`.`name` AS `tableLocation`, `availabilityID`, `computers`.`name` AS `computerName`
						FROM `computers`
						LEFT JOIN `tableLocations` ON `computers`.`tableLocationID`=`tableLocations`.`ID`
						WHERE `computers`.`tableNameID`='%s'",
			$engine->openDB->escape($table['tableNameID'])
			);
		$sqlResult2 = $engine->openDB->query($sql);

		if (!$sqlResult2['result']) {
			$errorMsg .= webHelper_errorMsg("Failed to retrieve computers.");
		}
		else {
			while ($row = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {
				if (!isnull($row['availabilityID'])) {
					$color = $availability[$row['availabilityID']];

					$output .= '<img class="'.$row['tableLocation'].'" alt="'.$row['computerName'].'" title="'.$row['computerName'].'" src="images/'.$table['tableType'].'/'.$color.'-'.$row['tableLocation'].'.gif" />';
				}

			}
		}

		$output .= "</div>";

	}
}

$output .= "</div>";


if (!isnull($errorMsg)) {
	print $errorMsg."<hr />";
}

print $output;
?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>
