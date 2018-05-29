#!/usr/bin/env php
<?php

search_it($argv, $argc);

function search_it($args, $argcount){
	$dictionnary = array();
	
	if ($argcount < 3)
		return;
	$dictionnary = ft_create_dictionnary($args, $argcount);
	if ($dictionnary[$args[1]])
		echo $dictionnary[$args[1]] . "\n";
}

function ft_create_dictionnary($args, $argcount) {
	$i = 2;
	$dictionnary = array();

	while ($i < $argcount)
	{
		if (($pos1 = strpos($args[$i], ":"))) {
			if (strrpos($args[$i], ":", $pos1 + 1))
				return;
		}
		$tmp = array_filter(explode(":", $args[$i]), "strlen");
		if (count($tmp) == 2)
			$dictionnary[$tmp[0]] = $tmp[1];
		else
			return;
		$i++;
	}
	return ($dictionnary);
}

?>
