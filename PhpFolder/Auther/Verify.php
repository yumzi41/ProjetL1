<?php

// Verify permet de vérifier certaines données entrées par l'utilisateur grâce aux Regx mais aussi détecter l'envoie de formulaire et de vérifier si une session est en cours //

namespace Auther;
class Verify{

	// fonction qui détectera l'envoie de certains élements $_POST prenant en paramêtre une racine et un tableau de string  //

	 static function verifPostElementsExist(String $root, array $tabElements){
		foreach($tabElements as $e){
			if(!isset($_POST[$root . $e])){

				return false;
			}
		}
		return true;
	}

	static function verifSessionElementsExist(array $tabElements){
		foreach($tabElements as $e){
			if(!isset($_SESSION[$e])){

				return false;
			}
		}
		
		return true;
	}

	static function verifPasswordConfirmMatch($password, $passwordConfirm, &$response){
		if($password===$passwordConfirm){
			return true;
		}else{
			$response = MotorTemplate::cP($response, "désolé, vos mots de passe de correspondent pas.");
			return false;

		}
		

	}

	static function verifPasswordMatch($password, &$response){
	 	$password = str_replace(" ", "", $password);
		if(strlen($password)>=8){
			if(preg_match("#(?=.*[A-Z])#", $password)){
				return true;

			}else
			$response = MotorTemplate::cP("response", "Votre mdp doit contenir une majuscule.");
			return false;
			
		}
		else
			$response = MotorTemplate::cP("response", "Votre mdp doit avoir minimum 8 caractères.");
			return false;

	}

	 static function verifEmailMatch($email, &$response){
		if(preg_match("#(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)#", $email)){
			return true;
		}else
		{
			$response = MotorTemplate::cP("response", "erreur syntaxe email.");
			return false;
		}
	}

	// une fonction qui renverra à l'acceuil du site si aucune session n'est détéctée //

	static function verifSessionExists(){
		if(!isset($_SESSION["user_id"])){
			header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
			die();
		}
	}

	static function verifUpdateMode(){
		if(isset($_GET["update"])){
			if($_GET["update"]=="true"){
				return false;
			}
		}else
		return true;
	}
}  

?>