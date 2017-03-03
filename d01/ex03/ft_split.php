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
?>