<?php

function get_all_orders() {
	$all_orders = array();
	if (file_exists(DATABASE_PATH . '/orders'))
		$all_orders = unserialize(file_get_contents(DATABASE_PATH . '/orders'));
	return ($all_orders);
}

?>
