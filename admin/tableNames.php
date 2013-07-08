<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'tableNames');
localVars::add('labelSingular', 'Table Name');
localVars::add('labelPlural',   'Table Names');

recurseInsert('includes/metadataForm.php');
?>
