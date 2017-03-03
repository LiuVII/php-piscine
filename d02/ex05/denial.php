#!/usr/bin/php
<?php
if ($argc < 3)
	exit (0);
$init_key = $argv[2];
if (!($file = fopen($argv[1], 'r')))
	exit (0);
if (($line = fgetcsv($file, 0, ";")) === FALSE || 
	(($pos = array_search($init_key, $line)) === FALSE))
	exit (0);
$key_arr = $line;
foreach ($line as $key => $value)
{
	$key_arr[$key] = $value;
	$$key_arr[$key] = array();
}
while (($line = fgetcsv($file, 0, ";")) !== FALSE)
{
	foreach ($line as $key => $value)
		${$key_arr[$key]}[$line[$pos]] = $value;
}
fclose($file);
echo "Enter your command: ";
while ($line = fgets(STDIN))
{	
	eval($line);
	echo "Enter your command: ";
}
echo "\n";
?>