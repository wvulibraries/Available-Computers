<?php
require("../header.php");
recurseInsert("acl.php","php");

$buildingID = isset($engine->cleanGet['MYSQL']['building']) ? $engine->cleanGet['MYSQL']['building'] : NULL;
$osID       = isset($engine->cleanGet['MYSQL']['os'])       ? $engine->cleanGet['MYSQL']['os']       : NULL;
$floorID    = isset($engine->cleanGet['MYSQL']['floor'])    ? $engine->cleanGet['MYSQL']['floor']    : NULL;

localVars::add('listTable', 'computers');

function listFields($buildingID, $osID, $floorID) {
	$engine = EngineAPI::singleton();
	$l      = new listManagement(localVars::get('listTable'));

	$where = array();
	$where[] = sprintf("`computers`.`buildingID`='%s' AND `computers`.`osID`='%s'",
		$buildingID,
		$osID
		);
	if (isnull($floorID)) {
		$joins   = "";
		$where[] = "`computers`.`functionID`!='3' AND `computers`.`tableNameID` IS NULL";
	}
	else if ($floorID = 'lap') {
		$joins   = "";
		$where[] = "`computers`.`functionID`='3'";
	}
	else {
		$joins   = "LEFT JOIN `tableNames` ON `tableNames`.`ID`=`computers`.`tableNameID`
					LEFT JOIN `buildingFloors` ON `buildingFloors`.`ID`=`tableNames`.`buildingFloorID`";
		$where[] = sprintf("`computers`.`functionID`!='3' AND `buildingFloors`.`floorID`='%s'",
			$engine->openDB->escape($floorID)
			);
	}

	$l->sql = sprintf("SELECT `computers`.* FROM `computers` %s WHERE %s ORDER BY `computers`.`name`",
				$joins,
				implode(" AND ", $where)
				);

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

$sql = sprintf("SELECT `ID`, `name` FROM `buildings` ORDER BY `name`");
$sqlResult = $engine->openDB->query($sql);

if ($sqlResult['result']) {
	$tmp = '<ul>';
	while ($building = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
		$tmp .= '<li>'.htmlSanitize($building['name']);
		$tmp .= '<ul>';

		$sql = sprintf("SELECT `ID`, `name` FROM `operatingSystems`");
		$sqlResult2 = $engine->openDB->query($sql);

		if ($sqlResult2['result']) {
			while ($os = mysql_fetch_array($sqlResult2['result'], MYSQL_ASSOC)) {
				$tmp .= '<li>'.ucfirst(htmlSanitize($os['name']));
				$tmp .= '<ul><li>';

				/*
				$sql = sprintf("SELECT `ID`, `name` FROM `functions`");
				$sqlResult3 = $engine->openDB->query($sql);

				if ($sqlResult3['result']) {
					$funcs = array();
					while ($function = mysql_fetch_array($sqlResult3['result'], MYSQL_ASSOC)) {
						$funcs[] = sprintf('<a href="?building=%s&os=%s&function=%s">%s</a>',
							htmlSanitize($building['ID']),
							htmlSanitize($os['ID']),
							htmlSanitize($function['ID']),
							ucfirst(htmlSanitize($function['name']))
							);
					}
					$tmp .= implode(' | ', $funcs);
					unset($funcs);
				}
				*/

				$sql = sprintf("SELECT `floors`.`ID`, `floors`.`name`
								FROM `buildingFloors`
								LEFT JOIN `floors` ON `floors`.`ID`=`buildingFloors`.`floorID`
								WHERE `buildingFloors`.`buildingID`='%s'
								ORDER BY `buildingFloors`.`ID`",
					$engine->openDB->escape($building['ID'])
					);
				$sqlResult3 = $engine->openDB->query($sql);

				$floors = array();
				if ($sqlResult3['result']) {
					while ($floor = mysql_fetch_array($sqlResult3['result'], MYSQL_ASSOC)) {
						$floors[] = sprintf('<a href="?building=%s&os=%s&floor=%s">%s</a>',
							htmlSanitize($building['ID']),
							htmlSanitize($os['ID']),
							htmlSanitize($floor['ID']),
							htmlSanitize($floor['name'])
							);
					}
				}

				$floors[] = sprintf('<a href="?building=%s&os=%s&floor=lap">Laptops</a>',
					htmlSanitize($building['ID']),
					htmlSanitize($os['ID'])
					);
				$floors[] = sprintf('<a href="?building=%s&os=%s">Unmapped</a>',
					htmlSanitize($building['ID']),
					htmlSanitize($os['ID'])
					);

				$tmp .= implode(' | ', $floors);
				unset($floors);

				$tmp .= '</li></ul>';
			}
			$tmp .= '</ul></li>';
		}
		$tmp .= '</li>';
	}
	$tmp .= '</ul>';

	localVars::add("buildingList", $tmp);
	unset($tmp);
}


// Form Submission
if(isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_submit'])) {
	$listObj = listFields($buildingID, $osID, $floorID);
	$listObj->insert();
}
else if (isset($engine->cleanPost['MYSQL'][localVars::get('listTable').'_update'])) {
	$listObj = listFields($buildingID, $osID, $floorID);
	$listObj->update();
}
// Form Submission

$listObj = listFields($buildingID, $osID, $floorID);

localVars::add("results",    displayErrorStack());
localVars::add("insertForm", $listObj->displayInsertForm());

if (!isnull($buildingID) && !isnull($osID)) {
	localVars::add("editTable",  $listObj->displayEditTable());
}

$engine->eTemplate("include","header");
?>

<h1>Edit Computers</h1>

{local var="results"}

<h2>New Computer</h2>
{local var="insertForm"}

<hr />

<h2>Edit Computers</h2>
{local var="buildingList"}
{local var="editTable"}

<?php
$engine->eTemplate("include","footer");
?>
