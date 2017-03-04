<?php
include("auth.php");

session_start();
$_SESSION['logged_on_user'] = "";
if (($login = $_GET['login']) && ($passwd = $_GET['passwd'])
	&& auth($login, $passwd) == True)
{
	$_SESSION['logged_on_user'] = $login;
	echo "OK\n";
	echo $login."\n";
}
else
	echo "ERROR\n";
?>