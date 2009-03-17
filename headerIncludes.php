<?
function getComputerName () {
	$ip = $_SERVER["REMOTE_ADDR"];
	$host = gethostbyaddr($ip);
	$compName = substr($host, 0, strpos("$host.", "."));
	return $compName;
}
?>

<link rel="stylesheet" href="/availableComputers/includes/css/main.css" type="text/css" media="screen" />

<script type="text/javascript" src="/availableComputers/includes/js/main.js"></script>
<script type="text/javascript" src="/availableComputers/includes/js/validate.js"></script>
