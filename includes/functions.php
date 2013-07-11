<?php
function getMetadataOptions($table, $fieldValue=NULL) {
	$engine = EngineAPI::singleton();
	$output = array();

	$sql = sprintf("SELECT `ID`, `name` FROM `%s` ORDER BY `name`",
		$engine->openDB->escape($table)
		);
	$sqlResult = $engine->openDB->query($sql);

	if ($sqlResult['result']) {
		while ($row = mysql_fetch_array($sqlResult['result'], MYSQL_ASSOC)) {
			$selected = FALSE;
			if (isset($fieldValue) && $fieldValue == $row['ID']) {
				$selected = TRUE;
			}

			$output[] = array(
				'value'    => $row['ID'],
				'label'    => $row['name'],
				'selected' => $selected,
				);
		}
	}

	return $output;
}

function displayErrorStack() {
	$engine = EngineAPI::singleton();
	$output = '';

	if (!is_empty($engine->errorStack)) {
		if (isset($engine->errorStack['error']) && is_array($engine->errorStack['error'])) {
			foreach ($engine->errorStack['error'] as $error) {
				$output .= '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><h4>Error</h4>'.$error.'</div>';
			}
		}
		if (isset($engine->errorStack['warning']) && is_array($engine->errorStack['warning'])) {
			foreach ($engine->errorStack['warning'] as $warning) {
				$output .= '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><h4>Warning</h4>'.$warning.'</div>';
			}
		}
		if (isset($engine->errorStack['success']) && is_array($engine->errorStack['success'])) {
			foreach ($engine->errorStack['success'] as $success) {
				$output .= '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><h4>Success</h4>'.$success.'</div>';
			}
		}
	}

	return $output;
}
?>
