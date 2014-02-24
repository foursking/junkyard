<?php

$arr = array(1,10,5,7);


for ($i = 0; $i < 4; $i++) {

	for ($k = 0; $k < (4-$i); $k++) {

		if($arr[$k] > $arr[$k+1]){
			$tmp = $arr[$k+1];
			$arr[$k+1] = $arr[$k];
			$arr[$k] = $tmp;
		}
	}
}

print_r($arr);
