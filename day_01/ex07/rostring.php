#!/usr/bin/env php
<?php

rostring($argv, $argc);

function rostring($args, $argcount) {
	$result = array();
	
	if ($argcount < 2)
		return;
	$result = ft_split($args[1]);
	array_push($result, $result[0]);
	array_shift($result);
	ft_print_array($result);
}

function ft_split($string) {
	$result = array();
	$i = 0;
	$j = 0;

	while ($i < strlen($string))
	{
		if ($string[$i] != " " && $string[$i] != "\t")
		{
			$result[$j] .= $string[$i];			
			if ($string[$i + 1] == " " || $string[$i + 1] == "\t")
				$j++;
		}
		$i++;
	}
	return ($result);
}

function ft_print_array($array) {
	$i = 0;

	while ($i < count($array))
	{
		echo $array[$i];
		if ($i < count($array) - 1)
			echo " ";
		$i++;
	}
	echo "\n";
}

?>
