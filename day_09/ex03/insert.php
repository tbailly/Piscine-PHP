<?php

if ($_GET && isset($_GET["toDo"]) && file_exists('list.csv'))
{
	if ($_GET["toDo"] == htmlentities($_GET["toDo"])) {
		$content = file_get_contents('list.csv');
		$key = 0;
		while (preg_match('/'.$key.';.+\n/', $content) == 1) {
			$key++;
		}
		$toDo = $_GET["toDo"];
		file_put_contents('list.csv', "$key;$toDo" . PHP_EOL, FILE_APPEND);
		echo $key;
	}
	else
		echo "WRONG";
}

?>
