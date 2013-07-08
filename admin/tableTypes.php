<?php
require("../header.php");
recurseInsert("acl.php","php");

$errorMsg = NULL;
localVars::add('listTable', 'tableTypes');


function listFields() {
	$engine = EngineAPI::singleton();

	$listObj = new listManagement($engine,localVars::get('listTable'));

	$options = array();
	$options['field'] = "name";
	$options['label'] = "Table Type";
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

$engine->eTemplate("include","header");
?>

<h2>Manage Table Types</h2>

<?php
if (!is_empty($errorMsg)) {
	print $errorMsg;
}
?>

<h3>New Table Type</h3>
<?php echo $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Table Types</h3>
<?php echo $listObj->displayEditTable(); ?>

<?php
$engine->eTemplate("include","footer");
?>

