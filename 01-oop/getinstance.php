<?php

/**
 * 
 */
class Config
{
	
	private static $instance;
	private static $config = array();
	private static $class;

	private function __construct() {

	}

	private static function getInstance() {
		if ( ! isset(self::$instance)) {
			self::$class = __CLASS__;
			self::$instance = new self::$class();
			require_once 'config.php';
			static::$config = $config;
		} else {
		}
	}


	public static function getValue($key) {
		self::getInstance();
		if (isset(self::$config[$key])) {
			return self::$config[$key];
		} else {
			return NULL;
		}
	
	}

}




echo Config::getValue('key2');

