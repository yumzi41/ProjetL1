<?php
namespace Treatment;
class RegisterTreatment{


public static $tabElements = array("Surname", "Name","Pseudo","Email","Password", "PasswordConfirm");

	
static function register($surname, $name, $pseudo, $email, $password, $passwordConfirm, &$response){

		if(\Auther\Verify::verifPasswordConfirmMatch($password, $passwordConfirm, $response)){
			
			if(\Auther\Verify::verifEmailMatch($email,$response)){
				
				if(\Auther\Verify::verifPasswordMatch($password,$response)){
					
					if(self::verifEmailNotExists($email, $response)){
					
							$passwordHash = password_hash($password, PASSWORD_DEFAULT);
							self::insert($surname, $name, $pseudo, $email, $passwordHash, $response);
							return true;
						
						
						
					}
					
				}
				
			}
			
		}
	}

	static function insert($surname, $name, $pseudo, $email, $password, &$response){

		if(!\Database\Db::getInstance() == null){

			$query = \Database\Db::getInstance()->prepare("INSERT INTO users(surname, name, pseudo, email, password) VALUES(:surname, :name, :pseudo, :email, :password)");

			if($query->execute(array("surname" => $surname,
									"name" => $name,
									"pseudo" => $pseudo,
									"email" => $email,
									"password" => $password))){
			
				$response = \Auther\MotorTemplate::cP("registerResponse", "inscription réussie, pour continuer, connectez vous.");
				$query->closeCursor();
				return true;

			}else{

				$query->closeCursor();
				$response = \Auther\MotorTemplate::cP("registerResponse", "erreur.");
				return false;
			}
		}
		else
		{
			$response = \Auther\MotorTemplate::cP("registerResponse", "erreur.");
			return false;
		}
	}

	

	static function verifEmailNotExists($email, &$response){
		if(!\Database\Db::getInstance() == null){

			$query = \Database\Db::getInstance()->prepare("SELECT * FROM users WHERE email = :email");

			if($query->execute(array("email"=>$email))){

				if(!$query->fetch()==null || !$query->rowCount()==0){

					$query->closeCursor();
					$response = \Auther\MotorTemplate::cP("registerResponse", "désolé cet email existe déjà.");
					return false;

				}else{
					
					$query == null;
					return true;}
			}else{
				$query == null;
				$response = \Auther\MotorTemplate::cP("registerResponse", "erreur.");
				return false;
			}
		

		}else{
			$response = \Auther\MotorTemplate::cP("registerResponse", "erreur.");
			return false;
		}
	}

	static function treatment(&$registerResponse){

		if(\Auther\Verify::verifPostElementsExist("register", self::$tabElements)){
		self::register($_POST["registerSurname"], $_POST["registerName"], $_POST["registerPseudo"], $_POST["registerEmail"], $_POST["registerPassword"], $_POST["registerPasswordConfirm"], $registerResponse);
		}
		else
		{ 
			$registerResponse = \Auther\MotorTemplate::cP("registerResponse", "Veuillez remplir tout les champs.");
		}
	}


	

}  ?>

