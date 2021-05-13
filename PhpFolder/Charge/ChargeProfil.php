<?php

// dans l'ensemble, les fonctions de cette classe fonctionnent comme celles documentées précedemment //

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
		
		if(isset($_GET["mode"]) && $_GET["mode"] == "edit"){
				
				$cache = \Auther\Injection::getCache($kserver, "profilEdit" . $userId, 10);

				if($cache->verifyCacheFileExists() && false){

					return $cache->getPathCache();

				}else{

					$htmlContent = self::ChargeProfilEdit();
					$cache->setContent($htmlContent);
					return $cache->getPathCache();

				}

			}
		else{

			$cache = \Auther\Injection::getCache($kserver, "profilVisit" . $userId, $time);

			if($cache->verifyCacheFileExists() && false){

				return $cache->getPathCache();

			}else{

				$htmlContent = self::ChargeProfilVisit();
				$cache->setContent($htmlContent);
				return $cache->getPathCache();
			}
	}
}

	// Cette fonction récupérera ces données directement dans le tableau $_SESSION fréquemment mis à jour //

	static function ChargeProfilVisit(){

		$content = \Auther\MotorTemplate::cA("loadErrorProfil","Main?space=disconnect", "Erreur chargement profil, essayez de vous reconnecter.");

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			require("HiddenPhp/ProfilVisit.php");

			return $content;

			}else
			{
				
				return $content;
			}
	}

	// Cette fonction récupérera ces données directement dans le tableau $_SESSION fréquemment mis à jour, après l'envoie et le traitement du formulaire elle les mettra à jour //

	static function chargeProfilEdit(){

		$content = \Auther\MotorTemplate::cA("loadErrorProfil","Main?space=disconnect", "Erreur chargement profil, essayez de vous reconnecter.");

		if(\Auther\Verify::verifSessionElementsExist(self::$tabElements)){

			require("HiddenPhp/ProfilEdit.php");

			echo "verif ok";

			return $content;

			}else{

				echo "verif pas ok";

				return $content;
			}
	}	
}
?>