<?php

function getCurrentPage(): string {
	$output = $_SERVER['PHP_SELF'];

	$exploded = explode('/', $output);
	$output = $exploded[count($exploded) - 1];
	$output = str_replace(".php", "", $output);

	return $output;
}

?>