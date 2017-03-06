<?php
include("manage_img.php");
$add = $_POST['adduser'];
$del = $_POST['del_user'];
if ($add == "Add/Modify Item")
{
	if (!file_exists("./private/users.csv"))
	{
		echo "ERROR\n";
		exit (0);
	}
	$login = $_POST['user_name'];
	$passwd = $_POST['user_passwd'];
	$class = $_POST['user_class'];
	$orders = $_POST['user_orders'];
	if ($login)
	{
		$unser_var = unserialize(file_get_contents("./private/users.csv"));
		$match = 0;
		foreach ($unser_var as $key => $value)
		{
			if ($login == $value['login'])
			{
				if ($class)
					$unser_var[$key]['class'] = $class;
				if ($orders)
					$unser_var[$key]['orders'] = $orders;
				if ($passwd)
					$unser_var[$key]['passwd'] = hash("whirlpool",$passwd);
				$match = 1;
				break ;
			}
		}
		if ($match == 0 && $passwd)
		{
			if (!$class)
				$class = "traveler";
			$unser_var[] = array('login' => $login, 'passwd' => hash("whirlpool",$passwd), 'class' => $class, 'orders' => $orders);
		}
		else
		{
			if (!$passwd)
				echo "No passwd specified\n";
		}
		file_put_contents("./private/users.csv", serialize($unser_var));
	}
	else if (!$login)
			echo "No login specified\n";
}
else if ($del == "Del name" && ($login = $_POST['del_name']) != "")
{
	$unser_var = unserialize(file_get_contents("./private/users.csv"));
	foreach ($unser_var as $key => $value)
	{
		if ($login == $value['login'])
		{
			unset($unser_var[$key]);
			array_values($unser_var);
			break ;
		}
	}
	file_put_contents("./private/users.csv", serialize($unser_var));
}
?>


<html>
	<head>
		<meta charset="UTF-8">
		<title>Space users</title>
		<style type="text/css">
			body {
				background-color: rgb(34, 49, 63)
			}
			.text {
				color: white;
				font-family: PT Sans;
				font-size: 1vw;
				text-align: center;
			}
			.passwd {
				color: white;
				font-family: PT Sans;
				font-size: 1vw;
				text-align: center;
			}
			.form {
				position: relative;
				margin: auto;
				margin-top: 15%;
				width: 70%;
				height: 63vw;
				background-color: rgb(44, 62, 80);
				border-radius: 1vw;
				box-shadow: 1vw 1vw 1vw #000;
			}
			.headline {
				padding-top: 2%;
				padding-bottom: 0%;
				color: white;
				font-family: PT Sans;
				font-style: bold;
				font-size: 2vw;
				text-align: center;
			}
			.field {
				margin-left: 30%;
				width: 40%;
				height: 2vw;
			}
			.submit {
				position: absolute;
				text-align: center;
				float: right;
				width: 35%;
				font-size: 1.5vw;
				height: 3vw;
				right: 5%;
				bottom: 2%;
				background-color: white;
				border-radius: 0.5vw;
				border-color: rgb(52, 73, 94);
				box-shadow: 0.2vw 0.2vw 0.2vw #000;
			}
			.goback {
				position: absolute;
				text-align: center;
				color: white;
				float: left;
				left: 5%;
				bottom: 2%;
				font-size: 1.5vw;
				height: 2.5vw;
				
			}
			.line {
				margin-top: 0vw;
			}
			.table_header {
				margin-top: 2%;
				overflow-x: auto;
				overflow-y: scroll;

			}
			.table_container {
				overflow-x: auto;
				overflow-y: scroll;
				height: 35vw;
				padding: 1vw;
			}
			table {
				width: 100%;
				background-color: white;
				border-color: #ddd;
			}
			tr, td {
				width: 20%;
				border-bottom: 0.1vw solid #ddd;
				font-size: 1.5vw;

			}
			.header {
					background-color: #ddd;
					font-size: 2vw;
					font-style: bold;
			}
			.item_field {
				margin-top: 2%; 
				width: 23%;
				margin-right: 1%;
				font-size: 1.5vw;
			}
			.field_names {
				margin-left: 5%;
				color: white;
				font-size: 1.5vw;
			}
		</style>
	</head>
	<body>
		<form class ="form" action="space_users.php" method="POST">
			<p class="headline">Space Users</p>
			<input class="item_field" name="del_name" value=""/>
			<input class="delete" type="submit" name="del_user" value="Del name"/>
			<br \>
			<input class="item_field" name="user_name" value=""/>
			<input class="item_field" name="user_passwd" value=""/>
			<input class="item_field" name="user_class" value=""/>
			<input class="item_field" name="user_orders" value=""/>
			<input class="adduser" type="submit" name="adduser" value="Add/Modify Item"/>
			<div class="table_header">
				<table>
					<tr>
						<td class="header">Login</td>
						<td class="header">Passwd</td>
						<td class="header">Class</td>
						<td class="header">Orders</td>
					</tr>
				</table>
			</div>
			<div class="table_container">
				
				<table>

<?php
if ((file_exists("./private/users.csv")) == True)
{
	$unser_var = unserialize(file_get_contents("./private/users.csv"));
	foreach ($unser_var as $key => $value)
	{
		$login = $value['login'];
		$class = $value['class'];
		$orders = "";
					?>
						<tr>
							<td><?php echo $login ?></td>
							<td><?php echo "******" ?></td>
							<td><?php echo $class ?></td>
							<td><?php echo $orders ?></td>
						</tr>
					<?php
	}
}
?>
			    </table>
			</div>
			<a href="index.php" class="goback" type="submit" name="goback">Back to exploration<a/>
		</form>	
	</body>
</html>