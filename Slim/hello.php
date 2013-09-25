<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim( array('debug'=>true) );

$settingValue = $app->config('debug');
echo $settingValue;

$app->get('/:sex/:name', function ($sex,$name) {
    echo "Hello $sex  $name";
});

$app->run();


?>
