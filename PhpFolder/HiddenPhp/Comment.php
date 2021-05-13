<?php
$date = \Auther\MotorTemplate::cP("date", $GLOBALS["row"]["date_publi"]);

$pseudo = \Auther\MotorTemplate::cP("pseudo", $GLOBALS["row"]["pseudo"]);

$text = \Auther\MotorTemplate::cP("text", $GLOBALS["row"]["content"]);

$divComment = \Auther\MotorTemplate::cDiv("", "divComment", $pseudo . $date . $text);
?>