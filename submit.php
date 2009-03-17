<? // All form submissions processed in this file

$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";
$localVars['exclude_template'] = TRUE;

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");
recurseInsert("headerIncludes.php","php");

$localVars['siteRoot'] = $engineVars['WVULSERVER']."/availableComputers";
$localVars['adminRoot'] = $localVars['siteRoot']."/admin";



if (isset($_POST['submitAddBuilding'])) {
	
	isset($_POST['building_name']) ? $name = dbSanitize($_POST['building_name']) : $name = NULL;
	isset($_POST['num_floors']) ? $numFloors = dbSanitize($_POST['num_floors']) : $numFloors = 0;
	
	for ($i = 1; $i <= $numFloors; $i++) {
		isset($_POST["floor_code_$i"]) ? $floor[$i]["code"] = dbSanitize($_POST["floor_code_$i"]) : $floor[$i]["code"] = NULL;
		isset($_POST["floor_name_$i"]) ? $floor[$i]["name"] = dbSanitize($_POST["floor_name_$i"]) : $floor[$i]["name"] = NULL;
	}

	
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "INSERT INTO ".dbSanitize($dbTables["buildings"])." SET name = '$name'";
	$resultArray = $engineVars['openDB']->query($sql);

	for ($i = 1; $i <= $numFloors; $i++) {
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "INSERT INTO ".dbSanitize($dbTables["floors"])." SET building_id = ".$resultArray['id'].", floor = '".$floor[$i]["code"]."', floor_name = '".$floor[$i]["name"]."'";
		$resultArray = $engineVars['openDB']->query($sql);
	}
	
}


if (isset($_POST['submitEditBuildings'])) {

}
?>
