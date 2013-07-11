<?php
require("../header.php");
recurseInsert("acl.php","php");

$buildingID = isset($engine->cleanGet['MYSQL']['id']) ? $engine->cleanGet['MYSQL']['id'] : NULL;

if (isnull($buildingID)) {
	errorHandle::newError("No Building ID given.",errorHandle::DEBUG);
	die;
}

$sql = sprintf("SELECT `buildingFloors`.`floorID`, `floors`.`name` AS `floorName`
				FROM `buildingFloors`
				LEFT JOIN `floors` ON `floors`.`ID`=`buildingFloors`.`floorID`
				WHERE `buildingFloors`.`buildingID`='%s'",
	$engine->openDB->escape($buildingID)
	);
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		printf('<option value="%s">%s</option>',
			htmlSanitize($row['floorID']),
			htmlSanitize($row['floorName'])
			);
	}
}
?>
