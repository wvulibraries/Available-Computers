<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line
$localVars['pageTitle'] = "Available Computers";

$accessControl = array(); //Do not delete this line
$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");
?>

<!-- Page Content Goes Below This Line -->
<h3>Add a Building</h3>

<form method="post" action="submit.php" onsubmit="return validate('add_building')">
	
	Building Name: <input type="text" id="building_name" name="building_name" class="buildingNameInput" />
	
	<br /><br />
	
	How many Floors?
	<select id="num_floors" name="num_floors" onchange="displayRows(this, 'floor_names_container')">
		<option value="">--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
	</select>
	
	<br /><br />
	
	<div id="floor_names_container"></div>
	
	<br /><br />
	
	{engine name="insertCSRF"}
	<input type="submit" name="submitAddBuilding" value="Add Building" />
	<input type="reset" value="Reset Form" />
</form>
<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>
