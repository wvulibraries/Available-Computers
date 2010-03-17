<?
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line
$localVars['exclude_template'] = TRUE;

$accessControl = array(); //Do not delete this line

include($engineDir ."/engineHeader.php");

$pubDate = date('r');
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	
	<title>WVU Libraries: Available Computers</title>
	<link>http://systems.lib.wvu.edu/availableComputers/rss.php</link>
	<atom:link href="http://systems.lib.wvu.edu/availableComputers/rss.php" rel="self" type="application/rss+xml" />
	<description></description>
	<lastBuildDate><?= $pubDate ?></lastBuildDate>
	<language>en-us</language>
		
	<?
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT * FROM ".dbSanitize($dbTables["computers"]["prod"])." ORDER BY computer_name";
	$resultArray = $engineVars['openDB']->query($sql);
	
	while ($row = mysql_fetch_assoc($resultArray['result'])) {
		
		if ($row['availability'] == 'available') {
			$row['availability'] = "Available";
		}
		else {
			$row['availability'] = "Unavailable";
		}
		
		$link = $guid = "http://systems.lib.wvu.edu/availableComputers/index.php?building=".$row['building']."&amp;floor=".$row['floor'];
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "SELECT name FROM ".dbSanitize($dbTables["buildings"]["prod"])." WHERE building_id = '".$row['building']."'";
		$innerResultArray = $engineVars['openDB']->query($sql);
		$building = mysql_fetch_assoc($innerResultArray['result']);
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "SELECT floor_name FROM ".dbSanitize($dbTables["floors"]["prod"])." WHERE building_id = '".$row['building']."' AND floor = '".$row['floor']."'";
		$innerResultArray = $engineVars['openDB']->query($sql);
		$floor = mysql_fetch_assoc($innerResultArray['result']);
		
		$row['building'] = $building['name'];
		$row['floor'] = $floor['floor_name'];
		
		$description = nl2br("Building: ".$row['building']."\nFloor: ".$row['floor']."\nAvailability: ".$row['availability']);
		
		?><item>
			<title><?= $row['computer_name'] ?></title>
			<building><?= $row['building'] ?></building>
			<floor><?= $row['floor'] ?></floor>
			<availability><?= $row['availability'] ?></availability>
			<link><?= $link ?></link>
			<guid><?= $guid ?></guid>
			<description><![CDATA[ <?= $description ?> ]]></description>
			<pubDate><?= $pubDate ?></pubDate>
		</item>
		<?
		
	}
	?>
</channel>
</rss>