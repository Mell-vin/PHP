#!/C/PHP7/php
<?php
$arr = trim($argv[1], " ");
$new_arr = explode(" ", $arr);
print_r($new_arr);
echo "\n\n";
$i = 0;
while ($i < count($new_arr))
{
	if ($new_arr[$i] == " ")
	{
		echo " ";
		while ($new_arr[$i] == " ")
			$i++;
	}
	echo "$new_arr[$i]";
	$i++;
}
?>

