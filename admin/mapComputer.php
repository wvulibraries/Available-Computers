<?php
require("../header.php");
recurseInsert("acl.php","php");

$ID = isset($engine->cleanGet['MYSQL']['id']) ? $engine->cleanGet['MYSQL']['id'] : NULL;

localVars::add('listTable', 'computers');

function listFields($ID) {
	$engine = EngineAPI::singleton();
	$l      = new listManagement(localVars::get('listTable'));
	$l->updateInsert   = TRUE;
	$l->updateInsertID = "ID";

	$sql = sprintf("SELECT `computers`.*, `buildingFloors`.`buildingID`, `buildingFloors`.`floorID`
					FROM `computers`
					LEFT JOIN `tableNames` ON `computers`.`tableNameID`=`tableNames`.`ID`
					LEFT JOIN `buildingFloors` ON `tableNames`.`buildingFloorID`=`buildingFloors`.`ID`
					WHERE `computers`.`ID`='%s'
					LIMIT 1",
		$engine->openDB->escape($ID)
		);
	$sqlResult = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		$row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC);
		localVars::add("computerName", $row['name']);
	}

	$buildings = array(
		array(
			'value' => '',
			'label' => 'Do Not Display on Map',
			),
		);
	$buildings = array_merge($buildings, getMetadataOptions('buildings', $row['buildingID']));

	$l->addField(array(
		'field' => 'ID',
		'label' => 'Computer ID',
		'type'  => 'hidden',
		'value' => $ID,
		));

	$l->addField(array(
		'field'   => 'buildingID',
		'label'   => 'Building',
		'type'    => 'select',
		'options' => $buildings,
		));

	$l->addField(array(
		'field'   => 'floorID',
		'label'   => 'Floor',
		'type'    => 'select',
		'options' => getMetadataOptions('floors', $row['floorID']),
		));

	$l->addField(array(
		'field'   => 'tableNameID',
		'label'   => 'Table Name',
		'type'    => 'select',
		'options' => getMetadataOptions('tableNames', $row['tableNameID']),
		));

	$l->addField(array(
		'field'   => 'tableLocationID',
		'label'   => 'Table Location',
		'type'    => 'select',
		'options' => getMetadataOptions('tableLocations', $row['tableLocationID']),
		));

	return $l;
}


// Form Submission
if(isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {
	$listObj = listFields($ID);
	$listObj->insert();
}
// Form Submission

$listObj = listFields($ID);

localVars::add("results",    displayErrorStack());
localVars::add("insertForm", $listObj->displayInsertForm());

$engine->eTemplate("include","header");
?>

<h1>Edit Computers</h1>

{local var="results"}

<h2>Map Computer - {local var="computerName"}</h2>
{local var="insertForm"}

<script type="text/javascript">
	var insertForm              = $('.insertForm');
	var buildingID_insert       = insertForm.find('select[name=buildingID_insert]');
	var floorID_insert          = insertForm.find('select[name=floorID_insert]');
	var tableNameID_insert      = insertForm.find('select[name=tableNameID_insert]');
	var tableLocationID_insert  = insertForm.find('select[name=tableLocationID_insert]');
	var floor_options           = {};
	var tableName_options       = {};
	var tableLocation_options   = {};

	buildingID_insert.on('change', function() {
		var selectedBuildingID = buildingID_insert.val();

		if (!selectedBuildingID) {
			floorID_insert.html([]);
		}
		else if (floor_options[selectedBuildingID]) {
			floorID_insert.html(floor_options[selectedBuildingID]);
		}
		else {
			$.ajax({
				url: "../includes/floorOptionsByBuilding.php",
				data: {
					id: selectedBuildingID
				},
				context: floorID_insert
			}).done(function(response) {
				floor_options[selectedBuildingID] = response;
				$(this).html(response);
			});
		}
	}).change();

	floorID_insert.on('change', function() {
		var selectedFloorID = floorID_insert.val();

		if (!selectedFloorID) {
			tableNameID_insert.html([]);
		}
		else if (tableName_options[selectedFloorID]) {
			tableNameID_insert.html(tableName_options[selectedFloorID]);
		}
		else {
			$.ajax({
				url: "../includes/tableNameOptionsByFloor.php",
				data: {
					buildingID: buildingID_insert.val(),
					floorID: selectedFloorID
				},
				context: tableNameID_insert
			}).done(function(response) {
				tableName_options[selectedFloorID] = response;
				$(this).html(response);
			});
		}
	}).change();

	tableNameID_insert.on('change', function() {
		var selectedTableNameID = tableNameID_insert.val();

		if (!selectedTableNameID) {
			tableLocationID_insert.html([]);
		}
		else if (tableName_options[selectedTableNameID]) {
			tableLocationID_insert.html(tableName_options[selectedTableNameID]);
		}
		else {
			$.ajax({
				url: "../includes/tableLocationOptionsByName.php",
				data: {
					tableNameID: selectedTableNameID
				},
				context: tableLocationID_insert
			}).done(function(response) {
				tableName_options[selectedTableNameID] = response;
				$(this).html(response);
			});
		}
	}).change();
</script>

<?php
$engine->eTemplate("include","footer");
?>
