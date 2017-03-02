#!/usr/bin/php
<?php
function get_url_data($url)
{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
}

if ($argc < 2)
	exit (0);
// needs error handling of invalid url
$html = get_url_data($argv[1]);
file_put_contents("newfile.html", $html);
$dir = preg_replace("(http|https):\/\/", '', $argv[1]);
$dir = explode('/', $dir)[0];
// echo $dir."\n";
// mkdir($dir);
// preg_match_all('/<img.*?src="(.*?)"/', $html, $img_arr);
// foreach ($img_arr as $key => $url)
// {
// 	$image = get_url_data($url);
// 	$img_name = end(explode('/', $url));
// 	file_put_contents("./".$dir."/".$img_name, $image);
// }
?>