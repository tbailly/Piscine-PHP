#!/usr/bin/env php
<?php

who($argv, $argc);

function who($args, $argcount) {
	echo get_current_user();
	$handle = fopen("/usr/include/utmpx.h", "r");
	print_r($handle);
}


?>
