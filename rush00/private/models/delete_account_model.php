<?php

function delete_account() {
	if (!check_already_connected())
		return (1);

	$login = $_SESSION["logged_on_user"];
	logout();
	$all_users = unserialize(file_get_contents(DATABASE_PATH . '/users'));
	foreach ($all_users as $key => $user) {
		if ($user["login"] == $login)
		{
			unset($all_users[$key]);
			file_put_contents(DATABASE_PATH . '/users', serialize($all_users));
			return(0);
		}
	}
	return (2);
}

?>
