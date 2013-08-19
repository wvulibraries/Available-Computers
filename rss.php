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

			$description = nl2br("Building: ".$row['building_name']."\nFloor: ".$row['floor_name']."\nAvailability: ".$row['availability']);

			localvars::add("computerName",$row['computer_name']);
			localvars::add("buildingName",(is_empty($row['building_name']))?"":$row['building_name']);
			localvars::add("floorName",(is_empty($row['floor_name']))?"":$row['floor_name']);
			localvars::add("availability",($row['availability'] == 'available')?"Available":"Unavailable");
			localvars::add("link",$engineVars['WVULSERVER']."/availableComputers/index.php?building="); //.$row['buildingID']."&amp;floor=".$row['floor'];
			localvars::add("description",$description);
			localvars::add("pubDate",$pubDate);
			?>

			<item>
				<title>{local var="computerName"}</title>
				<building>{local var="buildingName"}</building>
				<floor>{local var="floorName"}</floor>
				<availability>{local var="availability"}</availability>
				<link>{local var="link"}</link>
				<guid>{local var="link"}</guid>
				<description><![CDATA[ {local var="description"} ]]></description>
				<pubDate>{local var="pubDate"}</pubDate>
			</item>
			
			<?php

		}
	}
	?>

</channel>
</rss>
