<?php
function auth($login, $passwd)
{
	$hpasswd = hash("whirlpool", $passwd);
	if (!file_exists("./private"))
		return FALSE;
	if (!file_exists("./private/users.csv"))
		return FALSE;
	$unser_var = unserialize(file_get_contents("./private/users.csv"));
	foreach ($unser_var as $key => $value)
	{
		if ($value['login'] === $login && $value['passwd'] === $hpasswd)
			return $value['class'];
	}
	return FALSE;
}
?>