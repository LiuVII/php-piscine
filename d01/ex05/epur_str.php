#!/usr/bin/php
<?php
if ($argc > 1)
{
	$line = $argv[1];
	$arr = array_filter(explode(" ", $line));
	echo join(" ", $arr)."\n";
}
?>