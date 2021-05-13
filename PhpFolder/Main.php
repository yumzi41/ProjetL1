<?php

/* Main.php est la page constamment chargé lors de chaque requête, elle gérera l'affichage de la page selon les paramêtres passés en GET, j'ai essayé de faire Main.php le  plus lisible possible grâce aux require. */

session_start();

require('Auther/Autoloader.php');
$a = new Auther\Autoloader();

/* Autoloader permet de charger les class automatiquement, elle traite aussi la notion de namespace. */

$default = true; 

/* La variable $default est une variable qui premettra de dire si oui ou non il faudra effectuer une récupération dans le cache pour effectuer une affichage. */

if(isset($_SESSION['user_id'])){

	if(isset($_GET["space"]) && $_GET["space"]=="disconnect"){

			require("SpaceFolder/Disconnect.php");
		
	}else{

		require("SpaceFolder/UserInterface.php");
	}
		

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
else{

	require('SpaceFolder/Home.php');

}
?>