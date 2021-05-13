<?php
// Dans cette section, j'ai utilisé les fonctions ob_start et ob_get_clean couplet à des balises <? $variable ?? ''> qui permettent de récupérer $variable si elle existe et de la mettre à la place de la balise correspondante. Cette méthode permet le chargement ou la mise à jour des parties contenant les informations qui changent constamment et permet aussi de ne pas recharger les fichiers html qui ne changeront jamais avec le temps (exemple : l'espace login). 
//

if(isset($_GET["section"])){

	$section = $_GET["section"];

	if($section == "profil"){

		\Charge\ChargeProfil::chargeProfilSection($contentUserInterfaceMiddle, 
			$_SERVER["REQUEST_URI"], $_SESSION["user_id"], 20, $default);


	}else if($section == "chat"){

		\Charge\ChargeChat::chargeChatSection($contentUserInterfaceMiddle, $default, 30);

	}else{

		\Charge\ChargePost::chargePostSection($contentUserInterfaceMiddle, $_SERVER['REQUEST_URI'], null, 20);

	}

}else{

	\Charge\ChargePost::chargePostSection($contentUserInterfaceMiddle, $_SERVER['REQUEST_URI'], null, 20);
	

}

require Charge\Charge::chargeCacheOrNewWithModel(
	$_SERVER["REQUEST_URI"],
 "userinterface.php",
  3600, "HiddenPhp/userinterface.php",
   "../HtmlFolder/index.html",
    "StudHelp.com-userinterface",
     "../CssFolder/UserInterface.css",
      $default);

?>