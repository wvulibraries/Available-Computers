<?php
include("header.php");

$output       = '';
$buildingID   = isset($engine->cleanGet['MYSQL']['building']) ? $engine->cleanGet['MYSQL']['building'] : 1;
$availability = array(1=>'g','r',(checkGroup('webAvailableComputersAdmin') ? 'b' : 'r'));

try {
	$sql = sprintf("SELECT `name` FROM `buildings` WHERE `ID`='%s' LIMIT 1",
		$engine->openDB->escape($buildingID)
		);
	$sqlResult = $engine->openDB->query($sql);

	if (!$sqlResult['result']) {
		throw new Exception("Invalid building.");
	}

	$row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC);
	$buildingName = $row['name'];

	$sql = sprintf("SELECT DISTINCT `osID`, `operatingSystems`.`name`
					FROM `computers`
					LEFT JOIN `operatingSystems` ON `operatingSystems`.`ID`=`computers`.`osID`
					WHERE `buildingID`='%s' AND `functionID`='3'",
		$engine->openDB->escape($buildingID)
		);
	$sqlResult = $engine->openDB->query($sql);

	if (!$sqlResult['result']) {
		throw new Exception("Failed to retrieve Operating Systems.");
	}

	$output .= '<header><h1>'.htmlSanitize($buildingName).'</h1></header>';

	$output .= '<section class="row-fluid">';
	$osCount = $sqlResult['numRows'];

	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		$output .= '<div class="span'.(floor(12/$osCount)).'">';
		$output .= '<header><h2>'.ucfirst(htmlSanitize($row['name'])).'</h2></header>';
		$output .= '<ul class="laptopList">';

		$sql = sprintf("SELECT `name`, `availabilityID` FROM `computers` WHERE `buildingID`='%s' AND `functionID`='3' AND `osID`='%s' ORDER BY `name`",
			$engine->openDB->escape($buildingID),
			$engine->openDB->escape($row['osID'])
			);
		$sqlResult2 = $engine->openDB->query($sql);

		if (!$sqlResult2['result']) {
			throw new Exception("Failed to retrieve Computers.");
		}

		while ($row2 = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {
			$output .= sprintf('<li class="%s">%s</li>',
				htmlSanitize(isset($availability[ $row2['availabilityID'] ]) ? $availability[ $row2['availabilityID'] ] : 'r'),
				htmlSanitize($row2['name'])
				);
		}

		$output .= '</ul>';
		$output .= '</div>';
	}

	$output .= '</section>';

}
catch (Exception $e) {
	errorHandle::errorMsg($e->getMessage());
}


$engine->eTemplate("include","header");

if (!is_empty($engine->errorStack)) {
	print errorHandle::prettyPrint()."<hr />";
}

print $output;

$engine->eTemplate("include","footer");
?>
