#!/usr/bin/env php
<?php

ssap2($argv, $argc);

function ssap2($args, $argcount) {
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
	$result = ft_sort_array($result);
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

function ft_sort_array($result) {
	$i = 0;

	while ($i < count($result) - 1)
	{
		$diff = ft_strcmp($result[$i], $result[$i + 1]);
		if ($diff < 0)
		{
			$tmp = $result[$i];
			$result[$i] = $result[$i + 1];
			$result[$i + 1] = $tmp;
			$i -= 2;
		}
		$i++;
	}
	return ($result);
}

function ft_strcmp($st1, $st2) {
	$s1 = strtolower($st1);
	$s2 = strtolower($st2);
	$i = 0;
	$order = "abcdefghijklmnopqrstuvwxyz0123456789 !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";

	while ($i < strlen($s1) && $i < strlen($s2))
	{
		if ($s1[$i] != $s2[$i])
		{
			$index_s1 = strpos($order, $s1[$i]);
			$index_s2 = strpos($order, $s2[$i]);
			return ($index_s2 - $index_s1);
		}
		$i++;
	}
	return (0);
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
