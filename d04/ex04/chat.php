<?php
date_default_timezone_set("America/Los_Angeles");
if (!file_exists("../private") || !file_exists("../private/chat"))
	return ;
// $fp = fopen("../private/chat", "r");
// if (flock($fp, LOCK_SH))
// {
	$msg = $_POST["msg"];
	$login = $_POST["login"];
	$time = time();
	$unser_var = unserialize(file_get_contents("../private/chat"));
	foreach ($unser_var as $key => $value)
	{
		$msg = $value['msg'];
		$login = $value['login'];
		$time = date('H:i:s',$value['time']);
		if ($msg != "")
			echo "[{$time}] <b>{$login}</b>: {$msg}<br />";
	}
// 	flock($fp, LOCK_UN);
// }
// fclose($fp);
?>
