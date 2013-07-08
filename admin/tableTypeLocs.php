<?php
require("../header.php");
recurseInsert("acl.php","php");

$errorMsg = NULL;
localVars::add('listTable', 'tableTypes');

function listFields() {
	$engine = EngineAPI::singleton();

	$l = new listManagement(localVars::get('listTable'));
	$l->updateInsert   = TRUE;
	$l->updateInsertID = "ID";

	$l->addField(array(
		'field' => 'ID',
		'label' => 'Table Type ID',
		'type'  => 'hidden',
		'value' => $engine->cleanGet['MYSQL']['id'],
		));

	$sql = sprintf("SELECT `tableLocationID` FROM `tableTypeLocs` WHERE `tableTypeID`='%s'",
		$engine->cleanGet['MYSQL']['id']
	);
	$sqlResult = $engine->openDB->query($sql);

	$tmp = array();
	if ($sqlResult['result']) {
		while ($row = mysql_fetch_array($sqlResult['result'],  MYSQL_NUM)) {
			$tmp[] = $row[0];
		}
	}

	$l->addField(array(
		'field'   => 'ms_tableLocations',
		'label'   => 'Table Locations',
		'type'    => 'multiselect',
		'options' => array(
			'valueTable'        => 'tableLocations',
			'valueDisplayField' => 'name',
			'valueDisplayID'    => 'ID',
			'linkTable'         => 'tableTypeLocs',
			'linkValueField'    => 'tableLocationID',
			'linkObjectField'   => 'tableTypeID',
			'select'            => implode(",", $tmp),
			),
		));

	return $l;
}

// Form Submission
if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {
	$listObj = listFields();
	$listObj->insert();
}
// Form Submission

$listObj = listFields();

localVars::add("results",    displayErrorStack());
localVars::add("insertForm", $listObj->displayInsertForm());

$engine->eTemplate("include","header");
?>

<h1>Manage Table Types</h1>

{local var="results"}

<h2>Edit TableLocations</h2>
{local var="insertForm"}

<?php
$engine->eTemplate("include","footer");
?>

