<?php
include("manage_img.php");
$add = $_POST['additem'];
$del = $_POST['del'];
if ($add == "Add/Modify Item")
{
	if (!file_exists("./private/items.csv"))
	{
		echo "ERROR\n";
		exit (0);
	}
	$name = $_POST['item_name'];
	$class = $_POST['item_class'];
	$loc = $_POST['item_loc'];
	$price = $_POST['item_price'];
	$img = $_POST['item_img'];
	if ($name)
	{
		$unser_var = unserialize(file_get_contents("./private/items.csv"));
		$match = 0;
		foreach ($unser_var as $key => $value)
		{
			if ($name == $value['name'])
			{
				if ($class)
					$unser_var[$key]['class'] = $class;
				if ($location)
					$unser_var[$key]['loc'] = $loc;
				if ($price !== "")
					$unser_var[$key]['price'] = $price;
				if ($img)
				{
					$img = putimage($img, $unser_var[$key]['name']);
					$unser_var[$key]['img'] = $img;
				}
				$match = 1;
				break ;
			}
		}
		if ($class && $loc && $img && $match == 0)
		{
			$img = putimage($img, $name);
			$unser_var[] = array('name' => $name, 'class' => $class, 'loc' => $loc, 'price' => $price, 'img' => $img);
		}
		else
		{
			if (!$class)
				echo "No class specified\n";
			if (!$loc)
				echo "No location specified\n";
			if (!$img)
				echo "No img link specified\n";
		}
		file_put_contents("./private/items.csv", serialize($unser_var));
	}
	else if (!$name)
			echo "No name specified\n";
}
else if ($del == "Del item" && ($name = $_POST['del_name']) != "")
{
	$unser_var = unserialize(file_get_contents("./private/items.csv"));
	foreach ($unser_var as $key => $value)
	{
		if ($name == $value['name'])
		{
			unset($unser_var[$key]);
			array_values($unser_var);
			break ;
		}
	}
	file_put_contents("./private/items.csv", serialize($unser_var));
}
?>


<html>
	<head>
		<meta charset="UTF-8">
		<title>Control Panel</title>
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
				width: 18%;
				margin-right: 1%;
				font-size: 1.5vw;
			}
			.field_names {
				margin-left: 5%;
				color: white;
				font-size: 1.5vw;
			}
			.img_cell {
				width: 20%;
			}
			.item_img {
				width: 100%;
			}
		</style>
	</head>
	<body>
		<form class ="form" action="control_brd.php" method="POST">
			<p class="headline">Control Panel</p>
			<input class="item_field" name="del_name" value=""/>
			<input class="delete" type="submit" name="del" value="Del item"/>
			<br \>
			<input class="item_field" name="item_name" value=""/>
			<input class="item_field" name="item_class" value=""/>
			<input class="item_field" name="item_loc" value=""/>
			<input class="item_field" name="item_price" value=""/>
			<input class="item_field" name="item_img" value=""/>
			<input class="additem" type="submit" name="additem" value="Add/Modify Item"/>
			<div class="table_header">
				<table>
					<tr>
						<td class="header">Name</td>
						<td class="header">Class</td>
						<td class="header">Location</td>
						<td class="header">Price</td>
						<td class="header">Image</td>
					</tr>
				</table>
			</div>
			<div class="table_container">
				
				<table>

<?php
if ((file_exists("./private/items.csv")) == True)
{
	$unser_var = unserialize(file_get_contents("./private/items.csv"));
	foreach ($unser_var as $key => $value)
	{
		$name = $value['name'];
		$class = $value['class'];
		$loc = $value['loc'];
		$price = $value['price'];
		$img = $value['img'];
					?>
						<tr>
							<td><?php echo $name ?></td>
							<td><?php echo $class ?></td>
							<td><?php echo $loc ?></td>
							<td><?php echo $price ?></td>
							<td class="img_cell"><img class="item_img" src=<?php echo $img ?> title=<?php echo $img ?>></td>
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