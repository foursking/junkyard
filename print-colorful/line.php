<?php



#printf("test: \033[42m".'aaa'."\033[0m");

for ($i = 0; $i < 10; $i++) {
    $fontFrontColor = mt_rand(40,47);
    $fontBackColor = mt_rand(30,37);
    printf("colorfulLine: \033[{$fontFrontColor}m". $i . "\033[{$fontBackColor}m\033[m\r\n");
}
#printf("\nDone.");

?>
