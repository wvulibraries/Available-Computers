<?php
require("../header.php");
recurseInsert("acl.php","php");

$buildingID = isset($engine->cleanGet['MYSQL']['buildingID']) ? $engine->cleanGet['MYSQL']['buildingID'] : NULL;
$floorID    = isset($engine->cleanGet['MYSQL']['floorID'])    ? $engine->cleanGet['MYSQL']['floorID']    : NULL;

if (isnull($buildingID)) {
	errorHandle::newError("No Building ID given.",errorHandle::DEBUG);
	die;
}
if (isnull($floorID)) {
	errorHandle::newError("No Floor ID given.",errorHandle::DEBUG);
	die;
}

$sql = sprintf("SELECT `tableNames`.`ID` AS `tableNameID`, `tableNames`.`name` AS `tableName`
				FROM `tableNames`
				LEFT JOIN `buildingFloors` ON `buildingFloors`.`ID`=`tableNames`.`buildingFloorID`
				WHERE `buildingFloors`.`buildingID`='%s' AND `buildingFloors`.`floorID`='%s'",
	$engine->openDB->escape($buildingID),
	$engine->openDB->escape($floorID)
	);
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		printf('<option value="%s">%s</option>',
			htmlSanitize($row['tableNameID']),
			htmlSanitize($row['tableName'])
			);
	}
}
?>
