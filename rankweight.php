<?php
$w = array('a' =>1, 'b'=>10, 'c'=>14, 'e'=>20, 'f'=>30, 'h'=>6, 'g'=>70);

$ret = array();
$n = 1000;
for($i=0;$i<$n;$i++)
{
    $v = roll($w);
    $ret[$v] = isset($ret[$v]) ? $ret[$v] + 1 :1;
}
print_r($ret);
foreach($ret as $k=>$v) {
     printf("real: %f\t", ($v / $n));
     printf("set: %f\n",($w[$k] / array_sum($w)));
}

function roll($weight) {
    $sum = array_sum($weight);
    $j = 0;
    foreach($weight as $k=>$v) {
        $j = mt_rand(1,$sum);
        if($j <= $v) {
            return $k;
        }else{
            $sum -= $v;
        }
    }
}
