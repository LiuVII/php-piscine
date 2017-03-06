<?php
include("auth.php");

session_start();
if (($login = $_POST['login']) && ($passwd = $_POST['passwd'])
	&& ($user_class = auth($login, $passwd)) !== FALSE)
{
	$_SESSION['logged_on_user'] = $login;
	$_SESSION['user_class'] = $user_class;
	// Get order from cart
	$cart_var = unserialize(file_get_contents("./private/cart.csv"));
	$cart_order = "";
	foreach ($cart_var as $key => $value)
	{
		if ($value['login'] == "guest")
		{
			$cart_order = $value['order'];
			$cart_var[$key]['order'] = "";
			break ;
		}
	}
	if ($cart_order != "")
	{
		foreach ($cart_var as $key => $value)
		{
			if ($login == $value['login'])
			{
				$cart_var[$key]['order'] = $cart_order;
				break ;
			}
		}
	}
	file_put_contents("./private/cart.csv", serialize($cart_var));
	$_SESSION['guest'] = FALSE;
	header("Location: index.php");
	echo "OK\n";
}
else
{
	$_SESSION['logged_on_user'] = "";
	$_SESSION['user_class'] = "";
	header("Location: login.html");
	echo "ERROR\n";
}
?>


