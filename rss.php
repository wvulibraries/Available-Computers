<?php
require_once '/home/library/phpincludes/engine/engineAPI/3.2/engine.php';
$engine = EngineAPI::singleton();

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
// recurseInsert("dbTableList.php","php");
$engine->dbConnect("database","availableComputers",TRUE);

$rssDate = date(DATE_RSS);

$rss = new syndication('availableComputers');

$rss->syndicationMetadata('title',         'WVU Libraries: Available Computers');
$rss->syndicationMetadata('link',          $engineVars['WVULSERVER'].'/availableComputers/rss.php');
$rss->syndicationMetadata('description',   'WVU Libraries: Available Computers');
$rss->syndicationMetadata('lastBuildDate', $rssDate);
$rss->syndicationMetadata('language',      'en-us');

$rss->addItemField('itemTitle');
$rss->addItemField('itemLink');
$rss->addItemField('itemPubdate');
$rss->addItemField('itemDescription');
$rss->addItemField('itemBuilding');
$rss->addItemField('itemFloor');
$rss->addItemField('itemAvailability');

$sql = sprintf("SELECT `computers`.`name` AS `computerName`, `buildings`.`name` AS `buildingName`, `buildingFloors`.`ID` AS `mapID`, `floors`.`name` AS `floorName`,
						`availabilities`.`name` AS `availability`, `computers`.`tableNameID` AS `tableName`, `computers`.`functionID`, `computers`.`buildingID`
				FROM `computers`
				LEFT JOIN `buildings` ON `buildings`.`ID`=`computers`.`buildingID`
				LEFT JOIN `availabilities` ON `availabilities`.`ID`=`computers`.`availabilityID`
				LEFT JOIN `tableNames` ON `tableNames`.`ID`=`computers`.`tableNameID`
				LEFT JOIN `buildingFloors` ON `buildingFloors`.`ID`=`tableNames`.`buildingFloorID`
				LEFT JOIN `floors` ON `floors`.`ID`=`buildingFloors`.`floorID`
				ORDER BY `buildings`.`name`, `floors`.`name`, `computers`.`name`");
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		if (isnull($row['tableName'])) {
			$link = $engineVars['WVULSERVER'].'/availableComputers/';
			if ($row['functionID'] == '3') {
				$link .= 'laptops.php?building='.$row['buildingID'];
			}
		}
		else {
			$link = $engineVars['WVULSERVER']."/availableComputers/?map=".$row['mapID'];
		}

		$rss->addItem(
			array(
				'itemTitle'        => htmlSanitize($row['computerName']),
				'itemLink'         => htmlSanitize($link),
				'itemPubdate'      => $rssDate,
				'itemDescription'  => htmlSanitize('Building: '.$row['buildingName']."\nFloor: ".$row['floorName']."\nAvailability: ".$row['availability']),
				'itemBuilding'     => htmlSanitize($row['buildingName']),
				'itemFloor'        => htmlSanitize($row['floorName']),
				'itemAvailability' => htmlSanitize($row['availability']),
				)
			);
	}
}

echo $rss->buildXML();
?>
