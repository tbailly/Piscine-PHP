#!/usr/bin/env php
<?php

include("ft_is_sort.php");

// $tab = array("!#$%^&", "42", "Hello World !", "salut", "zZzZzZz");
// $tab[] = "Et qu'est ce qu'on fait maintenant ?";
$tab = array("zZzZzZz", "salut", "Hello World !", "42", "!#$%^&");
$tab[] = "!$ Et qu'est ce qu'on fait maintenant";

if (ft_is_sort($tab))
	echo "Le tableau est trie\n";
else
	echo "Le tableau n'est pas trie\n";
print_r($tab);

?>