<?php

include 'auth.php';
session_start();
login();

function login() {
	if (!check_get_values())
		echo "ERROR\n";
	else if (!auth($_GET["login"], $_GET["passwd"]))
	{
		$_SESSION["logged_on_user"] = "";
		echo "ERROR\n";
	}
	else
	{
		$_SESSION["logged_on_user"] = $_GET["login"];
		echo "OK\n";
	}
}

function check_get_values() {
	if ($_GET && isset($_GET["login"]) && $_GET["login"] !== "" &&
		isset($_GET["passwd"]) && $_GET["passwd"] !== "")
		return (TRUE);
	return (FALSE);
}

?>
