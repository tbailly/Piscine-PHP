<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";

if ($_POST["submit"] === "OK" && $_POST["newpw"] == "")
{
	echo "Merci de remplir le formulaire pour modifier le compte\n";
	return ;
}

if ($_POST["submit1"] === "OK" && $_POST["newlogin"] == "")
{
	echo "Merci de remplir le formulaire pour modifier le login\n";
	return ;
}

if ($_POST["submit2"] === "OK" && $_POST["dellogin"] == "")
{
	echo "Merci de remplir le formulaire pour suprimer un compte\n";
	return ;
}

$info_arr = array(
	"login"	=> $_POST['login'],
  "login2"	=> $_POST['login2'],
  "dellogin"	=> $_POST['dellogin'],
  "newlogin" => $_POST['newlogin'],
	"newpw"	=> hash("whirlpool", $_POST['newpw']),
);

$main_arr = unserialize(file_get_contents("../private/database/users"));

foreach($main_arr as &$elem)
{
	if ($elem["login"] === $info_arr["login"] && $_POST["submit"] === "OK")
	{
		$elem["passwd"] = $info_arr["newpw"];
		file_put_contents("../private/database/users", serialize($main_arr));
		echo "Mot de passe modifier\n";
		return ;
	}
  if ($elem["login"] === $info_arr["login2"] && $_POST["submit1"] === "OK")
	{
		$elem["login"] = $info_arr["newlogin"];
		file_put_contents("../private/database/users", serialize($main_arr));
		echo "Login Modifier\n";
		return ;
	}
  if ($elem["login"] === $info_arr["dellogin"] && $_POST["submit2"] === "OK")
  {
    foreach ($main_arr as $key)
    {
  			unset($main_arr[$key]);
  			file_put_contents(DATABASE_PATH . '/users', serialize($main_arr));
        echo "Compte Suprimer\n";
      }
    }
}
echo "NONE\n";

?>
