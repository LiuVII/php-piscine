#!/usr/bin/php
<?php
function isempty($str)
{
	if ($str == "")
		return 0;
	return 1;
}

function ft_split($line)
{
	$arr = array_filter(explode(" ", $line), "isempty");
	sort($arr);
	return $arr;
}

$line = "";
foreach ($argv as $key => $value)
{
	if ($key != 0)
		$line .= " ".$value;
}
$arr = ft_split($line);
foreach ($arr as $elem)
	echo $elem."\n";
?>