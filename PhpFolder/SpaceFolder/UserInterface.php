<?php

\Treatment\PostTreatment::treatment();

$query2 = \Database\Db::getInstance()->prepare("SELECT * FROM users AS u LEFT JOIN imgProfil AS i ON (u.user_id = i.fk_user_id) WHERE user_id = :user_id)");

var_dump($query2->errorInfo());

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