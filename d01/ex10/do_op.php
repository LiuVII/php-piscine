#!/usr/bin/php
<?php
function do_op($a, $b, $func)
{
	if ($func == '+')
		return $a + $b;
	else if ($func == '-')
		return $a - $b;
	else if ($func == '*')
		return $a * $b;
	else if ($b != 0)
	{
		if ($func == '/')
			return $a / $b;
		else if ($func == '%')
			return $a % $b;
	}
}

if ($argc != 4)
	echo "Incorrect Parameters\n";
else
	echo do_op(trim($argv[1]), trim($argv[3]), trim($argv[2]))."\n";
?>