<?php

session_start();

require('Auther/Autoloader.php');
$a = new Auther\Autoloader();
$default = false;


if(isset($_SESSION['user_id'])){

	require("SpaceFolder/UserInterface.php");


}else if(!isset($_SESSION['user_id']) && isset($_GET['space'])){

	if(isset($_GET['space'])){

		$space = $_GET['space'];

		if($space == "login"){

			require("SpaceFolder/Login.php");

		}else if($space == "register"){

			require("SpaceFolder/Register.php");
			
		}else
			require('SpaceFolder/Home.php');
	}
}

else if(!isset($_SESSION['user_id']) && !isset($_GET['space'])){

	require('SpaceFolder/Home.php');

}else{

	require('SpaceFolder/Home.php');

}
?>