<?php

function logout() {
	if (check_already_connected())
	{
		$_SESSION["logged_on_user"] = "";
		return (0);
	}
	return (1);
}

?>
