<?php
$disconnectMessage = Auther\MotorTemplate::cP("disconnectMessage", "Vous avez été déconnecté.");
$homeLink = Auther\MotorTemplate::cA("HomeLink", "Main.php", "Revenir à l'accueil");
$body = Auther\MotorTemplate::cDiv("", "divMain", $disconnectMessage . $homeLink);
?>