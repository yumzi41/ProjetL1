<?php
namespace Treatment;
class ProfilTreatment{

	static $tabElements = array("Surname", "Name", "Pseudo", "Biographie");

	static $extensionsValid = array("png", "jpeg", "jpg");

	static function verifImgFile($imgFile, &$response){

		$pathImgFile = "empty";
		
		if($imgFile["name"] == "" || $imgFile["name"] == null){

			return $pathImgFile;
		}

		if($imgFile["size"]<=1000000){

			$fileInfos = pathinfo($imgFile["name"]);

			if(in_array(strtolower($fileInfos["extension"]), self::$extensionsValid)){

				$pathImgFile = "../ImgProfil/" . md5(date('l jS \of F Y h:i:s A')) . $_SESSION["user_id"] .".". $fileInfos["extension"];

				move_uploaded_file($imgFile['tmp_name'], $pathImgFile);

				return $pathImgFile;

			}else{

				$response = \Auther\MotorTemplate::cP("editProfilResponse", "Fichier invalide.");
				return null;
			}
			
		}else{
			$response = \Auther\MotorTemplate::cP("editProfilResponse", "Fichier trop volumineux.");
			return null;
		}
	}

	static function updateProfil($surname, $name, $pseudo, $biographie, $pathImgFile, &$response){

		if($pathImgFile == "empty"){

			$order1 = "UPDATE users SET pseudo = :pseudo, surname = :surname, name = :name, biographie = :biographie WHERE user_id = :user_id";

			$query1 = \Database\Db::getInstance()->prepare($order1);

			$query1->execute(array(
				"pseudo" => $pseudo,
				"surname"=> $surname,
				"name"=> $name,
				"biographie"=> $biographie,
				"user_id"=> $_SESSION["user_id"]
				));

			if($query1){
				
				$query1->closeCursor();
				return true;
			}

				else{
					$response = \Auther\MotorTemplate::cP("editProfilResponse", "Erreur lors du traitement.");
					$query1->closeCursor();
					return false;
				}

		}else{

		 	$order1 = "UPDATE users SET pseudo = :pseudo, surname = :surname, name = :name, biographie = :biographie, url_img_profil = :url_img_profil WHERE user_id = :user_id";

		 	$order2 = "INSERT INTO imgProfil(url, fk_user_id) VALUES(:url, :fk_user_id)";

		 	$query1 = \Database\Db::getInstance()->prepare($order1);

			$query2 = \Database\Db::getInstance()->prepare($order2);

			$query1->execute(array(
				"pseudo" => $pseudo,
				"surname"=> $surname,
				"name"=> $name,
				"biographie"=> $biographie,
				"url_img_profil"=> $pathImgFile,
				"user_id"=>$_SESSION["user_id"]
				));

			$query2->execute(array(
					"url"=>$pathImgFile,
					"fk_user_id"=>$_SESSION["user_id"]));


			if($query1 && $query2){
				return true;

			}else{

				$query1->closeCursor();
				$query2->closeCursor();
				$response = \Auther\MotorTemplate::cP("editProfilResponse", "Erreur lors du traitement.");
				return false;

			}
		}
	}

	static function treatment(&$response){

		\Auther\Verify::verifSessionExists();

		if(\Auther\Verify::verifPostElementsExist("editProfil", self::$tabElements) && isset($_FILES["editProfilImgFile"])){

			$imgFile = self::verifImgFile($_FILES["editProfilImgFile"], $response);

			if($imgFile!=null){

				$callBackUpdate = self::updateProfil(
					$_POST["editProfilSurname"],
					$_POST["editProfilName"],
					$_POST["editProfilPseudo"],
					$_POST["editProfilBiographie"],
					$imgFile, $response);

				if($callBackUpdate){

					$_SESSION["surname"] = $_POST["editProfilSurname"];
					$_SESSION["name"] = $_POST["editProfilName"];
					$_SESSION["pseudo"] = $_POST["editProfilPseudo"];
					$_SESSION["biographie"] = $_POST["editProfilBiographie"];
					if($imgFile!="empty"){

						$_SESSION["url_img_profil"] = $imgFile;

					}
					
					header("Location:Main?space=userinterface&section=profil&mode=visit&update=true");
					die(); 
					
				}
				
			}
		}
	}
}


?>