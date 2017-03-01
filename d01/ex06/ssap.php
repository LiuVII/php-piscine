#!/usr/bin/php
<?php
function ft_split($line)
{
	$arr = array_filter(explode(" ", $line));
	sort($arr);
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