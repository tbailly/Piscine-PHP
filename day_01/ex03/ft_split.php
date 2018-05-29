<?php

function ft_split($string) {
	$result = array();
	$i = 0;
	$j = 0;

	while ($i < strlen($string))
	{
		if ($string[$i] != " ")
		{
			$result[$j] .= $string[$i];			
			if ($string[$i + 1] == " ")
				$j++;
		}
		$i++;
	}
	$result = ft_sort_array($result);
	return ($result);
}

function ft_sort_array($result) {
	$i = 0;

	while ($i < count($result) - 1)
	{
		if (strcmp($result[$i], $result[$i + 1]) > 0)
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

?>
