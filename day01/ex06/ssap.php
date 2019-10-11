#!/usr/bin/php
<?php
    $arr = array();
    unset($argv[0]);
	foreach($argv as $val1)
	{
        $temp = array_filter(explode(' ', $val1));
        foreach ($temp as $val2)
            $arr[] = $val2;
    }
    sort($arr);
    foreach ($arr as $val)
		echo $val."\n";
?>
