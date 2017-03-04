<?php
include("auth.php");

session_start();
if (($login = $_POST['login']) && ($passwd = $_POST['passwd'])
	&& auth($login, $passwd) == TRUE)
{
	$_SESSION['logged_on_user'] = $login;
	?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>42_Chat</title>
			</head>
			<body>
				<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
				<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
			</body>
		</html>
	<?php
}
else
{
	$_SESSION['logged_on_user'] = "";
	echo "ERROR\n";
}
?>


