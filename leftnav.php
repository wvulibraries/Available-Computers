<ul>
	<?
	global $dbTables;
	
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT * FROM ".dbSanitize($dbTables["buildings"])." ORDER BY name";
	$resultArray = $engineVars['openDB']->query($sql);
	
	while ($names = mysql_fetch_assoc($resultArray['result'])) {
		echo "<li>".htmlSanitize($names['name']);
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "SELECT * FROM ".dbSanitize($dbTables["floors"])."
						WHERE building_id = ".$names['building_id'];
		$resultArray2 = $engineVars['openDB']->query($sql);
		
		if ($resultArray2['affectedRows'] > 0) {
			echo "<ul>";
			while ($floors = mysql_fetch_assoc($resultArray2['result'])) {
				echo "<li><a href=\"index.php?building=".$names['building_id']."&floor=".$floors['floor']."\">".htmlSanitize($floors['floor_name'])."</a></li>";
			}
			echo "</ul>";
		}
		
		echo "</li>";
	}

	if (checkGroup('webAvailableComputersAdmin')) {
		?>
		<li>
			Administrative Tools
			<ul>
				<li><a href="addBuilding.php" alt="Add a Building">Add Building</a></li>
				<li><a href="editBuildings.php" alt="Edit Buildings">Edit Buildings</a></li>
				<li><a href="editComputers.php" alt="Edit Computer Listing">Edit Computer Listing</a></li>
				<li><a href="generateStats.php" alt="View Usage Statistics">View Usage Statistics</a></li>
				<li><a href="<?= $engineVars['logoutPage'] ?>">Logout</a></li>
			</ul>
		</li>
		<?
	}
	?>

</ul>
