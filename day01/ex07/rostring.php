#!/usr/bin/php
<?php
if ($argc > 1)
{
	$list = array_filter(explode(" ", $argv[1]));
	$firstW = array_splice($list, 0, 1);
	$list = array_merge($list, $firstW);
	echo implode(" ", $list)."\n";
}
?>
