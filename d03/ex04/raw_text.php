<?php
header("Content-Type: text/plain");
?>
<html>
<head>
	<title>Basics</title>
	<style>
		body { background-color: #FFB6C1; }
		h1 { color: white; font-style: italic; text-align: center; }
		#myimage { background-color: #ECECEC; object-fit: cover;
			width: 350; height: 300; vertical-align: middle; }
		.container { background-color: #ECECEC; width: 715; height: 320; margin: auto; text-align: center; }
		.link { color: #CD00CD;}
		footer { bottom: 20; text-align: right; position: fixed; width:99%; font-style: italic; font-family: monospace}
	</style>
</head>
<body >
	<h1>&#9829; Love and Peace &#9774;</h1> 
	<div class="container">
		<div style="float:left; border-right: solid #FFB6C1;">
			<img id="myimage", 
				src="https://peaceloveworld.com/media/frontpage/small/parachutetopsnewarrivals.jpg"> <br />
			<a class="link" HREF="https://www.peaceloveworld.com">Peace Love World</a>
			
		</div>
		<div style="float:right;">
			<img id="myimage" float="right"
				src="https://upload.wikimedia.org/wikipedia/en/2/2b/PeaceCoffeeLogo.png"> <br />
			<a class="link" HREF="https://www.peacecoffee.com/shop">Coffee</a> <br />
		</div>
	</div>
	<footer>
	  <hr style="border-color: #CD00CD;">
	  &#169; <a href="https://profile.intra.42.fr/users/mfilipch">mfilipch</a> 2017
	</footer>
</body>
</html>