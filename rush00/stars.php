<?php
session_start();
if ($_POST['galaxy'] == "OK" || $_POST['nebula'] == "OK" || $_POST['others'] == "OK" || $_POST['all'] == "OK")
{
	if ($_POST['galaxy'] == "OK")
		$display_items[] = "Galaxy";
	if ($_POST['nebula'] == "OK")
		$display_items[] = "Nebula";
	if ($_POST['others'] == "OK") {
		$display_items[] = "Galaxy-Group";
		$display_items[] = "Star-Cluster";
	}
	if ($_POST['all'] == "OK") {
		$display_items[] = "Galaxy-Group";
		$display_items[] = "Star-Cluster";
		$display_items[] = "Nebula";
		$display_items[] = "Galaxy";
	}
}
else
	$display_items = array("Galaxy-Group", "Star-Cluster","Nebula","Galaxy");
?>
<html>
	<style>
	body {
		background-color: rgba(0, 0, 0, 10);
		background-image: url("https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&ved=0ahUKEwjWzI3Ro8HSAhVN1WMKHcxDDt0QjRwIBw&url=http%3A%2F%2Fvoices.nationalgeographic.com%2F2013%2F01%2F24%2Fdung-beetles-navigate-via-the-milky-way-an-animal-kingdom-first%2F&psig=AFQjCNExPMJF_PUbe8J6lb5va62hpWNl5A&ust=1488869068260647");
	}
	.item_name {
		color: white;
		text-align: center;
	}
	.item_price {
		color: white;
		text-align: center;
	}
	.item_img {
		margin-left: 10%;
		height: 10vw;
		width: 80%;
	}
	.add_to_cart {
		width: 20%;
		margin-left: 40%;
	}
	.display_checks {
		color: white;
		text-align: center;
	}
	table {
		width: 100%;
	}
	td {
		background: #000;
		width: 20%;
		height: 15vw;
	}
	</style>
<body>
<form class ="form" action="stars.php" method="POST">
	<div class="table_container">
	<form class="form" action="stars.php" method="POST">
	<input type="checkbox" name="galaxy" value="OK"><font class="display_checks">Display Galaxies</font>
	<input type="checkbox" name="nebula" value="OK"><font class="display_checks">Display Nebulas</font>
	<input type="checkbox" name="others" value="OK"><font class="display_checks">Display Other Types</font>
	<input type="checkbox" name="all" value="OK"><font class="display_checks">Display ALL</font>
	<input type="submit" name="submit" value="Submit">
	</form>
		<table><tr>
<?php
$item_num = 0;
	if ((file_exists("./private/items.csv")) == True)
	{
		$unser_var = unserialize(file_get_contents("./private/items.csv"));
		foreach ($unser_var as $key => $value)
		{
			if (!isset($display_items) || !\in_array($value['class'], $display_items))
				continue ;
			$item_num++;
			$name = $value['name'];
			$class = $value['class'];
			$price = $value['price'];
			$img = $value['img'];
	?>
	<?PHP
			if ($item_num % 4 == 0)
			{
			?>
				</tr><tr>
			<?PHP
			}
			?>
			<td class="item">
				<p class = "item_name"><b><?PHP echo $name ?></b></p>
				<div class="item_img">
					<img class=item_img src=<?PHP echo $img ?>>
				</div>
				<p class = "item_price"><b><?PHP echo $price ?> Cr</b></p>
				<form action="stars.php" method="POST">
				<button class="add_to_cart" type="submit" name="add_to_cart" value="<?php echo $name; ?>" title="Add to Cart"/>Add</button></form>
			</td>
	<?php
		}
	}
	?>
			</tr>
		</table>
	</div>
</body>
</html>
<?php

$res = $_POST['add_to_cart'];
if ($res !=  "")
{
	$login = $_SESSION['logged_on_user'];
	if (!$login)
		$login = "guest";
	
	// $new_order = $_POST
	$new_order = $res;
	
	// find info in items
	$items_var = unserialize(file_get_contents("./private/items.csv"));
	$price = 0;
	$img = "";
	foreach ($items_var as $key => $value)
	{
		if ($value['name'] == $new_order)
		{
			$share = 0.05;
			$price = $value['price'] * $share;
			$img = $value['img'];
			break ;
		}
	}
	$curr_order = array('name' => $new_order, 'price' => $price, 'share' => $share, 'img' => $img);
	
	// Get order from cart	
	$cart_var = unserialize(file_get_contents("./private/cart.csv"));
	$match = 0;
	foreach ($cart_var as $key => $value)
	{
		if ($login == $value['login'])
		{
			$cart_order = $value['order'];
			$ord_match = 0;
			foreach ($cart_order as $ord_key => $ord_value)
			{
				if ($ord_value['name'] == $new_order)
				{
					if ($ord_value['share'] < 1)
					{
						$cart_var[$key]['order'][$ord_key]['price'] += $price;
						$cart_var[$key]['order'][$ord_key]['share'] += $share;
					}
					$ord_match = 1;
					break ;
				}
			}
			if ($ord_match == 0)
				$cart_var[$key]['order'][] = $curr_order;
			$match = 1;
			break ;
		}
	}
	if ($match == 0)
	{
		$cart_var[] = array('login' => $login, 'order' => array($curr_order));
	}
	file_put_contents("./private/cart.csv", serialize($cart_var));
	// header("Location: stars.html");
}
?>
