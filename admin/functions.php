<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'functions');
localVars::add('labelSingular', 'Function');
localVars::add('labelPlural',   'Functions');

recurseInsert('includes/metadataForm.php');
?>
