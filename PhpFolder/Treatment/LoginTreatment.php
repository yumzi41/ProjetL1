<?php
namespace Treatment;
class LoginTreatment{



	public static $tabElements = array("Email","Password");

	static function login($email, $password, &$response){

		$query = \Database\Db::getInstance()->prepare("SELECT * FROM users WHERE email=:email");

		if($query->execute(array("email"=>$email))){
			
			$row = $query->fetch();
			if(!$row==null){
		
				if(password_verify($password, $row["password"])){
					$callBackUserid = $row["user_id"];
					$query->closeCursor();
					$response = \Auther\MotorTemplate::cP("loginResponse", "Connexion réussie.");

					return $callBackUserid;
				}
			}
		}
		$query->closeCursor();
		$response = \Auther\MotorTemplate::cP("loginResponse", "Informations incorrectes.");
		return null;
	}

	static function treatment(&$response){

		if(\Auther\Verify::verifPostElementsExist("login", self::$tabElements)){

			$callBackUserId = self::login($_POST["loginEmail"], $_POST["loginPassword"], $response);
				
				if(!is_null($callBackUserId)){

					$_SESSION['user_id'] = $callBackUserId;

					header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
					die();
					
				}
				

		}else
		$response = \Auther\MotorTemplate::cP("loginResponse", "Veuillez remplir tout les champs.");
	}
}  
?>