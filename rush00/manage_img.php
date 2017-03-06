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

function putimage($link, $name)
{

	$url = $link;
	if (preg_match("/(http|https):\/\//i", $url) == 0)
	{
		if ($url[0] != "/")
			$url = "/".$url;
	}
	$image = get_url_data($url);
	$img_fmt = end(explode('.', end(explode('/', $url))));
	$img = str_replace(" ", "_", "./img/".$name.".".$img_fmt);
	file_put_contents($img, $image);
	return $img;
}

?>