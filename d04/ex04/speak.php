<?php
date_default_timezone_set("America/Los_Angeles");
session_start();
if (!($_SESSION['logged_on_user']))
	echo "ERROR\n";
else
{
	$msg = $_POST["msg"];
	$login = $_SESSION['logged_on_user'];
	$time = time();
	if (!file_exists("../private"))
		mkdir("../private");
	if (!file_exists("../private/chat"))
		file_put_contents("../private/chat", serialize(array()));
	$fp = fopen("../private/chat", "r+");
	// if (flock($fp, LOCK_EX))
	// {
		$unser_var = unserialize(file_get_contents("../private/chat"));
		$unser_var[] = array('login' => $login, 'time' => $time, 'msg' => $msg);
		file_put_contents("../private/chat", serialize($unser_var));
	// 	flock($fp, LOCK_UN);
	// }
	fclose($fp);
	?>
	<html>
	<head>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
	</head>
	<body>
		<form action="speak.php" method="POST">
			User: <b><?php echo $login; ?></b>
			<br />
			<input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
		</form>
	</body>
	<?php
}
?>