<?php
require_once 'engineInit.php';

recurseInsert("includes/engineHeader.php","php");
$engine->eTemplate("load","library2012.2col");

recurseInsert("dbTableList.php","php");
require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
$engine->dbConnect("database","availableComputers",TRUE);


localVars::add('pageTitle',"Available Computers");

$engine->eTemplate("load","systems");
$engine->eTemplate("include","header");
?>
