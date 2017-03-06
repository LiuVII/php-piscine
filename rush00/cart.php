<?php
session_start();
$login = $_SESSION['logged_on_user'];
if (!$login)
	$login = "guest";
?>
<?php
$archive = $_POST['archive'];
if ($archive == "Bring me my stars!")
{
	if ($login == "guest")
	{
		header("Location: login.html");
		echo "You're not logged in\n";		
		exit (0);
	}
	// Get order from cart
	$cart_var = unserialize(file_get_contents("./private/cart.csv"));
	$cart_order = "";
	foreach ($cart_var as $key => $value)
	{
		if ($login == $value['login'])
		{
			$cart_order = $value['order'];
			unset($cart_var[$key]);
			break ;
		}
	}
	if ($cart_order == "")
	{
		header("Location: cart.php");
		$_POST['archive'] = "";
		echo "Cart is empty\n";
		exit(0);
	}
	file_put_contents("./private/cart.csv", serialize($cart_var));
	// Archive orders
	$orders_var = unserialize(file_get_contents("./private/orderdb.csv"));
	$orders = array();
	$match = 0;
	foreach ($orders_var as $key => $value)
	{
		if ($value['login'] == $login)
		{
			$orders_var[$key]['orders'][] = $cart_order;
			$match = 1;
			break ;
		}
	}
	if ($match == 0)
		$orders_var[] = array('login' => $login, 'orders' => array($cart_order));
	file_put_contents("./private/orderdb.csv", serialize($orders_var));
	$_POST['archive'] = "";
	header("Location: cart.php");
	exit(0);
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Local Cluster Cart</title>
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
				width: 50%;
				height: 45vw;
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
			.table_container {
				overflow-x: auto;
				overflow-y: scroll;
				height: 30vw;
				padding: 1vw;
			}
			.table_header {
				margin-top: 2%;
				overflow-x: auto;
				overflow-y: scroll;

			}
			table {
				width: 100%;
				background-color: white;
				border-color: #ddd;
			}
			tr, td {
				border-bottom: 0.1vw solid #ddd;
				font-size: 1.5vw;
				width: 25%;

			}
			.header {
					background-color: #ddd;
					font-size: 2vw;
					font-style: bold;
			}
			.img_cell {
				width: 25%;
			}
			.item_img {
				width: 100%;
			}
		</style>
	</head>
	<body>
		<form class ="form" action="cart.php" method="POST">
			<p class="headline">Local Cluster Cart</p>
			<div class="table_header">
				<table>
					<tr>
						<td class="header">Image</td>
						<td class="header">My Stars</td>
						<td class="header">Share</td>
						<td class="header">Price, Cr</td>
					</tr>
				</table>
			</div>
			<div class="table_container">
				<table>
<?php
if ((file_exists("./private/cart.csv")) == True)
{
	$unser_var = unserialize(file_get_contents("./private/cart.csv"));
	$match = 0;
	foreach ($unser_var as $key => $value)
	{
		if ($login == $value['login'])
		{
			$order_arr = $value['order'];
			$match = 1;
			break ;
		}

	}
	if ($match == 1)
		foreach ($order_arr as $key => $value)
			{
				$name = $value['name'];
				$img = $value['img'];
				$share = $value['share'];
				$price = $value['price'];
							?>
								<tr>
									<td class="img_cell"><img class="item_img" src=<?php echo $img ?> title=<?php echo $img ?>></td>
									<td><?php echo $name ?></td>
									<td><?php echo $share ?></td>
									<td><?php echo $price ?></td>							
								</tr>
							<?php
			}
}
?>
			    </table>
			</div>
			<a href="index.php" class="goback" type="submit" name="goback">Back to exploration<a/>
			<input class="submit" type="submit" name="archive" value="Bring me my stars!"/>	
		</form>	
	</body>
</html>