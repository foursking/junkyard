<?php

$cookie_file = dirname(__FILE__).'/cookie.txt';
//获取手机版首页
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://www.xiami.com/web");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
$data = curl_exec($curl);
curl_close($curl);

//获取签到URL,如果已经签到则获取签到天数
$preg = '/\<a class\=\"check\_in\" href\=\"(.*?)\"\>每日签到\<\/a\>/s';
preg_match_all($preg, $data, $match);
if(!isset($match[1][0])) {
	$preg = '/\<div class\=\"idh\"\>(已连续签到.*?天)\<\/div\>/s';
	preg_match_all($preg, $data, $match);
	die($match[1][0]);
}


//自动签到
$url = 'http://www.xiami.com' . $match[1][0];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_REFERER, 'http://www.xiami.com/web');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$num = curl_exec($curl);
curl_close($curl);
