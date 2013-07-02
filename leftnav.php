<?php global $engine ?>

<ul>
	<?php
	$sql = sprintf("SELECT * FROM %s ORDER BY name",
		$engine->openDB->escape($engine->dbTables("buildings"))
		);
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		while ($names = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {

			print "<li>".htmlSanitize($names['name']);

			$sql = sprintf("SELECT * FROM %s AS buildingFloors LEFT JOIN %s AS floors ON floors.id=buildingFloors.floor_id WHERE buildingFloors.building_id='%s' ORDER BY buildingFloors.id",
				$engine->openDB->escape($engine->dbTables("buildingFloors")),
				$engine->openDB->escape($engine->dbTables("floors")),
				$engine->openDB->escape($names['building_id'])
				);
			$engine->openDB->sanitize = FALSE;
			$sqlResult2               = $engine->openDB->query($sql);

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
