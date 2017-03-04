<?php
$submit = $_POST["submit"];
if ($submit === "OK" && ($passw = $_POST["passwd"]) !== "")
{
	$login = $_POST["login"];
	if (!file_exists("../private"))
		mkdir("../private");
	if (!file_exists("../private/passwd"))
		file_put_contents("../private/passwd", serialize(array()));
	$unser_var = unserialize(file_get_contents("../private/passwd"));
	$flag = 0;
	foreach ($unser_var as $key => $value)
	{
		if ($value['login'] === $login)
		{
			$flag = 1;
			break ;
		}
	}
	if ($flag == 1)
		echo "ERROR\n";
	else
	{	
		$unser_var[] = array('login' => $login, 'passwd' => hash("whirlpool",$passw));
		file_put_contents("../private/passwd", serialize($unser_var));
		header("Location: index.html");
		echo "OK\n";
	}
}
else
	echo "ERROR\n";
?>