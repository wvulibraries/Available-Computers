<?
$engineDir = "/home/library/phpincludes/engineAPI/engine";
include($engineDir ."/engine.php");
$engine = new EngineCMS();

$engine->localVars('pageTitle',"Available Computers");

recurseInsert("dbTableList.php","php");
$engine->dbConnect("database","availableComputers",TRUE);

$engine->eTemplate("load","systems");
$engine->eTemplate("include","header");
?>
