#!/usr/bin/env php
<?php

another_world($argv, $argc);

function another_world($args, $argcount) {
	if ($argcount < 2)
		return;
	$string = $args[1];

	$patterns = array(
		0 => '/([ 	])+/',
		1 => '/^([ 	])+/',
		2 => '/([ 	])+$/'
	);
	$replacements = array(
		0 => ' ',
		1 => '',
		2 => ''
	);

	echo preg_replace($patterns, $replacements, $string) . "\n";

}

?>
