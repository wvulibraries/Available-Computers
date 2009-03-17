<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

include($engineDir ."/engineHeader.php");
?>

<!-- Page Content Goes Below This Line -->
<h3>Edit all Buildings</h3>

<form method="post" action="submit.php" onsubmit="return validate('edit_buildings')">
	<?
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT * FROM ".dbSanitize($dbTables["buildings"]);
	$outerResultArray = $engineVars['openDB']->query($sql);
	
	$num_buildings = $outerResultArray['affectedRows'];
	?>
	
	<table>
		<tr>
			<th>Delete</th>
			<th>Edit Names</th>
		</tr>
		
		<?
		while ($building = mysql_fetch_assoc($outerResultArray['result'])) {
			?>
			<tr>
				<td>
					<input type="checkbox" name="delete_building_<?= htmlSanitize($building['building_id']) ?>" />
				</td>
				<td>
					<input type="text" id="building_<?= htmlSanitize($building['building_id']) ?>" name="building_<?= htmlSanitize($building['building_id']) ?>" value="<?= htmlSanitize($building['name']) ?>" class="buildingNameInput" />
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					
					<table>
						
						<?
						$engineVars['openDB']->sanitize = FALSE;
						$sql = "SELECT * FROM ".dbSanitize($dbTables["floors"])." WHERE building_id = ".dbSanitize($building['building_id']);
						$innerResultArray = $engineVars['openDB']->query($sql);
						
						while ($floor = mysql_fetch_assoc($innerResultArray['result'])) {
							echo "<tr>";
							echo "<td style=\"width: 60px\"><input type=\"checkbox\" name=\"delete_floor_".htmlSanitize($floor['id'])."\" /></td>\n";
							echo "<td><input type=\"text\" name=\"floor_code_".htmlSanitize($floor['id'])."\" value=\"".htmlSanitize($floor['floor'])."\" class=\"floorCodeInput\" /></td>\n";
							echo "<td><input type=\"text\" name=\"floor_name_".htmlSanitize($floor['id'])."\" value=\"".htmlSanitize($floor['floor_name'])."\" class=\"floorNameInput\" /></td>\n";
							echo "</tr>";
						}
						?>
						
					</table>
					
				</td>
			</tr>
			<?
		}
		?>
		
		</tr>
	</table>
	
	<br />
	
	{engine name="insertCSRF"}
	<input type="hidden" id="num_buildings" name="num_buildings" value="<?= $num_buildings ?>" />
	<input type="submit" name="submitEditBuildings" value="Submit Changes" />
	<input type="reset" value="Reset Form" />
</form>
<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>
