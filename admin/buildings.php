<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable', 'buildings');

function listFields() {
	$l = new listManagement(localVars::get('listTable'));

	$l->addField(array(
		'field' => 'ID',
		'label' => 'Building ID',
		'type'  => 'hidden',
		));

	$l->addField(array(
		'field' => 'name',
		'label' => 'Building',
		));

	$l->addField(array(
		'field' => '<a href="attachFloors.php?id={ID}">Attach Floors</a>',
		'label' => 'Floors',
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

<h1>Manage Buildings</h1>

{local var="results"}

<h2>New Building</h2>
{local var="insertForm"}

<hr />

<h2>Edit Buildings</h2>
{local var="editTable"}

<?php
$engine->eTemplate("include","footer");
?>
