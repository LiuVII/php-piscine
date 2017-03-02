#!/usr/bin/php
<?php
if ($argc < 2)
	return ;
$date_raw = strtolower($argv[1]);
date_default_timezone_set('Europe/Paris');
$months = array('janvier'=>'jan','février'=>'feb','mars'=>'march','avril'=>'apr','mai'=>'may','juin'=>'jun','juillet'=>'jul','août'=>'aug','septembre'=>'sep','octobre'=>'oct','novembre'=>'nov','décembre'=>'dec');
$dow = array('dimanche'=>'sunday','lundi'=>'monday','mardi'=>'tuesday','mercredi'=>'wednesday','jeudi'=>'thursday','vendredi'=>'friday','samedi'=>'saturday');
$date_raw = strtr($date_raw, $months);
$date_raw = strtr($date_raw, $dow);
if (!($date = DateTime::createFromFormat('D d M Y H:i:s', $date_raw)))
	echo "Wrong Format\n";
else
	echo date_timestamp_get($date)."\n";	
?>