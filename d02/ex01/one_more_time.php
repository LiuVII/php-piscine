#!/usr/bin/php
<?php
if ($argc < 2)
	return ;
date_default_timezone_set('Europe/Paris');
$months = array('janvier'=>'Jan','février'=>'Feb','mars'=>'Mar','avril'=>'Apr','mai'=>'May','juin'=>'Jun','juillet'=>'Jul','août'=>'Aug','septembre'=>'Sep','octobre'=>'Oct','novembre'=>'Nov','décembre'=>'Dec', 'Janvier'=>'Jan','Février'=>'Feb','Mars'=>'Mar','Avril'=>'Apr','Mai'=>'May','Juin'=>'Jun','Juillet'=>'Jul','Août'=>'Aug','Septembre'=>'Sep','Octobre'=>'Oct','Novembre'=>'Nov','Décembre'=>'Dec');
$dow = array('dimanche'=>'Sun','lundi'=>'Mon','mardi'=>'Tue','mercredi'=>'Wed','jeudi'=>'Thu','vendredi'=>'Fri','samedi'=>'Sat','Dimanche'=>'Sun','Lundi'=>'Mon','Mardi'=>'Tue','Mercredi'=>'Wed','Jeudi'=>'Thu','Vendredi'=>'Fri','Samedi'=>'Sat');
if (strtr($argv[1], $dow) === $argv[1] || strtr($argv[1], $months) === $argv[1])
	echo "Wrong Format\n";
else
{
	$date_raw = strtr($argv[1], $months);
	$date_raw = strtr($date_raw, $dow);
	if (!($date = DateTime::createFromFormat('D d M Y H:i:s', $date_raw)))
		echo "Wrong Format\n";
	else
	{
		if (explode(" ", $date_raw)[1] == date('d', date_timestamp_get($date)))
			echo date_timestamp_get($date)."\n";
		else
			echo "Wrong Format\n";
	}
}
?>