#!/usr/bin/env php
<?php

do_op_2($argv, $argc);

function do_op_2($args, $argcount){
	$val_tab = array();
	if ($argcount != 2)
	{
		echo "Incorrect Parameters\n";
		return;
	}

	$op_infos = ft_get_operator_pos($args[1]);
	$numbers = get_numbers($args[1], $op_infos[0], $op_infos[1]);
	$final_res = ft_calculate($numbers[0], $numbers[1], $op_infos[1]);
	echo $final_res . "\n";
}

function get_numbers($string, $pos, $operator) {
	$i = 0;
	$numbers = array();
	$s1 = trim(substr($string, 0, $pos));
	$s2 = trim(substr($string, $pos + 1));
	
	if ($pos + 1 == strlen($string) || $pos == 0)
		exit("Syntax Error\n");
	while ($i < strlen($s1))
	{
		$ascii = ord($s1[$i]);
		if ($ascii < 48 || $ascii > 57)
			exit("Syntax Error\n");
		$i++;
	}
	$i = 0;
	while ($i < strlen($s2))
	{
		$ascii = ord($s2[$i]);
		if ($ascii < 48 || $ascii > 57)
			exit("Syntax Error\n");
		$i++;
	}
	$numbers[] = (int)$s1;
	$numbers[] = (int)$s2;
	return ($numbers);
}

function ft_get_operator_pos($string) {
	$res = array(-1, -1);
	$res[0] = -1;

	if (strpos($string, "+") !== FALSE) {
		$res[0] = strpos($string, "+");
		$res[1] = 0;
	}
	if (strpos($string, "-") !== FALSE)
	{
		if ($res[0] != -1)
			exit("Syntax Error\n");
		$res[0] = strpos($string, "-");
		$res[1] = 1;
	}
	if (strpos($string, "*") !== FALSE)
	{
		if ($res[0] != -1)
			exit("Syntax Error\n");
		$res[0] = strpos($string, "*");
		$res[1] = 2;
	}
	if (strpos($string, "/") !== FALSE)
	{
		if ($res[0] != -1)
			exit("Syntax Error\n");
		$res[0] = strpos($string, "/");
		$res[1] = 3;
	}
	if (strpos($string, "%") !== FALSE)
	{
		if ($res[0] != -1)
			exit("Syntax Error\n");
		$res[0] = strpos($string, "%");
		$res[1] = 4;
	}
	if ($res[0] == -1)
		exit("Syntax Error\n");
	return ($res);
}

function ft_calculate($n1, $n2, $operator) {
	switch ($operator) {
	case 0:
		$res = $n1 + $n2;
		break;
	case 1:
		$res = $n1 - $n2;
		break;
	case 2:
		$res = $n1 * $n2;
		break;
	case 3:
		if ($n2 == 0)
			exit("Division by zero\n");
		$res = $n1 / $n2;
		break;
	case 4:
		if ($n2 == 0)
			exit("Division by zero\n");
		$res = $n1 % $n2;
		break;
	}
	return ($res);
}

?>