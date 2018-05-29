<?php

function signup() {
	$all_users = array();
	if (check_already_connected())
		return (1);
	if (!check_user_post_values(TRUE))
		return (2);
	
	if (!file_exists(DATABASE_PATH))
	    mkdir(DATABASE_PATH, 0777, true);

	if (($all_users = get_all_users($_POST["login"])) === NULL)
		return (3);
	$all_users = add_new_user($all_users, $_POST["login"], $_POST["passwd"], $_POST["first_name"], $_POST["last_name"]);
	file_put_contents(DATABASE_PATH . '/users', serialize($all_users));
	return (0);
}

function add_new_user($all_users, $login, $passwd, $first_name, $last_name) {
	$new_user = array(
		"login" => htmlentities($login),
		"passwd" => hash("whirlpool", $passwd),
		"first_name" => htmlentities($first_name),
		"last_name" => htmlentities($last_name),
		"role" => "user"
	);
	$all_users[] = $new_user;
	return ($all_users);
}

?>
