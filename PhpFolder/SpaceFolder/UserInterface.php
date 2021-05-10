<?php

\Treatment\PostTreatment::treatment();

if(isset($_GET["section"])){

	$section = $_GET["section"];

	if($section == "profil"){

		$editProfilResponse = null;

		\Treatment\ProfilTreatment::treatment($editProfilResponse);

		$contentUserInterfaceMiddle = file_get_contents(
			\Charge\ChargeProfil::chargeCacheOrNewProfilSection($_SERVER["REQUEST_URI"], 
			360, $_SESSION["user_id"], $default)) . file_get_contents(\Charge\ChargePost::chargeCacheOrNewPostSection($_SERVER['REQUEST_URI'], 60, $_SESSION["user_id"], 20, $default));


	}else if($section == "message"){

		$contentUserInterfaceMiddle = "";

	}else{

		\Treatment\CommentTreatment::treatment();

		$contentUserInterfaceMiddle = file_get_contents(\Charge\ChargePost::chargeCacheOrNewPostSection($_SERVER['REQUEST_URI'], 60, null, 20, $default));

	}

}else{

	\Treatment\CommentTreatment::treatment();

	$contentUserInterfaceMiddle = file_get_contents(\Charge\ChargePost::chargeCacheOrNewPostSection($_SERVER['REQUEST_URI'], 60, null, 20, $default));

}



require Charge\Charge::chargeCacheOrNewWithModel(
	$_SERVER["REQUEST_URI"],
 "userinterface.php",
  3600, "HiddenPhp/userinterface.php",
   "../HtmlFolder/index.html",
    "userinterface",
     "../CssFolder/UserInterface.css",
      $default);

?>