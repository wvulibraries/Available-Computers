<?
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?
$errorMsg = NULL;
$engine->localVars("listTable",$engine->dbTables("floors"));


function listFields() {
	
	global $engine;

	$listObj = new listManagement($engine,$engine->localVars("listTable"));
	
	$options = array();
	$options['field'] = "floor";
	$options['label'] = "Short Name";
	$options['size']  = "5";
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "floor_name";
	$options['label'] = "Long Name";
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
else if (isset($engine->cleanPost['MYSQL'][$engine->localVars("listTable").'_update'])) {
	
	$errorMsg .= $listObj->update();
	$listObj = listFields();
	
}
// Form Submission
?>

<h2>Manage Floors</h2>

<?
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>New Floor</h3>
<?= $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Floors</h3>
<?= $listObj->displayEditTable(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

