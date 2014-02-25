<?php

namespace sapphire\base;
use \PDO;
use sapphire\base\mvc\SlimWrapper;


class Initializer{

	static $container;
	public static function initConf() {
		include_once __DIR__.'/Pimple.php';
		self::$container = new \Pimple();
		return self::$container;
	}



	public static function initBase($container) {
		//initializer DB use ORM
		$container['db'] = $container->share(function() {
			try {
				$dbh = new PDO("mysql:host=localhost;dbname=test",
					'root', '123456',
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';"));
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $dbh;

			} catch (\PDOException $e) {
				echo 'false';

			}
		});



		//initializer slim
		$container['slim'] = $container->share(function() {
			return new SlimWrapper(array(
				//config here
			    'mode' => 'development',
                'debug' => true,		
			));
		});

		$container['cache'] = '';
		return $container;

	}


}


