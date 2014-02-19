<?php

function color_a(&$string) {
$cmd="echo -ne \"\033[31m".$string." \033[0m\n\"";
$a=exec($cmd);
print "$a"."\n";
print 1111;
}

function color_b(&$string) {
$cmd="printf \"\033[01;40;32m".$string."\033[0m\n\"";
$a=exec($cmd);
print "$a"."\n";
}

$string="aaaa";
color_a($string);

#color_b($string);
