<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/rush00/private/config.php";
include_once ROOT . "/private/models/users_functions.php";
if (!file_exists(DATABASE_PATH))
	mkdir(DATABASE_PATH, 0777, true);
$all_users = array();
$root_user = array(
	"first_name" => "root",
	"last_name" => "root",
	"login" => "root",
	"passwd" => hash("whirlpool", "root"),
	"role" => "admin"
);
$all_users[] = $root_user;

file_put_contents(DATABASE_PATH . '/users', serialize($all_users));
file_put_contents(DATABASE_PATH . '/categories', 'a:3:{s:13:"5ac14aed0e75c";a:2:{s:4:"name";s:4:"2017";s:8:"products";a:3:{i:0;s:13:"5ac14ab35c711";i:1;s:13:"5ac14ad894e83";i:2;s:13:"5ac14adf3598d";}}s:13:"5ac14af048071";a:2:{s:4:"name";s:4:"2016";s:8:"products";a:1:{i:0;s:13:"5ac14ad894e83";}}s:13:"5ac14af818633";a:2:{s:4:"name";s:4:"2015";s:8:"products";a:1:{i:0;s:13:"5ac14ad260bb1";}}}');
file_put_contents(DATABASE_PATH . '/products', 'a:5:{s:13:"5ac14ab35c711";a:2:{s:4:"name";s:8:"tbailly-";s:5:"price";s:2:"10";}s:13:"5ac14ad260bb1";a:2:{s:4:"name";s:8:"kmendoza";s:5:"price";s:2:"10";}s:13:"5ac14ad894e83";a:2:{s:4:"name";s:8:"vtennero";s:5:"price";s:2:"12";}s:13:"5ac14adf3598d";a:2:{s:4:"name";s:8:"vburidar";s:5:"price";s:2:"15";}s:13:"5ac14ae44de21";a:2:{s:4:"name";s:6:"fbabin";s:5:"price";s:1:"2";}}');
file_put_contents(DATABASE_PATH . '/orders', "");

echo "Installation done";

?>