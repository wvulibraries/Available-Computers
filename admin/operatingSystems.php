<?php
require("../header.php");
recurseInsert("acl.php","php");

localVars::add('listTable',     'operatingSystems');
localVars::add('labelSingular', 'Operating System');
localVars::add('labelPlural',   'Operating Systems');

recurseInsert('includes/metadataForm.php');
?>
