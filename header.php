<?php
require_once 'engineInit.php';

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
$engine->dbConnect("database","availableComputers",TRUE);

recurseInsert('dbTableList.php');
recurseInsert('includes/functions.php');

$engine->eTemplate("load","systems.2013.2col");

localVars::add('pageTitle',"Available Computers");
?>
