#!/usr/bin/env php
<?php

aff_param($argv, $argc);

function aff_param($args, $argcount) {
	$i = 1;

	while ($i < $argcount)
	{
		echo $args[$i] . "\n";
		$i++;
	}
}

?>
