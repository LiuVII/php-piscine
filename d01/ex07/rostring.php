#!/usr/bin/php
<?php
if ($argc > 1)
{
	$arr = array_filter(explode(" ", $argv[1]));
	$n = sizeof($arr);
	if ($n > 1)
		echo $arr[$n-1]." ".join(" ", array_slice($arr, 0, -1))."\n";
	else if ($n == 1)
		echo ($arr[0])."\n";
}
?>