<?php
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?php
$errorMsg = NULL;
localVars::add('listTable', 'buildings');


function listFields() {

	global $engine;

	$listObj = new listManagement($engine,localVars::get('listTable'));

	$options = array();
	$options['field'] = "building_id";
	$options['label'] = "buildingID";
	$options['type']  = "hidden";
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "name";
	$options['label'] = "Name";
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = '<a href="attachFloors.php?id={building_id}">Attach Floors</a>';
	$options['label'] = "Floors";
	$options['type']  = "plainText";
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
else if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_update'])) {

	$errorMsg .= $listObj->update();
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

<h3>New Building</h3>
<?php echo $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Buildings</h3>
<?php echo $listObj->displayEditTable(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

