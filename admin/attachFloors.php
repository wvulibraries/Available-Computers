<?
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?
$errorMsg = NULL;
$engine->localVars("listTable",$engine->dbTables("buildings"));

function listFields() {
	
	global $engine;

	$listObj = new listManagement($engine,$engine->localVars("listTable"));
	$listObj->updateInsert   = TRUE;
	$listObj->updateInsertID = "building_id";
	
	$options = array();
	$options['field'] = "building_id";
	$options['label'] = "buildingID";
	$options['type']  = "hidden";
	$options['value'] = $engine->cleanGet['MYSQL']['id'];
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "ms_floors";
	$options['label'] = "Floors";
	$options['type']  = "multiselect";

	$options['options'] = array();
	$options['options']['valueTable']        = $engine->dbTables("floors");
	$options['options']['valueDisplayField'] = "floor_name";
	$options['options']['valueDisplayID']    = "id";

	$options['options']['linkTable']         = $engine->dbTables("buildingFloors");
	$options['options']['linkValueField']    = "floor_id";
	$options['options']['linkObjectField']   = "building_id";

		$sql = sprintf("SELECT floor_id FROM %s WHERE building_id='%s'",
			$engine->openDB->escape($engine->dbTables("buildingFloors")),
			$engine->cleanGet['MYSQL']['id']
		);

		$engine->openDB->sanitize = FALSE;
		$sqlResult                = $engine->openDB->query($sql);
		
		$tempList = array();
		while ($row = mysql_fetch_array($sqlResult['result'],  MYSQL_ASSOC)) {
			$tempList[] = $row['floor_id'];
		}
		
		$options['options']['select'] = implode(",",$tempList);

	$listObj->addField($options);
	unset($options);

	return $listObj;

}

$listObj = listFields();

// Form Submission
if(isset($engine->cleanPost['MYSQL'][$engine->localVars("listTable").'_submit'])) {
	
	$errorMsg .= $listObj->insert();
	$listObj = listFields();

}
// Form Submission
?>

<h2>Manage Buildings</h2>

<?
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>Edit Floors</h3>
<?= $listObj->displayInsertForm(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

