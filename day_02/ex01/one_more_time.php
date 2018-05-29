#!/usr/bin/env php
<?php

one_more_time($argv, $argc);

function one_more_time($args, $argcount) {
	if ($argcount != 2)
		return;
	$string = $args[1];
	if (preg_match('/[a-zA-Z][a-z]{4,} {4}\d{1,2} {4}[a-zA-Z][a-zûé]{2,} {4}\d{4} {4}([01]?\d|2[0-3]):[0-5]\d:[0-5]\d/u', $string))
	{
		$val_array = array_filter(explode(" ", $string), "strlen");
		$val_array = array_values($val_array);
		if ((!preg_match("/^lundi$|^mardi$|^mercredi$|^jeudi$|^vendredi$|^samedi$|^dimanche$/i", $val_array[0])) ||
			(!preg_match("/^janvier$|^f[eé]vrier$|^mars$|^avril$|^mai$|^juin$|^juillet$|^ao[uû]t$|^septembre$|^octobre$|^novembre$|^d[eé]cembre$/iu", $val_array[2])) ||
			(!preg_match("/(^[1-9]$|^0[1-9]$|^[12]\d$|^3[01]$)/", $val_array[1])))
			exit("Wrong Format\n");
		else
		{
			$formatted_date = format_date($val_array);
			date_default_timezone_set('Europe/Paris');
			echo strtotime($formatted_date) . "\n";
		}
	}
}

function format_date($val_array) {
	$patterns = array('/é/u', '/û/u');
	$replacements = array('e', 'u');
	$val_array[2] = preg_replace($patterns, $replacements, $val_array[2]);
	$month_array = array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
	$month = array_search(strtolower($val_array[2]), $month_array) + 1;
	$formatted_date = $val_array[3] . "-" . $month . "-" . $val_array[1] . " " . $val_array[4] . "\n";
	return ($formatted_date);
}

?>
