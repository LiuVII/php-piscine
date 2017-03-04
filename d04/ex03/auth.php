<?php
function auth($login, $passwd)
{
	$hpasswd = hash("whirlpool", $passwd);
	$unser_var = unserialize(file_get_contents("../private/passwd"));
	foreach ($unser_var as $key => $value)
	{
		if ($value['login'] === $login && $value['passwd'] === $hpasswd)
			return TRUE;
	}
	return FALSE;
}
?>