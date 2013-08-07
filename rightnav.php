<?php
$sql = sprintf("SELECT * FROM `buildings` ORDER BY name");
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	$tmp = '';
	while ($names = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		$tmp .= '<li>'.htmlSanitize($names['name']).'</li>';

		$sql = sprintf("SELECT `buildingFloors`.`ID`, `floors`.`name`
						FROM `buildingFloors`
						LEFT JOIN `floors` ON `floors`.`ID`=`buildingFloors`.`floorID`
						WHERE `buildingFloors`.`buildingID`='%s'
						ORDER BY `buildingFloors`.`ID`",
			$engine->openDB->escape($names['ID'])
			);
		$sqlResult2 = $engine->openDB->query($sql);

		if ($sqlResult2['result']) {
			while ($floors = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {
				$tmp .= '<li><a href="index.php?map='.htmlSanitize($floors['ID']).'">'.htmlSanitize($floors['name']).'</a></li>';
			}
		}
	}
	localVars::add("navList", $tmp);
}
?>

<ul>
	{local var="navList"}
</ul>
