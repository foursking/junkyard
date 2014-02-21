<?php

//autoload composer
require_once __DIR__ .'/vendor/autoload.php';

//slim
require_once __DIR__.'/SlimWrapper.php';

//require initializer
require_once __DIR__.'/Initializer.php';


use sapphire\base\Initializer;

$container = Initializer::initConf();
$container = Initializer::initBase($container);


$container['slim']->run();





