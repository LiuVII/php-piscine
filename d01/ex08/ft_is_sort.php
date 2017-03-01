#!/usr/bin/php
<?php
function ft_is_sort($arr)
{
	$sorted = $arr;
	sort($sorted);
	print_r($sorted);
	foreach ($arr as $key => $value)
		if ($value != $sorted[$key])
			return False;
	return True;
}
?>