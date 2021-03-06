<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable', 'tableTypes');

function listFields() {
	$l = new listManagement(localVars::get('listTable'));

	$l->addField(array(
		'field' => 'ID',
		'label' => 'Table Type ID',
		'type'  => 'hidden',
		));

	$l->addField(array(
		'field' => 'name',
		'label' => 'Table Type',
		));

	$l->addField(array(
		'field' => '<a href="tableTypeLocs.php?id={ID}">Attach Locations</a>',
		'label' => 'Locations',
		'type'  => 'plainText',
		));

	return $l;
}

// Form Submission
if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {
	$listObj = listFields();
	$listObj->insert();
}
else if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_update'])) {
	$listObj = listFields();
	$listObj->update();
}
// Form Submission

$listObj = listFields();

localVars::add("results",    displayErrorStack());
localVars::add("insertForm", $listObj->displayInsertForm());
localVars::add("editTable",  $listObj->displayEditTable());

$engine->eTemplate("include","header");
?>

<h1>Manage Table Types</h1>

{local var="results"}

<h2>New Table Type</h2>
{local var="insertForm"}

<hr />

<h2>Edit Table Types</h2>
{local var="editTable"}

<?php
$engine->eTemplate("include","footer");
?>

