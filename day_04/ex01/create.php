<?php

create();

function create() {
	if (!check_post_values())
	{
		echo "ERRORA\n";
		return;
	}
	$all_users = array();
	if (!file_exists('../private'))
	    mkdir('../private', 0777, true);
	if (($all_users = get_all_users($_POST["login"])) === NULL)
	{
		echo "ERRORB\n";
		return;
	}
	$all_users = add_new_user($all_users, $_POST["login"], $_POST["passwd"]);
	file_put_contents('../private/passwd', serialize($all_users));
	echo "OK\n";
}

function check_post_values() {
	if ($_POST && isset($_POST["login"]) && $_POST["login"] !== "" &&
	isset($_POST["passwd"]) && $_POST["passwd"] !== "" &&
	isset($_POST["submit"]) && $_POST["submit"] == "OK")
		return (TRUE);
	return (FALSE);
}

function get_all_users($login) {
	$all_users = array();
	if (file_exists('../private/passwd'))
	{
		$all_users = unserialize(file_get_contents('../private/passwd'));
		foreach ($all_users as $key => $user) {
			if ($user["login"] == $login)
				return (NULL);
		}
	}
	return ($all_users);
}

function add_new_user($all_users, $login, $passwd) {
	$new_user = array(
		"login" => $login,
		"passwd" => hash("whirlpool", $passwd)
	);
	$all_users[] = $new_user;
	return ($all_users);
}

?>
