<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable', 'computers');

function listFields($null=FALSE) {
	$engine = EngineAPI::singleton();
	$l      = new listManagement(localVars::get('listTable'));

	$l->addField(array(
		'field' => 'ID',
		'label' => 'Computer ID',
		'type'  => 'hidden',
		));

	$l->addField(array(
		'field' => 'name',
		'label' => 'Computer Name',
		));

	$l->addField(array(
		'field'   => 'buildingID',
		'label'   => 'Building',
		'type'    => 'select',
		'options' => getMetadataOptions('buildings'),
		'dupes'   => TRUE,
		));

	$l->addField(array(
		'field'   => 'osID',
		'label'   => 'Operating System',
		'type'    => 'select',
		'options' => getMetadataOptions('operatingSystems'),
		'dupes'   => TRUE,
		));

	$l->addField(array(
		'field'   => 'functionID',
		'label'   => 'Function',
		'type'    => 'select',
		'options' => getMetadataOptions('functions'),
		'dupes'   => TRUE,
		));

	$l->addField(array(
		'field' => '<a href="mapComputer.php?id={ID}">Map Info</a>',
		'label' => 'Map',
		'type'  => 'plainText',
		));

	return $l;
}


// Form Submission
if(isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {
	$listObj = listFields(FALSE);
	$listObj->insert();
}
else if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_update'])) {
	$listObj = listFields(FALSE);
	$listObj->update();
}
// Form Submission

$listObj = listFields(TRUE);

localVars::add("results",    displayErrorStack());
localVars::add("insertForm", $listObj->displayInsertForm());
localVars::add("editTable",  $listObj->displayEditTable());

$engine->eTemplate("include","header");
?>

<h1>Edit Computers</h1>

{local var="results"}

<h2>New Computer</h2>
{local var="insertForm"}

<hr />

<h2>Edit Computers</h2>
{local var="editTable"}

<?php
$engine->eTemplate("include","footer");
?>
