<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'tableLocations');
localVars::add('labelSingular', 'Table Location');
localVars::add('labelPlural',   'Table Locations');

recurseInsert('includes/metadataForm.php');
?>
