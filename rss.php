<?php
require_once '/home/library/phpincludes/engine/engineAPI/3.2/engine.php';
$engine = EngineAPI::singleton();

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
// recurseInsert("dbTableList.php","php");
$engine->dbConnect("database","availableComputers",TRUE);

$pubDate = date('r');
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">

<channel>

	<title>WVU Libraries: Available Computers</title>
	<link>{engine var="WVULSERVER"}/availableComputers/rss.php</link>
	<atom:link href="{engine var="WVULSERVER"}/availableComputers/rss.php" rel="self" type="application/rss+xml" />
	<description></description>
	<lastBuildDate><?php echo $pubDate ?></lastBuildDate>
	<language>en-us</language>

	<?php
	$sql = sprintf("SELECT computers.name as computer_name, buildings.name as building_name, floors.name as floor_name, availabilities.name as availability FROM `computers` LEFT JOIN `buildings` ON computers.buildingID=buildings.ID LEFT JOIN tableNames ON tableNames.ID=computers.tableNameID LEFT JOIN floors ON floors.ID=tableNames.buildingFloorID LEFT JOIN availabilities ON availabilities.ID=computers.availabilityID ORDER BY buildings.name,floors.name,computers.name");
	$sqlResult = $engine->openDB->query($sql);

	if ($sqlResult['result']) {

		while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

			$link = $engineVars['WVULSERVER']."/availableComputers/index.php?building="; //.$row['buildingID']."&amp;floor=".$row['floor'];

			?>

			<item>
				<title><?php print $row['computer_name']; ?></title>
				<building><?php print (is_empty($row['building_name']))?"":$row['building_name']; ?></building>
				<floor><?php print (is_empty($row['floor_name']))?"":$row['floor_name']; ?></floor>
				<availability><?php print ($row['availability'] == 'available')?"Available":"Unavailable"; ?></availability>
				<link><?php print $link; ?></link>
				<guid><?php print $link; ?></guid>
				<description><![CDATA[ <?php print nl2br("Building: ".$row['building_name']."\nFloor: ".$row['floor_name']."\nAvailability: ".$row['availability']); ?> ]]></description>
				<pubDate><?php print $pubDate; ?></pubDate>
			</item>
			
			<?php

		}
	}
	?>

</channel>
</rss>
