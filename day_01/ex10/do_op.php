#!/usr/bin/env php
<?php

do_op($argv, $argc);

function do_op($args, $argcount){
	if ($argcount != 4)
		exit("Incorrect Parameters\n");

	$val1 = (int)$args[1];
	$operator = $args[2];
	$val2 = (int)$args[3];

	if (strpos($operator, "+") !== FALSE)
		echo $val1 + $val2;
	if (strpos($operator, "-") !== FALSE)
		echo $val1 - $val2;
	if (strpos($operator, "*") !== FALSE)
		echo $val1 * $val2;
	if (strpos($operator, "/") !== FALSE)
		echo $val1 / $val2;
	if (strpos($operator, "%") !== FALSE)
		echo $val1 % $val2;
	echo "\n";
}

?>
