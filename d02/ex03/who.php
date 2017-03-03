#!/usr/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');
$fd = fopen("/var/run/utmpx", "r");
$users = array();
while ($line = fread($fd, 628))
{
	$arr = unpack("a256user/a4id/a32line/ipid/itype/I2time", $line);
	if ($arr['type'] == 7)
	{
		$line = substr($arr['line'], 0, strpos($arr['line'], null));
		$user = substr($arr['user'], 0, strpos($arr['user'], null));
		if (getdate($arr['time1'])['mday'] < 10)
			printf("%-8s %-8s %-8s \n", $user, $line, date('M  j H:i', $arr['time1']));
		else
			printf("%-8s %-8s %-8s \n", $user, $line, date('M j H:i', $arr['time1']));
	}
}
?>