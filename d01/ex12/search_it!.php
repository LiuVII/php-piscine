#!/usr/bin/php
<?php
if ($argc >= 3)
{
	$search = $argv[1];
	$ret = null;
	foreach ($argv as $key => $value) 
	{
		if ($key > 1)
		{
			$arr = explode(":", $value);
			if (isset($arr[1]) && $arr[0] == $search)
				$ret = $arr[1]."\n";
		}
	}
	if ($ret != null)
		echo $ret."\n";
}
?>