<?php

function modify_orders()
{
	$all_orders = array();
	if (!file_exists(DATABASE_PATH))
	    mkdir(DATABASE_PATH, 0777, true);
	if ($_POST)
	{
		foreach ($_POST as $key => $value) {
			$post_safe[$key] = htmlentities($value); 
		}
		$all_orders = get_all_orders($post_safe["login"]);
		if ($all_orders !== NULL)
		{			
			// var_dump($all_orders);
		// 	$login_to_delete = htmlentities(explode("_delete", array_search("delete", $post_safe))[0]);
		// 	$login_to_update = htmlentities(explode("_update", array_search("Update", $post_safe))[0]);

		// 	if ($login_to_delete)
		// 	{
		// 		echo "del";
		// 		// unset();
		// 	}
		// 	else if ($login_to_update && check_order_post_values(FALSE))
		// 	{
		// 		echo "update";
		// 		// $all_orders = update_order();
		// 	}
			/*else */
			// WORKING FROM THERE
			// if (isset($post_safe["create_order"]) && $post_safe["create_order"] === "create_order" &&
			// 	isset($post_safe["user"]) && $post_safe["user"] !== "")
			// {
			// 	$all_orders = add_new_order($all_orders, $post_safe["user"]);
			// }

			// file_put_contents(DATABASE_PATH . '/orders', serialize($all_orders));
		}
	}
}

function update_order()
{
	return ($all_orders);
}

function add_new_order($all_orders, $login) {
	$all_users = get_all_users();
	if (get_user_with_login($all_users, $login) !== NULL)
	{
		$id = uniqid();
		$new_order = array(
			"user" => htmlentities($login),
			"products" => array()
		);
		$all_orders[$id] = $new_order;
		return ($all_orders);
	}
	return ($all_orders);

}

?>
