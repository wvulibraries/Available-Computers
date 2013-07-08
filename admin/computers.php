<?php
require("../header.php");
recurseInsert("acl.php","php");

$errorMsg = NULL;
localVars::add('listTable', 'computers');

function getMetadataOptions($table, $emptyLabel=NULL) {
	$engine = EngineAPI::singleton();
	$output = array();

	$sql = sprintf("SELECT `ID`, `name` FROM `%s` ORDER BY `name`",
		$engine->openDB->escape($table)
		);
	$sqlResult = $engine->openDB->query($sql);

	if (!isnull($emptyLabel)) {
		$output[] = array(
			'value' => '',
			'label' => $emptyLabel,
			);
	}
	if ($sqlResult['result']) {
		while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
			$output[] = array(
				'value' => $row['ID'],
				'label' => $row['name'],
				);
		}
	}

	return $output;
}

function listFields($null=FALSE) {
	$engine = EngineAPI::singleton();
	$l      = new listManagement(localVars::get('listTable'));

	$l->addField(array(
		'field' => 'name',
		'label' => 'Computer Name',
		));

	$l->addField(array(
		'field'   => 'osID',
		'label'   => 'Operating System',
		'type'    => 'select',
		'options' => getMetadataOptions('operatingSystems',($null ? '' : '-- Select an OS --')),
		'size'    => '10',
		));

	$l->addField(array(
		'field'   => 'functionID',
		'label'   => 'Function',
		'type'    => 'select',
		'options' => getMetadataOptions('functions',($null ? '' : '-- Select a Function --')),
		'size'    => '10',
		));

	$l->addField(array(
		'field'   => 'tableNameID',
		'label'   => 'Table Name',
		'type'    => 'select',
		'options' => getMetadataOptions('tableNames',($null ? '' : '-- Select a Table Name --')),
		'size'    => '10',
		));

	$l->addField(array(
		'field'   => 'tableLocationID',
		'label'   => 'Table Location',
		'type'    => 'select',
		'options' => getMetadataOptions('tableLocations',($null ? '' : '-- Select a Table Location --')),
		'size'    => '10',
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

