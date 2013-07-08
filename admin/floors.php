<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'floors');
localVars::add('labelSingular', 'Floor');
localVars::add('labelPlural',   'Floors');

recurseInsert('includes/metadataForm.php');
?>
