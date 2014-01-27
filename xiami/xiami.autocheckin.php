<?php
/**
 * Xiami Auto Checkin bash
 */

function xiamiAutoLogin($userInfo) {
	foreach ($userInfo as $user) {
		$curl = curl_init();
		$curl_post = 'email='.$user['email'].'&password='.$user['password'].'&done=/&submit=登 录';
		//get login cookie
		$cookie_file = dirname(__FILE__).'/'.$user['email'].'cookie.txt';
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_URL, "http://www.xiami.com/member/login");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
		curl_exec($curl);
		curl_close($curl);
	}
}


function xiamiAutoCheckin($userInfo) {

	foreach ($userInfo as $user) {
		//get login cookie
		$cookie_file = dirname(__FILE__).'/'.$user['email'].'cookie.txt';
		//xiami web
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://www.xiami.com/web");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
		$data = curl_exec($curl);
		curl_close($curl);

		//fetch checkin URL
		$preg = '/\<a class\=\"check\_in\" href\=\"(.*?)\"\>每日签到\<\/a\>/s';
		preg_match_all($preg, $data, $match);
		if(!isset($match[1][0])) {
			$preg = '/\<div class\=\"idh\"\>(已连续签到.*?天)\<\/div\>/s';
			preg_match_all($preg, $data, $match);
			file_put_contents(dirname(__FILE__).'/'.'xiamiAutoCheckin.log' , date("Y-m-d H:i:s").$user['email'].$match[1][0]." \n" , FILE_APPEND);
			continue;
		}

		//auto checkin
		$url = 'http://www.xiami.com' . $match[1][0];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_REFERER, 'http://www.xiami.com/web');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$checkin = curl_exec($curl);
		curl_close($curl);

	}

}

$userInfo = array(
	1 => array(
		'email'=>'you@email.com',
		'password'=>'youpassword',
	),

);

// run the function
xiamiAutoLogin($userInfo);
xiamiAutoCheckin($userInfo);
