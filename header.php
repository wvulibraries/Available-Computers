<?php
require_once 'engineInit.php';

// recurseInsert("includes/engineHeader.php","php");
// $engine->eTemplate("load","library2012.2col");

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
$engine->dbConnect("database","availableComputers",TRUE);


localVars::add('pageTitle',"Available Computers");

$engine->eTemplate("load","systems.2013.2col");
$engine->eTemplate("include","header");
?>
