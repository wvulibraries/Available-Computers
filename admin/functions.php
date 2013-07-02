<?php
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?php
$errorMsg = NULL;
localVars::add('listTable', 'functions');


function listFields() {
	$engine = EngineAPI::singleton();

	$listObj = new listManagement($engine,localVars::get('listTable'));

	$options = array();
	$options['field'] = "name";
	$options['label'] = "Function";
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

<h2>Manage OS Functions</h2>

<?php
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>New Function</h3>
<?php echo $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Functions</h3>
<?php echo $listObj->displayEditTable(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

