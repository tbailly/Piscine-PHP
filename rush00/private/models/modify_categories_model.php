<?php

function modify_categories() {
	$all_categories = array();
	if (!file_exists(DATABASE_PATH))
	    mkdir(DATABASE_PATH, 0777, true);
	if ($_POST)
	{
		foreach ($_POST as $key => $value) {
			$post_safe[$key] = htmlentities($value); 
		}
		$id_to_delete = explode("_delete", array_search("delete", $post_safe))[0];
		$id_to_update = explode("_update", array_search("update", $post_safe))[0];
		$all_categories = get_all_categories();
		$all_products = get_all_products();
		if (isset($all_categories[$id_to_delete]))
		{
			unset($all_categories[$id_to_delete]);
		}
		else if (isset($all_categories[$id_to_update]) && check_category_post_values())
		{
			$all_categories = update_category($all_categories, $id_to_update, $post_safe["name"]);
		}
		else if (check_category_post_values() &&
				isset($post_safe["create_category"]) && $post_safe["create_category"] === "create_category" &&
				isset($post_safe["name"]) && $post_safe["name"] !== "")
		{
			$all_categories = add_new_category($all_categories, $post_safe["name"]);
		}
		else if ($all_products && isset($post_safe["link-unlink"]) && $post_safe["link-unlink"] == "link-unlink" &&
				isset($post_safe["product"]) && $post_safe["product"] !== "" &&
				isset($post_safe["category"]) && $post_safe["category"] !== "")
		{
			$all_categories = add_link($all_categories, $all_products, $post_safe["category"], $post_safe["product"]);
		}
		file_put_contents(DATABASE_PATH . '/categories', serialize($all_categories));
	}
}

function update_category($all_categories, $id, $name) {
	$all_categories[$id]["name"] = htmlentities($_POST["name"]);
	return ($all_categories);
}

function add_product_to_category($all_categories, $id, $product_id) {
	$key = array_search($product_id, $all_categories[$id]["products"]);
	if ($key === FALSE)
		array_push($all_categories[$id]["products"], $product_id);
	return ($all_categories);
}

function delete_product_from_category($all_categories, $id, $product_id) {
	$key = array_search($product_id, $all_categories[$id]["products"]);
	if ($key !== FALSE)
		unset($all_categories[$id]["products"][$key]);
	return ($all_categories);
}


function add_new_category($all_categories, $name) {
	$id = uniqid();
	$new_category = array(
		"name" => htmlentities($name),
		"products" => array()
	);
	$all_categories[$id] = $new_category;
	return ($all_categories);
}

function add_link($all_categories, $all_products, $category, $product) {
	foreach ($all_products as $p_key => $prod) {
		if ($product == $prod["name"])
		{
			foreach ($all_categories as $c_key => $cat) {
				if ($category == $cat["name"])
				{
					if (($pos = array_search($p_key, $cat["products"])) !== FALSE)
						unset($all_categories[$c_key]["products"][$pos]);
					else
						array_push($all_categories[$c_key]["products"], $p_key);
				}
			}
		}
	}
	return ($all_categories);
}

?>
