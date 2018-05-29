<?php

// PRODUCT FUNCTIONS
function check_product_post_values() {
	if ($_POST && isset($_POST["name"]) && $_POST["name"] !== "" &&
	isset($_POST["price"]) && $_POST["price"] >= 0 && preg_match('/^\d+(\.\d{1,2}|)$/', $_POST["price"]) == 1)
		return (TRUE);
	return (FALSE);
}

function get_all_products() {
	$all_products = array();
	if (file_exists(DATABASE_PATH . '/products'))
		$all_products = unserialize(file_get_contents(DATABASE_PATH . '/products'));
	return ($all_products);
}

// CATEGORY FUNCTIONS
function check_category_post_values() {
	if ($_POST && isset($_POST["name"]) && $_POST["name"] !== "")
		return (TRUE);
	return (FALSE);
}

function get_all_categories() {
	$all_categories = array();
	if (file_exists(DATABASE_PATH . '/categories'))
		$all_categories = unserialize(file_get_contents(DATABASE_PATH . '/categories'));
	return ($all_categories);
}

?>