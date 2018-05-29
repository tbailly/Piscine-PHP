#!/usr/bin/env php
<?php

epur_str($argv, $argc);

function epur_str($args, $argcount) {
	if ($argcount != 2)
		return;
	$string = $args[1];
	$result = "";
	$i = 0;
	while ($i < strlen($string))
	{
		if ($string[$i] != " ") {
			if ($i != 0 && strlen($result) != 0 && $string[$i - 1] == " ")
				$result .= " ";
			$result .= $string[$i];
			while ($string[$i + 1] == " ")
				$i++;
		}
		$i++;
	}
	echo $result . "\n";
}

?>
