<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'actions');
localVars::add('labelSingular', 'Action');
localVars::add('labelPlural',   'Actions');

recurseInsert('includes/metadataForm.php');
?>
