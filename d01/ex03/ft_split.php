#!/usr/bin/php
<?php
function ft_split($line)
{
	$arr = array_filter(explode(" ", $line));
	sort($arr);
	return $arr;
}
?>