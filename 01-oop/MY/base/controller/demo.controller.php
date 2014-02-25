<?php

require_once __DIR__ .'/unit.php';




$container['slim']->get('/:sex/:name', function ($sex,$name) {
    echo "Hello $sex  $name";
});




$app->run();
