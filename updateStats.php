<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";
$localVars['exclude_template'] = TRUE;

$accessControl = array(); //Do not delete this line

include($engineDir ."/engineHeader.php");


isset($_GET['name']) ? $name = dbSanitize($_GET['name']) : $name = NULL;
isset($_GET['type']) ? $type = dbSanitize($_GET['type']) : $type = NULL;
$time = time();

switch ($type) {
	
	case 'login':
		$action = 'login';
		$availability = 'unavailable';
		break;
	
	case 'logoff':
		$action = 'logoff';
		$availability = 'available';
		break;
	
	case 'startup':
		$action = NULL;
		$availability = 'available';
		break;
	
	case 'shutdown':
		$action = NULL;
		$availability = 'offline';
		break;
	
}


if (!isnull($name)) {
	
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "UPDATE ".dbSanitize($dbTables["computers"]["prod"])." SET availability = '$availability' WHERE computer_name = '$name'";
	$resultArray = $engineVars['openDB']->query($sql);
	
	if (!isnull($action)) {	
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "SELECT action FROM ".dbSanitize($dbTables["log"]["prod"])." WHERE name = '$name' ORDER BY id DESC LIMIT 1";
		$resultArray = $engineVars['openDB']->query($sql);
		
		$row = mysql_fetch_assoc($resultArray['result']);
		
		/*
		if ($action == 'login' && $row['action'] == 'login') {
			
			// Add logoff to db before login
			$prev_time = time() - 1;
			
			$engineVars['openDB']->sanitize = FALSE;
			$sql = "INSERT INTO ".dbSanitize($dbTables["log"]["prod"])." SET name = '$name', action = 'logoff', time = $prev_time";
			$resultArray = $engineVars['openDB']->query($sql);
			
		}
		
		else if ($action == 'logoff' && $row['action'] == 'logoff') {
			
			// Add login to db before logoff
			$prev_time = time() - 1;
			
			$engineVars['openDB']->sanitize = FALSE;
			$sql = "INSERT INTO ".dbSanitize($dbTables["log"]["prod"])." SET name = '$name', action = 'login', time = $prev_time";
			$resultArray = $engineVars['openDB']->query($sql);
			
		}
		*/
		
		$engineVars['openDB']->sanitize = FALSE;
		$sql = "INSERT INTO ".dbSanitize($dbTables["log"]["prod"])." SET name = '$name', action = '$action', time = $time";
		$resultArray = $engineVars['openDB']->query($sql);
		
	}
	
}

include($engineDir ."/engineFooter.php");
?>
