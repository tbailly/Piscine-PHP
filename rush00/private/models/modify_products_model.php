<?php

function modify_products() {
	$all_products = array();
	if (!file_exists(DATABASE_PATH))
	    mkdir(DATABASE_PATH, 0777, true);
	if ($_POST)
	{
		foreach ($_POST as $key => $value) {
			$post_safe[$key] = htmlentities($value); 
		}
		$id_to_delete = explode("_delete", array_search("delete", $post_safe))[0];
		$id_to_update = explode("_update", array_search("Update", $post_safe))[0];
		$all_products = get_all_products();
		$all_categories = get_all_categories();

		if (isset($all_products[$id_to_delete]))
		{
			unset($all_products[$id_to_delete]);
			$all_categories = delete_product_from_cat($all_categories, $id_to_delete);
			file_put_contents(DATABASE_PATH . '/categories', serialize($all_categories));
		}
		else if (isset($all_products[$id_to_update]) && check_product_post_values())
		{
			$all_products = update_product($all_products, $id_to_update, $post_safe["name"], $post_safe["price"]);
		}
		else if (check_product_post_values() &&
				isset($post_safe["create_product"]) && $post_safe["create_product"] === "create_product")
		{
			$all_products = add_new_product($all_products, $post_safe["name"], $post_safe["price"]);
		}
		file_put_contents(DATABASE_PATH . '/products', serialize($all_products));
	}
}

function update_product($all_products, $id, $name, $price)
{
	$all_products[$id]["name"] = htmlentities($_POST["name"]);
	$all_products[$id]["price"] = htmlentities($_POST["price"]);
	return ($all_products);
}

function add_new_product($all_products, $name, $price)
{
	$id = uniqid();
	$new_product = array(
		"name" => htmlentities($name),
		"price" => htmlentities($price)
	);
	$all_products[$id] = $new_product;
	return ($all_products);
}

function delete_product_from_cat($all_categories, $product)
{
	foreach ($all_categories as $key => $category) {
		if (($p_key = array_search($product, $category["products"])) !== FALSE)
			unset($all_categories[$key]["products"][$p_key]);
	}
	return ($all_categories);
}

?>
