<?php
$submit = $_POST["submit"];
if ($submit === "OK" && ($passwd = $_POST["passwd"]) !== ""
	&& $passwd === $_POST["cfpasswd"])
{
	$login = $_POST["login"];
	if (!file_exists("./private"))
		mkdir("./private");
	if (!file_exists("./private/users.csv"))
		file_put_contents("./private/users.csv", serialize(array()));
	$unser_var = unserialize(file_get_contents("./private/users.csv"));
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
		$unser_var[] = array('login' => $login, 'passwd' => hash("whirlpool",$passwd), 'class' => 'traveler');
		file_put_contents("./private/users.csv", serialize($unser_var));
		header("Location: index.php");
		echo "OK\n";
	}
}
else
	echo "ERROR\n";
?>