<?php

function modify_users()
{
	$all_users = array();
	if (!file_exists(DATABASE_PATH))
	    mkdir(DATABASE_PATH, 0777, true);
	if ($_POST)
	{
		foreach ($_POST as $key => $value) {
			$post_safe[$key] = htmlentities($value); 
		}
		$all_users = get_all_users($post_safe["login"]);
		if ($all_users !== NULL)
		{			
			$login_to_delete = htmlentities(explode("_delete", array_search("delete", $post_safe))[0]);
			$login_to_update = htmlentities(explode("_update", array_search("Update", $post_safe))[0]);

			if ($login_to_delete && ($key = get_user_with_login($all_users, $login_to_delete)) !== NULL)
			{
				unset($all_users[$key]);
			}
			else if ($login_to_update && ($key = get_user_with_login($all_users, $login_to_update)) !== NULL &&
				check_user_post_values(FALSE))
			{
				$all_users = update_user($all_users, $key, $post_safe["login"], $post_safe["passwd"], $post_safe["first_name"], $post_safe["last_name"], $post_safe["role"]);
			}
			else if (check_user_post_values(TRUE) && (get_user_with_login($all_users, htmlentities($post_safe["login"])) === NULL) &&
				isset($post_safe["create_user"]) && $post_safe["create_user"] === "create_user")
			{
				$all_users = add_new_user($all_users, $post_safe["login"], $post_safe["passwd"], $post_safe["first_name"], $post_safe["last_name"], $post_safe["role"]);
			}

			file_put_contents(DATABASE_PATH . '/users', serialize($all_users));
		}
	}
}

function update_user($all_users, $key, $login, $passwd, $first_name, $last_name, $role)
{
	if (get_user_with_login($all_users, $login) === NULL)
		$all_users[$key]["login"] = htmlentities($login);
	$all_users[$key]["first_name"] = htmlentities($first_name);
	$all_users[$key]["last_name"] = htmlentities($last_name);
	if ($role == "admin")
		$all_users[$key]["role"] = $role;
	else if ($role == "user")
		$all_users[$key]["role"] = $role;
	if ($passwd !== "")
		$all_users[$key]["passwd"] = hash("whirlpool", $passwd);
	return ($all_users);
}

function add_new_user($all_users, $login, $passwd, $first_name, $last_name, $role) {
	$new_user = array(
		"login" => htmlentities($login),
		"passwd" => hash("whirlpool", $passwd),
		"first_name" => htmlentities($first_name),
		"last_name" => htmlentities($last_name)
	);
	if ($role == "admin")
		$new_user["role"] = $role;
	else
		$new_user["role"] = "user";
	$all_users[] = $new_user;
	return ($all_users);
}

?>
