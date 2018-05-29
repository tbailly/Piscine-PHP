<?php

if (file_exists('list.csv') && $_GET && isset($_GET["key"]))
{
	$key = $_GET["key"];
	$content = preg_replace('/'.$key.';.+\n/', '', file_get_contents('list.csv'));
	file_put_contents('list.csv', $content);
	echo "ok";
}

?>