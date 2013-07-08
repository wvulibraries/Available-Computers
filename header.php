<?php
require_once 'engineInit.php';

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
$engine->dbConnect("database","availableComputers",TRUE);

localVars::add('pageTitle',"Available Computers");
?>
