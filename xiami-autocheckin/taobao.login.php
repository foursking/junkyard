<?php
/**
 * Xiami Auto Checkin bash
 */

$curl = curl_init();
$curl_post = 'TPL_username=lyf021408&TPL_password=lyf200812010121';
//get login cookie
$cookie_file = dirname(__FILE__).'/'.'cookie.txt';
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_URL, "https://login.taobao.com/member/login.jhtml");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post);
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
curl_exec($curl);
curl_close($curl);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://www.taobao.com");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
$data = curl_exec($curl);

//fetch checkin URL
$preg = '/\<div class\=\"menu\-hd\">(.*?)<\/div\>/s';
preg_match_all($preg, $data, $match);

print_r ($match);
curl_close($curl);
