<?php
namespace Treatment;
class LoginTreatment{



	public static $tabElements = array("Email","Password");

	static function login($email, $password, &$response){

		$query = \Database\Db::getInstance()->prepare("SELECT * FROM users AS u LEFT JOIN imgProfil AS i ON 
			(u.user_id = i.fk_user_id) WHERE email=:email");

		if($query->execute(array("email"=>$email))){
			
			$row = $query->fetch();
			if(!$row==null){
		
				if(password_verify($password, $row["password"])){
					$_SESSION["user_id"] = $row["user_id"];
					$_SESSION["surname"] = $row["surname"];
					$_SESSION["name"] = $row["name"];
					$_SESSION["pseudo"] = $row["pseudo"];
					$_SESSION["biographie"] = $row["biographie"];

					if($row["url"] == null || $row["url"] == "" || $row["url"] == "NULL" || $row["url"] == "null"){

						$_SESSION["img_profil_url"] = "../Img/avatar.png";
						
					}else
					{
						$_SESSION["img_profil_url"] = $row["url"];
					}

					

					$query->closeCursor();
					$response = \Auther\MotorTemplate::cP("loginResponse", "Connexion réussie.");
					return true;
				}
			}
		}
		$query->closeCursor();
		$response = \Auther\MotorTemplate::cP("loginResponse", "Informations incorrectes.");
		return false;
	}

	static function treatment(&$response){

		if(\Auther\Verify::verifPostElementsExist("login", self::$tabElements)){

			$callBack = self::login($_POST["loginEmail"], $_POST["loginPassword"], $response);
				
				if(!is_null($callBack)){

					header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
					die();
					
				}
			
		}else
		$response = \Auther\MotorTemplate::cP("loginResponse", "Veuillez remplir tout les champs.");
	}
}  
?>