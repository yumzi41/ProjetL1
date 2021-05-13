<?php
namespace Treatment;
class LoginTreatment{



	public static $tabElements = array("Email","Password");

	static function login($email, $password, &$response){

		$query = \Database\Db::getInstance()->prepare("SELECT * FROM users 
		 WHERE email=:email");

		if($query->execute(array("email"=>$email))){
			
			$row = $query->fetch();
			if(!$row==null){
		
				if(password_verify($password, $row["password"])){
					$_SESSION["user_id"] = $row["user_id"];
					$_SESSION["surname"] = $row["surname"];
					$_SESSION["name"] = $row["name"];
					$_SESSION["pseudo"] = $row["pseudo"];
					$_SESSION["biographie"] = $row["biographie"];

					if($row["url_img_profil"] == null || $row["url_img_profil"] == "" || $row["url_img_profil"] == "NULL" || $row["url_img_profil"] == "null" || !file_exists($row["url_img_profil"])){

						$_SESSION["url_img_profil"] = "../Img/avatar.png";
						
					}else
					{
						$_SESSION["url_img_profil"] = $row["url_img_profil"];
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
				
				if($callBack){

					header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
					die();
					
				}
			
		}else
		$response = \Auther\MotorTemplate::cP("loginResponse", "Veuillez remplir tout les champs.");
	}
}  
?>