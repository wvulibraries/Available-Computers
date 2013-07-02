<?php
$engineDir = "/home/library/phpincludes/engineAPI/engine";
include($engineDir ."/engine.php");
$engine = new EngineCMS();

recurseInsert("dbTableList.php","php");
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
	$sql = sprintf("SELECT * FROM `computers` ORDER BY building,floor,computer_name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

			if ($row['availability'] == 'available') {
				$row['availability'] = "Available";
			}
			else {
				$row['availability'] = "Unavailable";
			}

			$link = $guid = $engineVars['WVULSERVER']."/availableComputers/index.php?building=".$row['building']."&amp;floor=".$row['floor'];

			$sql = sprintf("SELECT name FROM `buildings` WHERE building_id='%s'",
				$engine->openDB->escape($row['building'])
				);
			$engine->openDB->sanitize = FALSE;
			$sqlResult2               = $engine->openDB->query($sql);
			$building                 = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC);

			$sql = sprintf("SELECT floor_name FROM `floors` WHERE floor='%s'",
				$engine->openDB->escape($row['building']),
				$engine->openDB->escape($row['floor'])
				);
			$engine->openDB->sanitize = FALSE;
			$sqlResult2               = $engine->openDB->query($sql);
			$floor                    = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC);

			$row['building'] = $building['name'];
			$row['floor'] = $floor['floor_name'];
			$description = nl2br("Building: ".$row['building']."\nFloor: ".$row['floor']."\nAvailability: ".$row['availability']);

			?><item>
				<title><?php echo $row['computer_name'] ?></title>
				<building><?php echo $row['building'] ?></building>
				<floor><?php echo $row['floor'] ?></floor>
				<availability><?php echo $row['availability'] ?></availability>
				<link><?php echo $link ?></link>
				<guid><?php echo $guid ?></guid>
				<description><![CDATA[ <?php echo $description ?> ]]></description>
				<pubDate><?php echo $pubDate ?></pubDate>
			</item>
			<?php

		}
	}
	?>
</channel>
</rss>
