#!/usr/bin/env php
<?php

ssap($argv, $argc);

function ssap($args, $argcount) {
	$i = 1;
	$j = 0;
	$result = array();

	while ($i < $argcount)
	{
		$tmpres = ft_split($args[$i]);
		$j = 0;
		while($j < count($tmpres))
		{
			array_push($result, $tmpres[$j]);
			$j++;
		}
		$i++;
	}
	sort($result);
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
		echo $array[$i] . "\n";
		$i++;
	}
}

?>
