#!/usr/bin/php
<?php
	echo "Enter a number: ";
	$num = '';
	while (fscanf(STDIN, "%s\n", $num))
	{
		if (is_numeric($num))
			echo "The number ".$num." is ".(($num % 2) == 0 ? "even" : "odd")."\n";
		else
			echo "'".$num."' is not a number\n";
		echo "Enter a number: ";
	}
?>
