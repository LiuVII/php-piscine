#!/usr/bin/php
<?php
if ($argc > 1)
	echo join(" ", array_filter(explode(" ", str_replace("\t", " ", $argv[1]))))."\n";
?>