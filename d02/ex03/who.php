#!/usr/bin/php
<?php

$fd = fopen("/var/run/utmpx", "r");
$users = array();
while ($line = fread($fd, 628))
{
	$arr = unpack("a256user/a4id/a32line/ipid/itype/I2time", $line);
	print_r($arr);
	// foreach ($arr as $key => $value)
	// {
	// 	echo $key;
	// 	print_r($vlaue);
	// }
	// echo ."\n";
}
?>