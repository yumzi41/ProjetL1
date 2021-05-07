<?php

\Treatment\PostTreatment::treatment();

if(isset($_GET["section"])){

	$section = $_GET["section"];

	if($section == "profil"){

		$contentUserInterfaceMiddle = "";

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