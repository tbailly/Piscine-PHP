<?php

function ft_is_sort($tab) {
	$i = 0;

	$sort = (strcmp($tab[$i], $tab[$i + 1]) > 0) ? 0 : 1;
	$i++;
	while ($i < count($tab) - 1)
	{
		if ((strcmp($tab[$i], $tab[$i + 1]) > 0 && $sort == 1) ||
			(strcmp($tab[$i], $tab[$i + 1]) < 0 && $sort == 0))
			return (0);
		$i++;
	}
	return (1);
}

?>
