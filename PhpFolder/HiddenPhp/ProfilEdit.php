<?php

$editProfilSurname = \Auther\MotorTemplate::cInput("editProfilSurname","text", $_SESSION["surname"],"editProfilSurname", "Prénom...", "$.{1,50}^");

$editProfilName = \Auther\MotorTemplate::cInput("editProfilName","text", $_SESSION["name"],"editProfilName", "Nom...", "$.{1,50}^");

$editProfilPseudo = \Auther\MotorTemplate::cInput("editProfilPseudo","text", $_SESSION["pseudo"],"editProfilPseudo", "Pseudo...", "$.{1,50}^");

$editProfilBiographie = \Auther\MotorTemplate::cTextarea("editProfilBiographie", "editProfilBiographie","Biographie...", "8", "8", "$.{1,250}^", $_SESSION["biographie"]);

$img = \Auther\MotorTemplate::cImage($_SESSION["url_img_profil"], "imgProfil");
$imgP = \Auther\MotorTemplate::cP("imgP", $img);

$editProfilImgFile = \Auther\MotorTemplate::cInput("editProfilImgFile", "file", "","editProfilImgFile", "", "");

$cancelLinkVisit =  \Auther\MotorTemplate::cA("cancelLinkVisit", "Main?space=userinterface&section=profil&mode=visit", "annuler");

$editProfilSubmitButton = \Auther\MotorTemplate::cInput("editProfilSubmitButton", "submit", "Confirmer","editProfilSubmitButton", "", "");

$editProfilResponseC = \Auther\MotorTemplate::cContent("editProfilResponse");

$formEditProfil = \Auther\MotorTemplate::cFormImg("formEditProfil", "POST", 
	"Main?space=userinterface&section=profil&mode=edit",
	$imgP . 
	$editProfilImgFile .
	$editProfilSurname . 
	$editProfilName . 
	$editProfilPseudo . 
	$editProfilBiographie .
	$editProfilSubmitButton .
	$editProfilResponseC .
	$cancelLinkVisit
	);

$content = \Auther\MotorTemplate::cDiv("divEditProfil", "divEditProfil", $formEditProfil);

?>