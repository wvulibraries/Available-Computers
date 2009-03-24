<?php
$engineDir = "/home/library/phpincludes/engineCMS/engine";

$localVars = array(); //Do not delete this line

$localVars['pageTitle'] = "Available Computers";
$localVars['openDB_Database'] = "availableComputers";

$accessControl = array(); //Do not delete this line

$accessControl['AD']['Groups']['webAvailableComputersAdmin'] = 1;

include($engineDir ."/engineHeader.php");
?>

<!-- Page Content Goes Below This Line -->
<h2>Public Computer Stats</h2>

<br />

<form method="post">
	
	Library: <select name="library">
	
	<?
	$engineVars['openDB']->sanitize = FALSE;
	$sql = "SELECT * FROM ".dbSanitize($dbTables["buildings"]["prod"])." ORDER BY name";
	$resultArray = $engineVars['openDB']->query($sql);
	
	while ($buildings = mysql_fetch_assoc($resultArray['result'])) {
		
		echo "<option value=\"".htmlSanitize($buildings['building_id'])."\">".htmlSanitize($buildings['name'])."</option>";
		
	}
	?>
	
	</select>
	
	<br /><br />
	
	Date Range:
	
	<br />
	
	<?
	$timestamp = time();
	list($year, $month, $date) = explode(',',strftime('%Y,%m,%d',$timestamp));
	$months = array(NULL,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$hours = array('12am','1am','2am','3am','4am','5am','6am','7am','8am','9am','10am','11am','12pm','1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm','10pm','11pm');
	?>
	
	Start: 
	<select name="sMonth">
	<?
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $month) {
			echo "<option value=\"$i\" selected=\"selected\">$months[$i]</option>";
		}
		else {
			echo "<option value=\"$i\">$months[$i]</option>";
		}
	}
	?>
	</select>
	<select name="sDate">
		<?
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $date) {
				echo "<option value=\"$i\" selected=\"selected\">$i</option>";
			}
			else {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		?>
	</select>
	<select name="sYear">
		<?
		for ($i = $year; $i >= 2009; $i--) {
			echo "<option value=\"$i\">$i</option>";
		}
		?>
	</select>
	<select name="sHour">
	<?
	for ($i = 0; $i <= 23; $i++) {
		echo "<option value=\"$i\">$hours[$i]</option>";
	}
	?>
	</select>
	
	<br />
	
	End: 
	<select name="eMonth">
		<?
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $month) {
				echo "<option value=\"$i\" selected=\"selected\">$months[$i]</option>";
			}
			else {
				echo "<option value=\"$i\">$months[$i]</option>";
			}
		}
		?>
	</select>
	<select name="eDate">
		<?
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $date) {
				echo "<option value=\"$i\" selected=\"selected\">$i</option>";
			}
			else {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		?>
	</select>
	<select name="eYear">
		<?
		for ($i = $year; $i >= 2009; $i--) {
			echo "<option value=\"$i\">$i</option>";
		}
		?>
	</select>
	<select name="eHour">
	<?
	for ($i = 0; $i <= 23; $i++) {
		echo "<option value=\"$i\">$hours[$i]</option>";
	}
	?>
	</select>

	
	<br /><br />
	
	{engine name="insertCSRF"}
	<input type="submit" name="submitGenStats" value="Generate Report" />
	<input type="reset" value="Reset Form" />
	
</form>

<br /><br />

<?
if (isset($_POST['submitGenStats'])) {
	
	include ('displayStats.php');
	
}
?>
<!-- Page Content Goes Above This Line -->

<?php
include($engineDir ."/engineFooter.php");
?>
