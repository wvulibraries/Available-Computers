<?
global $engine;

$engine->accessControl("ADgroup","libraryWeb_availableComputers",TRUE);
$engine->accessControl("denyAll",TRUE);
$engine->accessControl("build");
?>
