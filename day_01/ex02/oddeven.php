#!/usr/bin/env php
<?php

oddeven();

function oddeven() {
	echo "Entrez un nombre: ";
	while($s = fgets(STDIN)){
		$resolve = ft_check_if_number($s);

		if ($resolve == -1)
			echo "'" . substr($s, 0, strlen($s) - 1) . "' n'est pas un chiffre\n";
		else if ($resolve % 2 == 0)
			echo "Le chiffre " . substr($s, 0, strlen($s) - 1) . " est Pair\n";
		else
			echo "Le chiffre " . substr($s, 0, strlen($s) - 1) . " est Impair\n";

		echo "Entrez un nombre: ";
	}
}

function ft_check_if_number($s) {
	$i = 0;
	$resolve = TRUE;

	if ($s[$i] == "\n")
		return (-1);
	while ($i < strlen($s) - 1)
	{
		if (ord($s[$i]) < 48 || ord($s[$i]) > 57)
		{
			if (!((ord($s[$i]) == 43 && $i == 0) || (ord($s[$i]) == 45 && $i == 0)))
			{
				$resolve = FALSE;
				break;
			}
		}
		$i++;
	}
	if ($resolve === TRUE)
		return (substr($s, -2, 1));
	else
		return (-1);
}

?>
