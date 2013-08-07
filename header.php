<?php
require_once 'engineInit.php';

require_once '/home/library/phpincludes/databaseConnectors/database.lib.wvu.edu.remote.php';
$engine->dbConnect("database","availableComputers",TRUE);

recurseInsert('dbTableList.php');
recurseInsert('includes/functions.php');

$engine->eTemplate("load","library2012.2col.right");

localVars::add('pageTitle',"Available Computers");
?>
