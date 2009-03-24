<?
isset($_POST['library'])	? $building = htmlSanitize($_POST['library'])	: $building = NULL;
isset($_POST['sMonth'])		? $sMonth = htmlSanitize($_POST['sMonth'])		: $sMonth = NULL;
isset($_POST['sDate'])		? $sDate = htmlSanitize($_POST['sDate'])			: $sDate = NULL;
isset($_POST['sYear'])		? $sYear = htmlSanitize($_POST['sYear'])			: $sYear = NULL;
isset($_POST['sHour'])		? $sHour = htmlSanitize($_POST['sHour'])			: $sHour = NULL;
isset($_POST['eMonth'])		? $eMonth = htmlSanitize($_POST['eMonth'])		: $eMonth = NULL;
isset($_POST['eDate'])		? $eDate = htmlSanitize($_POST['eDate'])			: $eDate = NULL;
isset($_POST['eYear'])		? $eYear = htmlSanitize($_POST['eYear'])			: $eYear = NULL;
isset($_POST['eHour'])		? $eHour = htmlSanitize($_POST['eHour'])			: $eHour = NULL;

$sTimestamp = mktime($sHour, 0, 0, $sMonth, $sDate, $sYear);
$eTimestamp = mktime($eHour, 0, 0, $eMonth, $eDate, $eYear);

$months = array(NULL,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$hours = array('12am','1am','2am','3am','4am','5am','6am','7am','8am','9am','10am','11am','12pm','1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm','10pm','11pm');

$logs = array();
$stats = array();


$engineVars['openDB']->sanitize = FALSE;
$sql = "SELECT * FROM ".dbSanitize($dbTables["buildings"]["prod"])." WHERE building_id = ".dbSanitize($building)." LIMIT 1";
$resultArray = $engineVars['openDB']->query($sql);

$row = mysql_fetch_assoc($resultArray['result']);

$buildingName = $row['name'];

echo "<h2>$buildingName Stats</h2>\n";

echo "<h3>".$hours[$sHour]." on ".$sMonth."/".$sDate."/".$sYear." through ".$hours[$eHour]." on ".$eMonth."/".$eDate."/".$eYear."</h3>\n";



// populate results array
$engineVars['openDB']->sanitize = FALSE;
$sql = "SELECT l.* FROM ".dbSanitize($dbTables["log"]["prod"])." AS l LEFT JOIN ".dbSanitize($dbTables["computers"]["prod"])." AS c ON l.name = c.computer_name WHERE time >= $sTimestamp AND time <= $eTimestamp = ".dbSanitize($building)." AND building = ".dbSanitize($building);
$resultArray = $engineVars['openDB']->query($sql);

$numResults = $resultArray['affectedRows'];

for ($i = 0; $row = mysql_fetch_assoc($resultArray['result']); $i++) {
	foreach ($row as $key => $val) {
		$logs[$i][$key] = $val;
	}
}
// populate results array



// calc total computers
$engineVars['openDB']->sanitize = FALSE;
$sql = "SELECT * FROM ".dbSanitize($dbTables["computers"]["prod"])." WHERE building = ".dbSanitize($building);
$resultArray = $engineVars['openDB']->query($sql);

$numComputers = $resultArray['affectedRows'];
// calc total computers

// create array of computers
$computers = array();
while ($row = mysql_fetch_assoc($resultArray['result'])) {
	$computers[] = $row['computer_name'];
}
// create array of computers



// count Total Logins/Logoffs
$stats['logins']['total'] = 0;
$stats['logoffs']['total'] = 0;

foreach ($logs as $log) {
	
	if ($log['action'] == 'login') {
		
		$stats['logins']['total']++;
		
	}
	
	else if ($log['action'] == 'logoff') {
		
		$stats['logoffs']['total']++;
		
	}
	
}

echo "Total Logins: ".$stats['logins']['total']."<br />\n";
echo "Total Logoffs: ".$stats['logoffs']['total']."<br />\n";
// count Total Logins/Logoffs



// count Logins/Logoffs by hour
for ($hour = 0; $hour <= 23; $hour++) {
	
	$stats['logins'][$hour] = 0;
	$stats['logoffs'][$hour] = 0;
	
	foreach ($logs as $log) {
		
		if ($hour == date("G",$log['time'])) {
			
			if ($log['action'] == 'login') {
				
				$stats['logins'][$hour]++;
				
			}
			
			else if ($log['action'] == 'logoff') {
				
				$stats['logoffs'][$hour]++;
				
			}
			
		}
		
	}
	
}
// count Logins/Logoffs by hour



// calc percent occuppied
for ($hour = 0; $hour <= 23; $hour++) {
	
	$stats['occuppied'][$hour] = 0;
	
	foreach ($computers as $computer) {
		
		foreach ($logs as $log) {
			
			if ($hour == date("G",$log['time']) && $log['name'] == $computer) {
				
				if ($log['action'] == 'login') {
					
					$stats['occuppied'][$hour]++;
					break;
					
				}
				
				else if ($log['action'] == 'logoff') {
					
					$stats['occuppied'][$hour]++;
					break;
					
				}
				
			}
			
		}
		
	}
	
}
// calc percent occuppied

echo "<pre>";
//print_r($stats);
echo "</pre>";

// display stats
echo "<br /><br />\n";

echo "<table class=\"simple\">\n";

echo "<tr>\n";
echo "<th>Hour</th>\n";
echo "<th>Logins</th>\n";
echo "<th>Logoffs</th>\n";
echo "<th>Percent Occupied</th>\n";
echo "</tr>\n";

for ($hour = 0; $hour <= 23; $hour++) {
	
	$percent = round(($stats['occuppied'][$hour] / count($computers)),2);
	
	echo "<tr>\n";
	echo "<td>".$hour."</td>\n";
	echo "<td>".$stats['logins'][$hour]."</td>\n";
	echo "<td>".$stats['logoffs'][$hour]."</td>\n";
	echo "<td>".$percent."%</td>\n";
	echo "</tr>\n";

}

echo "</table>\n";
// display stats

?>