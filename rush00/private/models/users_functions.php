<?php

function check_user_post_values($check_passwd) {
	if ($_POST && isset($_POST["last_name"]) && $_POST["last_name"] !== "" &&
	isset($_POST["first_name"]) && $_POST["first_name"] !== "" &&
	isset($_POST["login"]) && $_POST["login"] !== "")
	{
		if ($check_passwd)
		{
			if (isset($_POST["passwd"]) && $_POST["passwd"] !== "")
				return (TRUE);
			return (FALSE);
		}
		return (TRUE);
	}
	return (FALSE);
}

function get_all_users() {
	$all_users = array();
	if (file_exists(DATABASE_PATH . '/users'))
		$all_users = unserialize(file_get_contents(DATABASE_PATH . '/users'));
	return ($all_users);
}

function get_user_with_login($all_users, $login) {
	foreach ($all_users as $key => $user) {
		if ($user["login"] == $login)
			return ($key);
	}
	return (NULL);
}

function check_already_connected() {
	if ($_SESSION && isset($_SESSION["logged_on_user"]) && $_SESSION["logged_on_user"] !== "")
		return (TRUE);
	return (FALSE);
}

function check_admin($login) {
	$all_users = get_all_users();
	if (($key = get_user_with_login($all_users, $login)) !== NULL)
	{
		if ($all_users[$key]["role"] == "admin")
			return (TRUE);
		return (FALSE);
	}
	return (NULL);
}

?>