<?php
if (($act = $_GET['action']))
{
	if ($act === "set")
	{
		if ($_GET['name'] && $_GET['value'])
			setcookie($_GET['name'], $_GET['value'], time() + 3600);
	}
	else if ($act === "get")
	{
		if ($_GET['name'] && $_COOKIE[$_GET['name']] && !($_GET['value']))
			echo $_COOKIE[$_GET['name']]."\n";
	}
	else if ($act === "del")
	{
		if ($_GET['name'] && !($_GET['value']))
			setcookie($_GET['name'], '', 1);
	}
}
?>