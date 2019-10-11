<?php
function ft_split($string)
{
	$new_str = trim($string, " ");
	$new_arr = array_filter(explode(" ", $new_str), strlen);
	sort($new_arr);
	return ($new_arr);
}
?>
