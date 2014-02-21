<?php

namespace TE\Mvc;

abstract class Base
{

	//已经注入的对象池
	private static $_injectedObjectsPool = array();

	//挂起的注入对象栈
	private static $_holdingObjectsStack = array();

	//注入的对象
	private static $_injectiveObjects = array();

	//已经注入的属性
	private $_injectedProperties = array();



	public function __construct() {

		//使用链式注入初始化对象
		$this->initChainedClass();

		// 将init作为实际初始化方法 保留__construct 方法
		if (method_exists($this , 'init')) {
			$args = func_get_args();
			call_user_func_array(array($this,'init') , $args);
		}
	}



	private function getAvailableProperties(\ReflectionClass $class) {
		$props = $class->getProperties();
		$result = array();
		foreach ($props as $prop) {
			$name = $prop->getName();
			if($prop->isDefault() && 0 !== strpos($name , '_')
				&& ( ! isset($this->_injectedProperties[$name]) || $prop->isPrivate())) {
					$result[$name] = $prop;
					$this->_injectedProperties[$name] = true;
				}
		}
		return $result;
	}


	private function initChainedClass() {

		$class = new \ReflectionClass();
		$shared = self::$_injectiveObjects;

		do{

			$this->injectProperties($class , $shared);
			$class = $chass->getParentClass();

		}while(!empty($class) && 'TE\Mvc\Base' != $class->getName());



	}

	//根据给出的类获取可以注入的属性列表

	private function injectProperties(\ReflectionClass $class , array $shared) {

		$props = $this->getAvailableProperties($class);
	
		foreach ($props as $prop) {
			if (isset($shared[$name])) {
				//首先检查交叉依赖
				
				if (in_array($name, self::$_holdingObjectsStack)) {
					throw new \Exception ('cross dependencies found in'. $name);
				}

				//写入对象池

				if ( ! isset(self::$_injectedObjectsPool[$name])) {
				
					self::$_holdingObjectsStack[] = $name;
					self::$_injectedObjectsPool[$name] = $this->createInstance($shared[$name]);
					self::$_holdingObjectsStack = array_slice(self::$_holdingObjectsStack , 0 , -1);
				}

				$prop->setAccessible(true);
				$prop->setValue($this , self::$_injectedObjectsPool[$name]);


			}
			
		}
	
	
	}


	private function createInstance()
	{
		if (is_array($define)) {
			$class = $define[0];
			$args = isset($define[1]) ? (is_array($define[1]) ? $define[1] : array($define[1])) : array();
			$reflect = new \ReflectionClass($className);
			return $reflect->newInstanceArgs($args);
		} else if (is_string($define)) {
		
			return new $define();
		
		} else if (is_callable($define)) {
		
			return $define($this);
		}
		return false;
	}
}


