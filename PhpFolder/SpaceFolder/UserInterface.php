<?php

if(isset($_GET["section"])){

	$section = $_GET["section"];

	if($section == "profil"){

		\Charge\ChargeProfil::chargeProfilSection($contentUserInterfaceMiddle, 
			$_SERVER["REQUEST_URI"], $_SESSION["user_id"], 20, $default);


	}else if($section == "chat"){

		\Charge\ChargeChat::chargeChatSection($contentUserInterfaceMiddle, $default, 30);

	}else{

		\Charge\ChargePost::chargePostSection($contentUserInterfaceMiddle, $_SERVER['REQUEST_URI'], null, 20, $default);

	}

}else{

	\Charge\ChargePost::chargePostSection($contentUserInterfaceMiddle, $_SERVER['REQUEST_URI'], null, 20, $default);
	

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