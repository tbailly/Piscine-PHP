<?php

if (file_exists('list.csv'))
{
	$content = file_get_contents('list.csv');
	$content_format = str_replace(PHP_EOL, '; ', str_replace(';', '=', $content));
	if ($content_format != "")
		echo $content_format;
}

?>