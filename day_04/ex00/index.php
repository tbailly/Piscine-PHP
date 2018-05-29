<?php

session_start();

if ($_GET && isset($_GET["submit"]) && $_GET["submit"] == "OK")
{
	if (isset($_GET["login"]))
		$_SESSION["login"] = $_GET["login"];
	if (isset($_GET["passwd"]))
		$_SESSION["passwd"] = $_GET["passwd"];
}

?>

<html>
<body>
	<form action="index.php">
		Identifiant: <input type="text" name="login" value="<?= $_SESSION["login"] ?>">
		<br>
		Mot de passe: <input type="password" name="passwd" value="<?= $_SESSION["passwd"] ?>">
		<input type="submit" name="submit" value="OK">
	</form>0
</body>
</html>
