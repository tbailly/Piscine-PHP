<?php

modif();

function modif() {
	if (!check_post_values() || !file_exists('../private/passwd'))
	{
		echo "ERROR\n";
		return;
	}
	$all_users = array();
	if (($all_users = modify_user($_POST["login"], $_POST["oldpw"], $_POST["newpw"])) === NULL)
	{
		echo "ERROR\n";
		return;
	}
	file_put_contents('../private/passwd', serialize($all_users));
	echo "OK\n";
}

function check_post_values() {
	if ($_POST && isset($_POST["login"]) && $_POST["login"] !== "" &&
	isset($_POST["oldpw"]) && $_POST["oldpw"] !== "" &&
	isset($_POST["newpw"]) && $_POST["newpw"] !== "" &&
	isset($_POST["submit"]) && $_POST["submit"] == "OK")
		return (TRUE);
	return (FALSE);
}

function modify_user($login, $oldpw, $newpw) {
	$all_users = array();
	if (file_exists('../private/passwd'))
	{
		$all_users = unserialize(file_get_contents('../private/passwd'));
		foreach ($all_users as $key => $user) {
			if ($user["login"] == $login)
			{
				if ($user["passwd"] != hash("whirlpool", $oldpw))
					return (NULL);
				$all_users[$key]["passwd"] = hash("whirlpool", $newpw);
				return ($all_users);
			}
		}
	}
	return (NULL);
}

?>
