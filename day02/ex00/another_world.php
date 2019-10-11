#!/C/PHP7/php
<?PHP
	function epur($str)
	{
		$str = trim($str);
		$str = preg_replace('/ +/', ' ', $str);
		$str = preg_replace('/\t/', ' ', $str);
		return ($str);
	}
	
	if (count($argv) != 2)
		return ;
	echo epur($argv[1]) . "\n";
?>
