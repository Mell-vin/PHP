#!/usr/bin/php
<?php
$i = 1;
while($i < $argc)
{
	print($argv[$i]);
	$i++;
	if ($i != $argc)
		echo "\n";
}
