<?php
namespace Charge;

class ChargeProfil{

	static $tabElements = array("user_id", "surname", "name", "pseudo", "biographie", "url_img_profil");

	static function chargeProfilSection(&$contentUserInterfaceMiddle, $kserver, $userId, int $nbr){

		$contentUserInterfaceMiddle = null;

		$editProfilResponse = null;

		\Treatment\PostTreatment::treatment();

		\Treatment\CommentTreatment::treatment();

		\Treatment\ProfilTreatment::treatment($editProfilResponse);

		\Treatment\SuppressPostTreatment::treatment();

		ob_start();

		require ChargeProfil::chargeCacheOrNewProfilSection($kserver, 
			360, $userId);

		require ChargePost::chargeCacheOrNewPostSection($kserver, 60, $userId, $nbr);

		$contentUserInterfaceMiddle = ob_get_clean();
	}

	static function chargeCacheOrNewProfilSection($kserver, $time, $userId){
		
		if(isset($_GET["mode"])){

			if($_GET["mode"] == "edit"){

				$cache = \Auther\Injection::getCache($kserver, "profilEdit" . $userId, 10);

				if($cache->verifyCacheFileExists() && false){

				return $cache->getPathCache();

				}else{

				$htmlContent = self::ChargeProfilEdit();
				$cache->setContent($htmlContent);

				return $cache->getPathCache();

				}

			}
		}
			$cache = \Auther\Injection::getCache($kserver, "profilVisit" . $userId, $time);

			if($cache->verifyCacheFileExists() && false){

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