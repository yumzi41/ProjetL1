<?php
$imgHome = Auther\MotorTemplate::cImage("../Img/logo.png", "imgHome");
$imgHomeP = Auther\MotorTemplate::cP("imgHomeP", $imgHome);
$homeLoginLink = Auther\MotorTemplate::cA("HomeLoginLink", "Main.php?space=login", "se connecter.");
$homeRegisterLink = Auther\MotorTemplate::cA("HomeRegisterLink", "Main.php?space=register", "s'inscrire.");
$divLink = Auther\MotorTemplate::cDiv("", "divLink", $homeLoginLink . $homeRegisterLink);
$body = Auther\MotorTemplate::cDiv("", "divMain", $imgHomeP . $divLink);

?>