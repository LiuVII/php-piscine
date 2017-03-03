#!/usr/bin/php
<?php
function isempty($str)
{
	if ($str == "")
		return 0;
	return 1;
}

if ($argc > 1)
{
	$arr = array_filter(explode(" ", $argv[1]), "isempty");
	$n = sizeof($arr);
	$arr = array_values($arr);
	if ($n > 1)
		echo join(" ", array_slice($arr, 1))." ".$arr[0];
	else if ($n == 1)
		echo ($arr[0]);
	echo "\n";
}
?>