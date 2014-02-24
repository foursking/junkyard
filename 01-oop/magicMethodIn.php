<?php

/*
 *
 * __toString:
 * __invoke
 */
class Animal
{
	public function __construct() {
		$this->time = time();
	}
}

class Penguin extends Animal	
{
}

class testToString
{
	public $foo;
	public function __construct($foo) {
		$this->foo = $foo;
	}

	public function __toString() {
		return $this->foo;
	}
}


class testInvoke
{
	function __invoke($x){
		var_dump($x);
	}

	public function a() {
		//code here
	}
}

$obj = new testInvoke();


//重载


class MethodTest
{
	public function __call($name , $arguments) {
		echo "Calling object method '$name' " . implode(',' , $arguments) . "\n";
	
	
	}
}


class testMagicCallMehod
{
	public function __call($method , $args) {
		echo __METHOD__;
		if (is_callable(array($this , $method))) {
		//if(method_exists($this , $method)){
			$this->method();
		} else {
			echo "no method";
		}
		
	}

	public function foo() {
		echo __METHOD__;
		if (method_exists($this, "baz")) {
			echo '111';
		}
	}

	private function bar() {
		echo __METHOD__;
	}

	protected function baz() {
		echo __METHOD__;
	}

}

$test = new testMagicCallMehod();

#$test->bar();

$test->baz();

#var_dump(is_callable(array($test , 'baz')));

