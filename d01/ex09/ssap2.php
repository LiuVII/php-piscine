#!/usr/bin/php
<?php

function get_mod_ascii($char)
{
	$num = ord($char);
	if ($num == 0)
		return 0;
	else if ($num >= 65 && $num <= 90)
		$num += 32;
	else if ($num >= 48 && $num <= 57)
		$num += 500;
	else if ($num < 48 || $num > 122 || ($num > 57 && $num < 65) || ($num > 90 && $num < 97))
		$num += 1000;
	return $num;
}

function ft_strcmp($str1, $str2)
{
	$len1 = strlen($str1);
	$len2 = strlen($str2);
	$len = min($len1, $len2);
	for ($i=0; $i <= $len; $i++)
	{
		$ch1 = get_mod_ascii($str1[$i]);
		$ch2 = get_mod_ascii($str2[$i]);
		if ($ch1 != $ch2)
			return ($ch1 - $ch2);
	}
	return ($len1 - $len2);
}

function isempty($str)
{
	if ($str == "")
		return 0;
	return 1;
}

function ft_split($line)
{
	$arr = array_filter(explode(" ", $line), "isempty");
	usort($arr, "ft_strcmp");
	return $arr;
}

$line = "";
foreach ($argv as $key => $value)
{
	if ($key != 0)
		$line = $line." ".$value;
}
$arr = ft_split($line);
foreach ($arr as $elem)
	echo $elem."\n";
?>