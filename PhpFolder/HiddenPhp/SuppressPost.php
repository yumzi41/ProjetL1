<?php
$buttonSuppressPost = \Auther\MotorTemplate::cButton("buttonSuppressPost[[post_id]]", "buttonSuppressPost", "suppimer");

$buttonCancelledSuppressPost = \Auther\MotorTemplate::cButton("buttonCanceledSuppressPost[[post_id]]", "buttonCancelledSuppressPost", "annuler");

$suppressPostSubmitButton = \Auther\MotorTemplate::cInput("suppressPostSubmitButton", "submit", "confirmer", "suppressPostSubmitButton", "", "");


$suppressPostHiddenPostId = \Auther\MotorTemplate::cInput("suppressPostHiddenPostId", "hidden", "[[post_id]]", "suppressPostHiddenPostId", "", "");

$formSuppressPost = \Auther\MotorTemplate::cFormWithId("formSuppressPost[[post_id]]","formSuppressPost" ,"POST", "Main?space=userinterface&section=profil&update=true", $suppressPostSubmitButton . $buttonCancelledSuppressPost . $suppressPostHiddenPostId);

$suppressElements = $buttonSuppressPost . $formSuppressPost;
?>