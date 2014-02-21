<?php

/* $iplist= array( '10', '124', '205', '48',); */


/* foreach ($iplist as &$i) { */
/* 	echo "$i\n"; */
/* 	echo "192.168.1.{$i}\n"; */
/* 	echo "$i\n"; */
/* } */


/* foreach ($iplist as $j) { */

/* } */


$url = "http://www.weather.com.cn/forecast/index.shtml";

$ch = curl_init();
curl_setopt($ch , CURLOPT_URL , $url);
curl_setopt($ch , CURLOPT_HEADER , false);
curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1);
$result = curl_exec($ch);
curl_close($ch);

#echo $result;

$str = <<<EOD
<select id="prov"><option selected="selected" value="10101">北京</option><option value="10102">上海</option><option value="10103">天津</option><option value="10104">重庆</option><option value="10105">黑龙江</option><option value="10106">吉林</option><option value="10107">辽宁</option><option value="10108">内蒙古</option><option value="10109">河北</option><option value="10110">山西</option><option value="10111">陕西</option><option value="10112">山东</option><option value="10113">新疆</option><option value="10114">西藏</option><option value="10115">青海</option><option value="10116">甘肃</option><option value="10117">宁夏</option><option value="10118">河南</option><option value="10119">江苏</option><option value="10120">湖北</option><option value="10121">浙江</option><option value="10122">安徽</option><option value="10123">福建</option><option value="10124">江西</option><option value="10125">湖南</option><option value="10126">贵州</option><option value="10127">四川</option><option value="10128">广东</option><option value="10129">云南</option><option value="10130">广西</option><option value="10131">海南</option><option value="10132">香港</option><option value="10133">澳门</option><option value="10134">台湾</option></select>
EOD;



$pattern = "~\d{5}~";


$pattern2 = "~[\x{4e00}-\x{9fa5}]+~u";


preg_match_all($pattern, $str, $matches);
preg_match_all($pattern2, $str, $matches2);

var_dump($matches2);


$matches3 = array_combine(array_values($matches) , array_values($matches2));
print_r($matches3);
