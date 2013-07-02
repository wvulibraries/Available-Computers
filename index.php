<?php
include("header.php");
?>

<!-- Page Content Goes Below This Line -->

<?php
$errorMsg = NULL;
$output   = NULL;
$building = isset($engine->cleanGet['MYSQL']['building']) ? $engine->cleanGet['MYSQL']['building'] : 1;
$floor    = isset($engine->cleanGet['MYSQL']['floor'])    ? $engine->cleanGet['MYSQL']['floor']    : 1;

// If there is no css file for the given building and floor
if (!file_exists("includes/css/$building-$floor.css")) {
	echo "No data yet.";
	exit;
}
?>

<link rel="stylesheet" href="/availableComputers/includes/css/<?php echo $building."-".$floor ?>.css" type="text/css" media="screen" />

<?php
$output .= '<div id="map-'.$building.'-'.$floor.'" class="imgContainer">';

$sql = sprintf("SELECT DISTINCT computers.table_name, tableTypes.name FROM `computers` LEFT JOIN `tableTypes` ON computers.table_type=tableTypes.id WHERE computers.building='%s' AND computers.floor='%s'",
	$engine->openDB->escape($building),
	$engine->openDB->escape($floor)
	);
$engine->openDB->sanitize = FALSE;
$sqlResult                = $engine->openDB->query($sql);

if (!$sqlResult['result']) {
	$errorMsg .= webHelper_errorMsg("Failed to retrieve tables.");
}
else {
	while ($table = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

		$output .= '<div class="'.$table['name'].'" id="'.$table['table_name'].'">';

		$sql = sprintf("SELECT table_location, availability, computer_name FROM `computers` WHERE building='%s' AND floor='%s' AND table_name='%s'",
			$engine->openDB->escape($building),
			$engine->openDB->escape($floor),
			$engine->openDB->escape($table['table_name'])
			);
		$engine->openDB->sanitize = FALSE;
		$sqlResult2               = $engine->openDB->query($sql);

		if (!$sqlResult2['result']) {
			$errorMsg .= webHelper_errorMsg("Failed to retrieve computers.");
		}
		else {
			while ($row = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {

				if (!isnull($row['availability'])) {
					if ($row['availability'] == "available") {
						$color = "g";
					}
					else if ($row['availability'] == "offline" && checkGroup('webAvailableComputersAdmin')) {
						$color = "b";
					}
					else {
						$color = "r";
					}

					$output .= '<img class="'.$row['table_location'].'" alt="'.$row['computer_name'].'" title="'.$row['computer_name'].'" src="/availableComputers/images/'.$table['name'].'/'.$color.'-'.$row['table_location'].'.gif" />';
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
