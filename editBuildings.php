<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");
?>

<!-- Page Content Goes Below This Line -->
<h3>Edit all Buildings</h3>

<form method="post" action="submit.php">
	<?
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT * FROM ".dbSanitize($dbTables["buildings"]["prod"]);
	$outerResultArray = $engineVars['openDB']->query($sql);
	
	$num_buildings = $outerResultArray['affectedRows'];
	?>
	
	<table>
		<tr>
			<th>Delete</th>
			<th>Edit Names</th>
		</tr>
		
		<?
		for ($i = 0; $building = mysql_fetch_assoc($outerResultArray['result']); $i++) {
			
			?>
			<tr>
				<td>
					<input type="checkbox" name="delete_building_<?= $i ?>" />
				</td>
				<td>
					<input type="hidden" id="building_id_<?= $i ?>" name="building_id_<?= $i ?>" value="<?= htmlSanitize($building['building_id']) ?>" />
					<input type="text" id="building_name_<?= $i ?>" name="building_name_<?= $i ?>" value="<?= htmlSanitize($building['name']) ?>" class="buildingNameInput" />
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					
					<table>
						
						<?
						$engineVars['openDB']->sanitize = FALSE;
						$sql = "SELECT * FROM ".dbSanitize($dbTables["floors"]["prod"])." WHERE building_id = ".dbSanitize($building['building_id']);
						$innerResultArray = $engineVars['openDB']->query($sql);
						
						$num_floors = $innerResultArray['affectedRows'];
						
						for ($j = 0; $floor = mysql_fetch_assoc($innerResultArray['result']); $j++) {
							echo "<tr>\n";
							echo "<td style=\"width: 60px\">&nbsp;&nbsp;<input type=\"checkbox\" name=\"delete_floor_".$i."_".$j."\" /></td>\n";
							echo "<td><input type=\"text\" name=\"floor_code_".$i."_".$j."\" value=\"".htmlSanitize($floor['floor'])."\" class=\"floorCodeInput\" /></td>\n";
							echo "<td><input type=\"text\" name=\"floor_name_".$i."_".$j."\" value=\"".htmlSanitize($floor['floor_name'])."\" class=\"floorNameInput\" /><input type=\"hidden\" name=\"floor_id_".$i."_".$j."\" value=\"".htmlSanitize($floor['id'])."\" /></td>\n";
							echo "</tr>\n";
						}
						?>
						
					</table>
					
					<input type="hidden" id="num_floors_<?= $i ?>" name="num_floors_<?= $i ?>" value="<?= $num_floors ?>" />
					
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
