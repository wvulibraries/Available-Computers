<?php
function listFields() {
	$l = new listManagement(localVars::get('listTable'));

	$l->addField(array(
		'field' => 'name',
		'label' => localVars::get('labelSingular'),
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

<h1>Manage {local var="labelPlural"}</h1>

{local var="results"}

<h2>New {local var="labelSingular"}</h2>
{local var="insertForm"}

<hr />

<h2>Edit {local var="labelPlural"}</h2>
{local var="editTable"}

<?php
$engine->eTemplate("include","footer");
?>
