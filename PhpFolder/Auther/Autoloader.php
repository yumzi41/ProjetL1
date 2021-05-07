<?php
namespace Auther;
class Autoloader{

	function __construct(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function autoload($name){
		
		require $name . ".php";

	}
}
?>