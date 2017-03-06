<?php
	include("install.php");
	session_start();
	$user = $_SESSION["logged_on_user"];
	$guest = $_SESSION["guest"];
	if (!$user && !$guest)
	{
		echo "Not a guest";
		$_SESSION["guest"] == 1;
		$cart_var = unserialize(file_get_contents("./private/cart.csv"));
		$cart_order = "";
		foreach ($cart_var as $key => $value)
		{
			if ($value['login'] == "guest")
			{
				unset($cart_var[$key]);
				break ;
			}
		}
		$cart_var[] = array('login' => 'guest', 'order' => array());
		file_put_contents("./private/cart.csv", serialize($cart_var));
	}
	else if ($user)
		$_SESSION["guest"] == 0;
	$user_class = $_SESSION['user_class'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Universe shop</title>
		<link rel="stylesheet" href="menu.css">
		<style type="text/css">
			body {
				/*background-color: rgb(34, 49, 63);*/
			}

			header {
				width: 100%;
			}
			.search_bar {
				float: left;
				width: 20%;
			}
			.search_btn {
				float: left;
				width: 10%;
				font-size: 1.5vw;
			}
			.login_form {

			}
			.login {
				float: left;
				margin-left: 40%;
				font-size: 2vw;
				text-decoration: none;
			}
			.user {
				font-size: 2vw;
				text-decoration: none;
			}
			.signup {
				float: left;
				margin-left: 3%;
				font-size: 2vw;
				text-decoration: none;
			}
			.logout {
				float: left;
				margin-left: 3%;
				font-size: 2vw;
				text-decoration: none;
			}
			.cart {
				float: left;
				margin-left: 3%;
				font-size: 2vw;
				text-decoration: none;
			}

			.items_num {
				float: left;
				margin-left: 2%;
				font-size: 2vw;
				text-decoration: none;
			}
			nav {
				position: relative;
			}

			.iheader {
				width: 100%;
				height: 5vw;
			}

			.inav {
				width: 100%;
				height: 5vw;
			}

			.isection {
				width: 100%;
				height: 80vw;
			}
			

			footer {
				margin-top: 1%;
				bottom: 1%;
				text-align: right;
				position: relative;
				width:99%;					
			}
			.hr {
				color: #000;
			}
			.creds {
				font-size: 2vw;
				font-style: italic;
			}
			.menu_link {
				text-decoration: none;
			}
			.menu_link:hover .menu_link {
				background-color: #fbfbfb;
			}
		</style>
	</head>
	<body>
		<header>
			<input class="search_bar" type="text" name="search_req" value=""/>
			<input class="search_btn" type="submit" name="search_btn" value="Search"/>
			<?php			
				if ($user != "")
				{
					?>
					<div class="dropdown" style="float: left; margin-left: 35%;">
						
						<a class="user" href="#" title="User Panel">User: <?PHP echo $user; ?><a/>
						<div class="dropdown-content">
							<a class="menu_link" href="modif.html">Change Password</a>
							<br />
							<?php
								if ($user_class == "emperor")
								{
									?>
										<a class="menu_link" href="space_users.php" title="View Orders">Space Users</a>
										<br />
										<a class="menu_link" href="control_brd.php" title="User Panel">Control Panel</a>
									<?php	
								}
							?>
						</div>
					</div>
					<a class="logout" href="logout.php" title="Log out">Logout</a>
					<?php 
				}
				else
				{
					?>
						<a class="login" href="login.html" name="login">Log in<a/>
						<a class="signup" href="sign_up.html" name="signup">Sign up<a/>
					<?php
				}
			?>
			<a class="cart" href="cart.php" name="cart">Cart<a/>
			<div class="items_num"> <?PHP echo "0"; ?> </div>
		</header>
		<!-- <nav>
			<iframe class ="iheader" src="nav.html"></iframe>
		</nav> -->
		<section>
			<iframe class="isection" src="stars.html"></iframe>
		</section>
		<footer>
			<hr>
			<p class="creds">
				&#169;
				<a href="https://profile.intra.42.fr/users/mfilipch">mfilipch</a> 
				<a href="https://profile.intra.42.fr/users/bslakey">bslakey</a> 
				2017
			</p>
		</footer>
	</body>
</html>