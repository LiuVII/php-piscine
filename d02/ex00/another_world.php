#!/usr/bin/php
<?php
function isempty($str)
{
	if ($str == "")
		return 0;
	return 1;
}

if ($argc > 1)
	echo join(" ", array_filter(explode(" ", str_replace("\t", " ", $argv[1])),"isempty"))."\n";
?>