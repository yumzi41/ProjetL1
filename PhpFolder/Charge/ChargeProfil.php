<?php
namespace Charge;

class ChargeProfil{

	static $tabElements = array("user_id", "surname", "name", "pseudo", "biographie", "url_img_profil");

	static function chargeProfilSection(&$contentUserInterfaceMiddle, $kserver, $userId, int $nbr, $default){

		$contentUserInterfaceMiddle = null;

		$editProfilResponse = null;

		\Treatment\PostTreatment::treatment();

		\Treatment\CommentTreatment::treatment();

		\Treatment\ProfilTreatment::treatment($editProfilResponse);

		\Treatment\SuppressPostTreatment::treatment();

		ob_start();

		require ChargeProfil::chargeCacheOrNewProfilSection($kserver, 
			360, $userId, $default);

		require ChargePost::chargeCacheOrNewPostSection($kserver, 60, $userId, $nbr, $default);

		$contentUserInterfaceMiddle = ob_get_clean();
	}

	static function chargeCacheOrNewProfilSection($kserver, $time, $userId, $default){

		\Auther\Verify::verifUpdateMode($default);
		
		if(isset($_GET["mode"])){

			if($_GET["mode"] == "edit"){

				$cache = \Auther\Injection::getCache($kserver, "profilEdit" . $userId, 10);

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