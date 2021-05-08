<?php
namespace Charge;

class ChargeProfil{

	static $tabElements = array("user_id", "surname", "name", "pseudo", "biographie", "img_profil_url");

	static function ChargeProfilVisit(){

		$content = "";

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			$surname = \Auther\MotorTemplate::cP("surname", $_SESSION["surname"]);
			$name = \Auther\MotorTemplate::cP("name", $_SESSION["name"]);
			$pseudo = \Auther\MotorTemplate::cP("pseudo", $_SESSION["pseudo"]);
			$biographie = \Auther\MotorTemplate::cP("biographie", $_SESSION["biographie"]);
			$img = \Auther\MotorTemplate::cImage($_SESSION["img_profil_url"], "img");
			$imgP = \Auther\MotorTemplate::cP("imgP", $img);
			$linkEdit =  \Auther\MotorTemplate::cA("linkEdit", "Main?space=userinterface&section=profil&mode=edit", "modifier");

			$content = \Auther\MotorTemplate::cDiv("divProfilVisit", "divProfil", 
				$imgP . 
				$surname . 
				$name . 
				$pseudo . 
				$biographie);

			return $content;

			}else
			{
				return $content;
			}
	}

	static function chargeProfilEdit(){

		$content = "";

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			$editProfilSurname = \Auther\MotorTemplate::cInput("editProfilSurname","text", $_SESSION["surname"], "", "$.{1,50}^");

			$editProfilSame = \Auther\MotorTemplate::cInput("editProfilName","text", $_SESSION["name"], "", "$.{1,50}^");

			$editProfilPseudo = \Auther\MotorTemplate::cInput("editProfilPseudo","text", $_SESSION["pseudo"], "", "$.{1,50}^");

			$editProfilBiographie = \Auther\MotorTemplate::cTextarea("editProfilBiographie", "editProfilBiographie","", "8", "8", "$.{1,250}^", $_SESSION["biographie"]);

			$img = \Auther\MotorTemplate::cImage($_SESSION["img_profil_url"], "img");
			$imgP = \Auther\MotorTemplate::cInput("imgP", $img);

			$editProfilImg = \Auther\MotorTemplate::cInput("editProfilImg", "file", "", "", "");

			$linkVisit =  \Auther\MotorTemplate::cA("linkVisit", "Main?space=userinterface&section=profil&mode=visit", "annuler");

			$formEditProfil = \Auther\MotorTemplate::cFormImg("formEditProfil", "POST", 
				"Main?space=userinterface&section=profil&mode=visit",
				$imgP . 
				$editProfilImg .
				$editProfilSurname . 
				$editProfilName . 
				$editProfilPseudo . 
				$editProfilBiographie);

			$content = \Auther\MotorTemplate::cDiv("divEditProfil", "divEditProfil", $formEditProfil);

			return $content;

			}else{

				return $content;
			}
	}	
}
?>