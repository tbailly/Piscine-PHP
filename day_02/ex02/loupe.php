#!/usr/bin/env php
<?php

loupe($argv, $argc);

function loupe($args, $argcount) {
	if ($argcount != 2)
		return;
	$file_content = file_get_contents($args[1]);
	if (preg_match_all("/<a.*<\/a>/is", $file_content, $a_tags))
	{
		foreach ($a_tags[0] as $a_tag) {
			if (preg_match_all("/title=\".*\"/i", $a_tag, $titles))
			{
				foreach ($titles[0] as $title) {
					$title_split = explode("title=", $title);
					$title_replace = "title=" . strtoupper($title_split[1]);
					$file_content = str_replace($title, $title_replace, $file_content);
				}
			}
			if (preg_match_all("/>[^><\n]+</", $a_tag, $contents))
			{
				foreach ($contents[0] as $content) {
					$content_replace = strtoupper($content);
					$file_content = str_replace($content, $content_replace, $file_content);
				}
			}
		}
	}
	echo $file_content . "\n";
}


?>
