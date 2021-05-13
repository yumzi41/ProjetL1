<?php
/* creation de la barre de navigation */

$actuLink = Auther\MotorTemplate::cA("actuLink","Main?space=userinterface&section=actu", "Actualité");
$profilLink = Auther\MotorTemplate::cA("profilLink","Main?space=userinterface&section=profil", "Mon Profil");
$chatLink = Auther\MotorTemplate::cA("chatLink","Main?space=userinterface&section=chat", "Chat");

$divNavigationBar = Auther\MotorTemplate::cDiv("", "divNavigationBar", $actuLink . $profilLink . $chatLink);

$contentUserInterfaceLeftC = Auther\MotorTemplate::cContent("contentUserInterfaceLeft");
$divContentUserInterfaceLeft = Auther\MotorTemplate::cDiv("", "divContentUserInterfaceLeft", $contentUserInterfaceLeftC);

$contentUserInterfaceMiddleC = Auther\MotorTemplate::cContent("contentUserInterfaceMiddle");
$divContentUserInterfaceMiddle = Auther\MotorTemplate::cDiv("", "divContentUserInterfaceMiddle", $contentUserInterfaceMiddleC);

$contentUserInterfaceRightC = Auther\MotorTemplate::cContent("contentUserInterfaceRight");
$divContentUserInterfaceRight = Auther\MotorTemplate::cDiv("", "divContentUserInterfaceRight", $contentUserInterfaceRightC);

$divSpaceContent = Auther\MotorTemplate::cDiv("", "divSpaceContent", 
	$divContentUserInterfaceLeft . 
	$divContentUserInterfaceMiddle . 
	$divContentUserInterfaceRight);

$buttonVisibleFormNewPost = Auther\MotorTemplate::cButton("buttonVisibleFormNewPost", "buttonVisibleFormNewPost", "Nouveau Post");

/* creation du formulaire qui apparaitra et disparaitra par le clique de l'utilisateur */

$space = Auther\MotorTemplate::cDiv("space", "space", "");

$titleNewPost = Auther\MotorTemplate::cInput("newPostTitle", "text", "","newPostTitle", "Titre (max : 25 caractères)", "^.{1,25}$" );
$descriptionNewPost = Auther\MotorTemplate::cTextArea("newPostDescription","newPostDescription", "Description (max : 450 caractères)", "","", "^.{1,450}$", "");
$submitButtonNewPost = Auther\MotorTemplate::cInput("newPostSubmitButton", "submit", "Confirmer","newPostSubmitButton", "", "" );
$buttonInvisibleFormNewPost = Auther\MotorTemplate::cButton("buttonInvisibleFormNewPost", "buttonInvisibleFormNewPost", "X");
$formNewPost =  Auther\MotorTemplate::cForm("formNewPost","POST","Main?space=userinterface&update=true#top", $titleNewPost . $descriptionNewPost . $submitButtonNewPost . $buttonInvisibleFormNewPost);
$divFormNewPost = Auther\MotorTemplate::cDiv("divFormNewPost", "divFormNewPost", $formNewPost);
$divBottomLeft = Auther\MotorTemplate::cDiv("divBottomLeft", "divBottomLeft", $divFormNewPost . $buttonVisibleFormNewPost);

$js = Auther\MotorTemplate::cJavaScript(file_get_contents("../JsFolder/VisibiltyFormNewPost.js"));

$divMain = Auther\MotorTemplate::cDiv("", "divMain", $divNavigationBar . $space . $divSpaceContent);

$body = $divMain . $divBottomLeft . $js;

?>