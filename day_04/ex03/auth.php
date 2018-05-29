<?php

function auth($login, $passwd)
{
	if (file_exists('../private/passwd'))
	{
		$all_users = unserialize(file_get_contents('../private/passwd'));
		foreach ($all_users as $key => $user) {
			if ($user["login"] == $login && $user["passwd"] == hash("whirlpool", $passwd))
				return (TRUE);
		}
	}
	return (FALSE);
}

?>
