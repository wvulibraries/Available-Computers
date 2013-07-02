<?php
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?php
$errorMsg = NULL;
localVars::add('listTable', 'buildings');

function listFields() {
	$engine = EngineAPI::singleton();

	$listObj = new listManagement($engine,localVars::get('listTable'));
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
	$options['options']['valueTable']        = 'floors';
	$options['options']['valueDisplayField'] = "floor_name";
	$options['options']['valueDisplayID']    = "id";

	$options['options']['linkTable']         = 'buildingFloors';
	$options['options']['linkValueField']    = "floor_id";
	$options['options']['linkObjectField']   = "building_id";

		$sql = sprintf("SELECT floor_id FROM `buildingFloors` WHERE building_id='%s'",
			$engine->cleanGet['MYSQL']['id']
		);

		$sqlResult = $engine->openDB->query($sql);

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
if(isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {

	$errorMsg .= $listObj->insert();
	$listObj = listFields();

}
// Form Submission
?>

<h2>Manage Buildings</h2>

<?php
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>Edit Floors</h3>
<?php echo $listObj->displayInsertForm(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

