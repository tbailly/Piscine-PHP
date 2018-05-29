<?php

function login() {
	if (check_already_connected())
		return (0);
	if (!check_login_post_values())
		return (1);
	if (check_login_post_values() && !auth($_POST["login"], $_POST["passwd"]))
	{
		$_SESSION["logged_on_user"] = "";
		return (2);
	}
	else
	{
		$_SESSION["logged_on_user"] = $_POST["login"];
		return (0);
	}
}

function login_admin() {
	if (check_already_connected() && file_exists(DATABASE_PATH . '/users'))
	{
		$all_users = unserialize(file_get_contents(DATABASE_PATH . '/users'));
		if (($key = get_user_with_login($all_users, $_SESSION["logged_on_user"])) !== NULL &&
			$all_users[$key]["role"] == "admin")
			return (0); // admin and connected
		return (3); // connected but not admin
	}
	if (!check_login_post_values())
		return (1); // no connection try
	else if (file_exists(DATABASE_PATH . '/users'))
	{
		$all_users = unserialize(file_get_contents(DATABASE_PATH . '/users'));
		$key = auth($_POST["login"], $_POST["passwd"]);
		if ($key === NULL)
		{
			$_SESSION["logged_on_user"] = "";
			return (2); // connection failed
		}
		else
		{
			$_SESSION["logged_on_user"] = htmlentities($_POST["login"]);
			if ($all_users[$key]["role"] == "admin")
				return (0); // just connected as admin
			return (4); // just connected but not admin
		}
	}
}

function check_login_post_values() {
	if (isset($_POST["login"]) && $_POST["login"] !== "" &&
	isset($_POST["passwd"]) && $_POST["passwd"] !== "")
		return (TRUE);
	return (FALSE);
}

function auth($login, $passwd) {
	if (file_exists(DATABASE_PATH . '/users'))
	{
		$all_users = unserialize(file_get_contents(DATABASE_PATH . '/users'));
		foreach ($all_users as $key => $user) {
			if ($user["login"] == $login && $user["passwd"] == hash("whirlpool", $passwd))
				return ($key);
		}
	}
	return (NULL);
}

?>
