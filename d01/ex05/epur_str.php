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
	$line = $argv[1];
	$arr = array_filter(explode(" ", $line), "isempty");
	echo join(" ", $arr)."\n";
}
?>