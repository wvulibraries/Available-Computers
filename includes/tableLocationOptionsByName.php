<?php
require("../header.php");
recurseInsert("acl.php","php");

$tableNameID = isset($engine->cleanGet['MYSQL']['tableNameID']) ? $engine->cleanGet['MYSQL']['tableNameID'] : NULL;

if (isnull($tableNameID)) {
	errorHandle::newError("No Table Name ID given.",errorHandle::DEBUG);
	die;
}

$sql = sprintf("SELECT `tableLocations`.`ID` AS `tableLocationID`, `tableLocations`.`name` AS `tableLocation`
				FROM `tableLocations`
				LEFT JOIN `tableTypeLocs` ON `tableTypeLocs`.`tableLocationID`=`tableLocations`.`ID`
				LEFT JOIN `tableNames` ON `tableNames`.`tableTypeID`=`tableTypeLocs`.`tableTypeID`
				WHERE `tableNames`.`ID`='%s'",
	$engine->openDB->escape($tableNameID)
	);
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		printf('<option value="%s">%s</option>',
			htmlSanitize($row['tableLocationID']),
			htmlSanitize($row['tableLocation'])
			);
	}
}
?>
