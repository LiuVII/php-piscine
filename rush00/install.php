<?php
// DB directory
if (!file_exists("./private"))
{
	mkdir("./private");
}
// Users
if (!file_exists("./private/users.csv"))
{
	file_put_contents("./private/users.csv", serialize(array()));
}
// Orders of users
if (!file_exists("./private/orderdb.csv"))
{
	file_put_contents("./private/orderdb.csv", serialize(array()));
}
// Curent users carts
if (!file_exists("./private/cart.csv"))
{
	file_put_contents("./private/cart.csv", serialize(array()));
}
// Itemsdb
if (!file_exists("./private/items.csv"))
{
	file_put_contents("./private/items.csv", serialize(array()));
}
?>