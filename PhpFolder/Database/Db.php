<?php

// Classe concernant la base de donnée //

namespace Database;
class Db{

	private static $instanceDb;
	private static $defaultDbName = "ProjetL1";
	private static $defaultserver = "localhost";
	private static $defaultUserPass = "root";
	private static $defaultPassword = "";

	
	// initialisation de la base de donnée, j'ai utilisé l'objet PDO car plus facile d'utilisation //

	static function initDb($dbName, $server,$userPass, $password){
		self::$instanceDb=null;
		if(self::$instanceDb==null){
			try{
				self::$instanceDb = new \PDO("mysql:dbname={$dbName};host={$server}",
			 	$userPass, 
			 	$password, array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));

			}catch( Exception $e){};
			
		}
	}
	// on récupère ici un singleton de la connexion à la base de donné pour optimiser la mémoire utilisée //

	static function getInstance(){
		if(!self::$instanceDb==null){
			return self::$instanceDb;
		}else
		 self::initDb(self::$defaultDbName, 
		 	self::$defaultserver,  
		 	self::$defaultUserPass,
		 self::$defaultPassword,);

		 return self::$instanceDb;
		}

	static function closeDb(){
		self::$instanceDb=null;
	}
}
?>