<?php
$imgHomeP = Auther\MotorTemplate::cP("siteTitle", "StudHelp-GrandMont");
$homeLoginLink = Auther\MotorTemplate::cA("HomeLoginLink", "Main.php?space=login", "se connecter.");
$homeRegisterLink = Auther\MotorTemplate::cA("HomeRegisterLink", "Main.php?space=register", "s'inscrire.");
$divLink = Auther\MotorTemplate::cDiv("", "divLink", $homeLoginLink . $homeRegisterLink);
$body = Auther\MotorTemplate::cDiv("homeDiv", "divMain", $imgHomeP . $divLink);

?>