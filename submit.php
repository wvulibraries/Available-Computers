<? // All form submissions processed in this file

$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line
$localVars['pageTitle'] = "Available Computers";
$localVars['exclude_template'] = TRUE;

$accessControl = array(); //Do not delete this line
$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");
recurseInsert("headerIncludes.php","php");

$localVars['siteRoot'] = $engineVars['WVULSERVER']."/availableComputers";
$localVars['adminRoot'] = $localVars['siteRoot']."/admin";



if (isset($_POST['submitAddBuilding'])) {
	
	isset($_POST['building_name']) ? $name = dbSanitize($_POST['building_name']) : $name = NULL;
	isset($_POST['num_floors']) ? $numFloors = htmlSanitize($_POST['num_floors']) : $numFloors = 0;
	
	for ($i = 1; $i <= $numFloors; $i++) {
		isset($_POST["floor_code_$i"]) ? $floor[$i]["code"] = dbSanitize($_POST["floor_code_$i"]) : $floor[$i]["code"] = NULL;
		isset($_POST["floor_name_$i"]) ? $floor[$i]["name"] = dbSanitize($_POST["floor_name_$i"]) : $floor[$i]["name"] = NULL;
	}

	
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "INSERT INTO ".dbSanitize($dbTables["buildings"]["prod"])." SET name = '$name'";
	$resultArray = $engineVars['openDB']->query($sql);

	for ($i = 1; $i <= $numFloors; $i++) {
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "INSERT INTO ".dbSanitize($dbTables["floors"]["prod"])." SET building_id = ".$resultArray['id'].", floor = '".$floor[$i]["code"]."', floor_name = '".$floor[$i]["name"]."'";
		$innerResultArray = $engineVars['openDB']->query($sql);
	}
	
	header ("Location: " . $localVars['siteRoot']);
	
}


if (isset($_POST['submitEditBuildings'])) {
	
	isset($_POST['num_buildings']) ? $numBuildings = dbSanitize($_POST['num_buildings']) : $numBuildings = 0;
	
	for ($i = 0; $i < $numBuildings; $i++) {
		
		isset($_POST["delete_building_$i"]) ? $building[$i]["delete"] = dbSanitize($_POST["delete_building_$i"]) : $building[$i]["delete"] = NULL;
		isset($_POST["building_id_$i"]) ? $building[$i]["id"] = dbSanitize($_POST["building_id_$i"]) : $building[$i]["id"] = NULL;
		isset($_POST["building_name_$i"]) ? $building[$i]["name"] = dbSanitize($_POST["building_name_$i"]) : $building[$i]["name"] = NULL;
		
		isset($_POST["num_floors_$i"]) ? $building[$i]["floors"] = dbSanitize($_POST["num_floors_$i"]) : $building[$i]["floors"] = 0;
		
		for ($j = 0; $j < $building[$i]["floors"]; $j++) {
			isset($_POST["delete_floor_".$i."_".$j]) ? $floor[$i][$j]["delete"] = dbSanitize($_POST["delete_floor_".$i."_".$j]) : $floor[$i][$j]["delete"] = NULL;
			isset($_POST["floor_id_".$i."_".$j]) ? $floor[$i][$j]["id"] = dbSanitize($_POST["floor_id_".$i."_".$j]) : $floor[$i][$j]["id"] = NULL;
			isset($_POST["floor_code_".$i."_".$j]) ? $floor[$i][$j]["code"] = dbSanitize($_POST["floor_code_".$i."_".$j]) : $floor[$i][$j]["code"] = NULL;
			isset($_POST["floor_name_".$i."_".$j]) ? $floor[$i][$j]["name"] = dbSanitize($_POST["floor_name_".$i."_".$j]) : $floor[$i][$j]["name"] = NULL;
		}
		
	}
	
	
	for ($i = 0; $i < $numBuildings; $i++) {
		
		if (!isnull($building[$i]["delete"])) {
			
			$engineVars['openDB']->sanitize = FALSE;
			$sql = "DELETE FROM ".dbSanitize($dbTables["buildings"]["prod"])." WHERE building_id = ".$building[$i]["id"];
			$resultArray = $engineVars['openDB']->query($sql);
			
			for ($j = 0; $j < $building[$i]["floors"]; $j++) {
				
				$engineVars['openDB']->sanitize = FALSE;
				$sql = "DELETE FROM ".dbSanitize($dbTables["floors"]["prod"])." WHERE building_id = ".$building[$i]["id"];
				$resultArray = $engineVars['openDB']->query($sql);
				
			}
			
		}
		
		else {
			
			$engineVars['openDB']->sanitize = FALSE;
			$sql = "UPDATE ".dbSanitize($dbTables["buildings"]["prod"])." SET name = '".$building[$i]["name"]."' WHERE building_id = ".$building[$i]["id"];
			$resultArray = $engineVars['openDB']->query($sql);
			
			for ($j = 0; $j < $building[$i]["floors"]; $j++) {
				
				if (!isnull($floor[$i][$j]["delete"])) {
					
					$engineVars['openDB']->sanitize = FALSE;
					$sql = "DELETE FROM ".dbSanitize($dbTables["floors"]["prod"])." WHERE id = ".$floor[$i][$j]["id"];
					$resultArray = $engineVars['openDB']->query($sql);
					
				}
				
				else {
					
					$engineVars['openDB']->sanitize = FALSE;
					$sql = "UPDATE ".dbSanitize($dbTables["floors"]["prod"])." SET floor = '".$floor[$i][$j]["code"]."', floor_name = '".$floor[$i][$j]["name"]."' WHERE id = ".$floor[$i][$j]["id"];
					$resultArray = $engineVars['openDB']->query($sql);
					
				}
				
			}
			
		}
		
	}
	
	header ("Location: " . $localVars['siteRoot']);
	
}
?>
