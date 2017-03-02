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

if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	if (sizeof($arr=explode("+", $argv[1])) == 2)
	{
		if (is_numeric(trim($arr[0])) && is_numeric(trim($arr[1])))
		{
			echo do_op(trim($arr[0]), trim($arr[1]), '+')."\n";
			return ;
		}
	}
	else if (sizeof($arr=explode("-", $argv[1])) == 2)
	{
		if (is_numeric(trim($arr[0])) && is_numeric(trim($arr[1])))
		{
			echo do_op(trim($arr[0]), trim($arr[1]), '-')."\n";
			return ;
		}
	}
	else if (sizeof($arr=explode("*", $argv[1])) == 2)
	{
		if (is_numeric(trim($arr[0])) && is_numeric(trim($arr[1])))
		{
			echo do_op(trim($arr[0]), trim($arr[1]), '*')."\n";
			return ;
		}
	}
	else if (sizeof($arr=explode("/", $argv[1])) == 2)
	{
		if (is_numeric(trim($arr[0])) && is_numeric(trim($arr[1])))
		{
			echo do_op(trim($arr[0]), trim($arr[1]), '/')."\n";
			return ;
		}
	}
	else if (sizeof($arr=explode("%", $argv[1])) == 2)
	{
		if (is_numeric(trim($arr[0])) && is_numeric(trim($arr[1])))
		{
			echo do_op(trim($arr[0]), trim($arr[1]), '%')."\n";
			return ;
		}
	}
	echo "Syntax Error\n";
}
?>