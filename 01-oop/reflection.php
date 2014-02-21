<?php

namespace OOP;

class Foo {
    public    $foo  = 1;
    protected $bar  = 2;
    private   $baz  = 3;
}


$foo = new Foo();

$reflect = new \ReflectionClass($foo);

$props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);

foreach ($props as $prop) {
    print $prop->getName() . "\n";
}

//print_r($props);

?>
