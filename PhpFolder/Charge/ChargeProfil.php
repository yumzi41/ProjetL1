<?php
namespace Charge;

class ChargeProfil{

	static $tabElements = array("user_id", "surname", "name", "pseudo", "biographie", "url_img_profil");

	static function chargeCacheOrNewProfilSection($kserver, $time, $userId, $default){

		if(isset($_GET["update"])){
			if($_GET["update"]=="true"){
				$default = false;
			}
		}

		if(isset($_GET["mode"])){

			if($_GET["mode"] == "edit"){

				$cache = \Auther\Injection::getCache($kserver, "profilEdit" . $userId, $time);

				if($cache->verifyCacheFileExists() && $default){

				return $cache->getPathCache();

				}else{

				$htmlContent = self::ChargeProfilEdit();
				$cache->setContent($htmlContent);

				return $cache->getPathCache();

				}

			}
		}
			$cache = \Auther\Injection::getCache($kserver, "profilVisit" . $userId, $time);

			if($cache->verifyCacheFileExists() && $default){

			return $cache->getPathCache();

			//login space init

			}else{

			$htmlContent = self::ChargeProfilVisit();
			$cache->setContent($htmlContent);

			return $cache->getPathCache();

			
		}
	}

	static function ChargeProfilVisit(){

		$content = "";

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			require("HiddenPhp/ProfilVisit.php");

			return $content;

			}else
			{
				return $content;
			}
	}

	static function chargeProfilEdit(){

		$content = "";

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			require("HiddenPhp/ProfilEdit.php");

			return $content;

			}else{

				return $content;
			}
	}	
}
?>