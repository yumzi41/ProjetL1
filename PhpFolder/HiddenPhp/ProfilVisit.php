<?php

$surname = \Auther\MotorTemplate::cP("surname", $_SESSION["surname"]);
$name = \Auther\MotorTemplate::cP("name", $_SESSION["name"]);
$pseudo = \Auther\MotorTemplate::cP("pseudo", $_SESSION["pseudo"]);
$biographie = \Auther\MotorTemplate::cP("biographie", $_SESSION["biographie"]);
$img = \Auther\MotorTemplate::cImage($_SESSION["url_img_profil"], "imgProfil");
$imgP = \Auther\MotorTemplate::cP("imgP", $img);
$linkEdit =  \Auther\MotorTemplate::cA("linkEdit", "Main?space=userinterface&section=profil&mode=edit", "modifier");

$content = \Auther\MotorTemplate::cDiv("divVisitProfil", "divVisitProfil", 
$imgP . 
$surname . 
$name . 
$pseudo . 
$biographie . 
$linkEdit);

?>
