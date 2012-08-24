<?
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?
$errorMsg = NULL;
$engine->localVars("listTable",$engine->dbTables("functions"));


function listFields() {
	
	global $engine;

	$listObj = new listManagement($engine,$engine->localVars("listTable"));
	
	$options = array();
	$options['field'] = "name";
	$options['label'] = "Function";
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

<h2>Manage OS Functions</h2>

<?
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>New Function</h3>
<?= $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Functions</h3>
<?= $listObj->displayEditTable(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

