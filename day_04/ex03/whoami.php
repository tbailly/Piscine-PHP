<?php

session_start();

if ($_SESSION && isset($_SESSION["logged_on_user"]) && $_SESSION["logged_on_user"] !== "")
	echo $_SESSION["logged_on_user"] . "\n";
else
	echo "ERROR\n";
?>
