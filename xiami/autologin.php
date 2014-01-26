<?php

$name = 'xiaofeiji021408@163.com'; //输入你的账号
$password = '123456'; //输入你的密码
//获取登陆cookie
$curl_post = 'email='.$name.'&password='.$password.'&done=/&submit=登 录';
$cookie_file = dirname(__FILE__).'/cookie.txt';
$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_URL, "http://www.xiami.com/member/login");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post);
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
curl_exec($curl);
curl_close($curl);
