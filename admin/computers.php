<?php
include("adminHeader.php");
?>

<!-- Page Content Goes Below This Line -->

<?php
$errorMsg = NULL;
$engine->localVars("listTable",'computers');


function listFields($null=FALSE) {

	global $engine;

	$listObj = new listManagement($engine,$engine->localVars("listTable"));

	$options = array();
	$options['field'] = "computer_name";
	$options['label'] = "Computer Name";
	$options['size']  = "20";
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "os";
	$options['label'] = "Operating System";
	$options['type']  = "select";
	$options['dupes'] = TRUE;

	$sql = sprintf("SELECT * FROM `operatingSystems` ORDER BY name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($null === TRUE) {
		$tmp['value']         = "";
		$tmp['label']         = "-- Select an OS --";
		$options['options'][] = $tmp;
	}
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_BOTH)) {
		$tmp['value'] = $row[0];
		$tmp['label'] = $row['name'];
		$options['options'][]  = $tmp;
	}

	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "function";
	$options['label'] = "Function";
	$options['type']  = "select";
	$options['dupes'] = TRUE;

	$sql = sprintf("SELECT * FROM `functions` ORDER BY name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($null === TRUE) {
		$tmp['value']         = "";
		$tmp['label']         = "-- Select a Function --";
		$options['options'][] = $tmp;
	}
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_BOTH)) {
		$tmp['value'] = $row[0];
		$tmp['label'] = $row['name'];
		$options['options'][]  = $tmp;
	}

	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "building";
	$options['label'] = "Building";
	$options['type']  = "select";
	$options['dupes'] = TRUE;

	$sql = sprintf("SELECT * FROM `buildings` ORDER BY name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($null === TRUE) {
		$tmp['value']         = "";
		$tmp['label']         = "-- Select a Building --";
		$options['options'][] = $tmp;
	}
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_BOTH)) {
		$tmp['value'] = $row[0];
		$tmp['label'] = $row['name'];
		$options['options'][]  = $tmp;
	}

	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "floor";
	$options['label'] = "Floor";
	$options['type']  = "select";
	$options['dupes'] = TRUE;

	$sql = sprintf("SELECT * FROM `floors` ORDER BY floor_name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($null === TRUE) {
		$tmp['value']         = "";
		$tmp['label']         = "-- Select a Floor --";
		$options['options'][] = $tmp;
	}
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_BOTH)) {
		$tmp['value'] = $row['floor'];
		$tmp['label'] = $row['floor_name'];
		$options['options'][]  = $tmp;
	}

	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "table_type";
	$options['label'] = "Table Type";
	$options['type']  = "select";
	$options['dupes'] = TRUE;

	$sql = sprintf("SELECT * FROM `tableTypes` ORDER BY name");
	$engine->openDB->sanitize = FALSE;
	$sqlResult                = $engine->openDB->query($sql);

	if ($null === TRUE) {
		$tmp['value']         = "";
		$tmp['label']         = "-- Select a Table Type --";
		$options['options'][] = $tmp;
	}
	while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_BOTH)) {
		$tmp['value'] = $row[0];
		$tmp['label'] = $row['name'];
		$options['options'][]  = $tmp;
	}

	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "table_location";
	$options['label'] = "Location on Table";
	$options['size']  = "20";
	$options['dupes'] = TRUE;
	$listObj->addField($options);
	unset($options);

	$options = array();
	$options['field'] = "table_name";
	$options['label'] = "Table ID";
	$options['size']  = "20";
	$options['dupes'] = TRUE;
	$listObj->addField($options);
	unset($options);

	return $listObj;

}


$listObj = listFields(FALSE);

// Form Submission
if(isset($engine->cleanPost['MYSQL'][$engine->localVars("listTable").'_submit'])) {

	$errorMsg .= $listObj->insert();

}
else if (isset($engine->cleanPost['MYSQL'][$engine->localVars("listTable").'_update'])) {

	$errorMsg .= $listObj->update();

}
// Form Submission
?>

<h2>Edit Computers</h2>

<?php
if (!is_empty($errorMsg)) {
	print $errorMsg."<hr />";
}
?>

<h3>New Computer</h3>
<?php $listObj = listFields(TRUE); ?>
<?php echo $listObj->displayInsertForm(); ?>

<hr />

<h3>Edit Computers</h3>
<?php $listObj = listFields(FALSE); ?>
<?php echo $listObj->displayEditTable(); ?>

<!-- Page Content Goes Above This Line -->

<?php
$engine->eTemplate("include","footer");
?>

