<?php
$submit = $_POST["submit"];
if ($submit === "OK" && ($_POST["newpw"]) !== "")
{
	$login = $_POST["login"];
	$newpw = hash("whirlpool",$_POST["newpw"]);
	$oldpw = hash("whirlpool",$_POST["oldpw"]);
	$unser_var = unserialize(file_get_contents("./private/users.csv"));
	foreach ($unser_var as $key => $value)
	{
		if ($value['login'] === $login && $value['passwd'] === $oldpw)
		{
			$unser_var[$key]['passwd'] = $newpw;
			file_put_contents("./private/users.csv", serialize($unser_var));
			header("Location: index.php");
			echo "OK";
			return ;
		}
	}
	echo "ERROR\n";
}
else
	echo "ERROR\n";
?>