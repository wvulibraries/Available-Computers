<ul>
	<?php
	$sql = sprintf("SELECT * FROM `buildings` ORDER BY name");
	$sqlResult = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		while ($names = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

			print "<li>".htmlSanitize($names['name']);

			$sql = sprintf("SELECT * FROM `buildingFloors` LEFT JOIN `floors` ON floors.id=buildingFloors.floor_id WHERE buildingFloors.building_id='%s' ORDER BY buildingFloors.id",
				$engine->openDB->escape($names['building_id'])
				);
			$sqlResult2 = $engine->openDB->query($sql);

			if ($sqlResult2['result']) {
				print "<ul>";
				while ($floors = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {
					print "<li>";
					print "<a href=\"index.php?building=".$names['building_id']."&floor=".$floors['floor']."\">";
					print htmlSanitize($floors['floor_name']);
					print "</a>";
					print "</li>";
				}
				print "</ul>";
			}

			print "</li>";

		}

	}
	?>
</ul>
