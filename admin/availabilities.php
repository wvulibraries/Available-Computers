<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'availabilities');
localVars::add('labelSingular', 'Availability');
localVars::add('labelPlural',   'Availabilities');

recurseInsert('includes/metadataForm.php');
?>
