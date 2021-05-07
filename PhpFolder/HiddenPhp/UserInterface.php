<?php
/* creation de la barre de navigation */

$actuLink = Auther\MotorTemplate::cA("actuLink","Main?space=userinterface&section=actu", "Actualité");
$profilLink = Auther\MotorTemplate::cA("profilLink","Main?space=userinterface&section=profil", "Mon Profil");
$messageLink = Auther\MotorTemplate::cA("messageLink","Main?space=userinterface&section=message", "Message");

$divNavigationBar = Auther\MotorTemplate::cDiv("", "divNavigationBar", $actuLink . $profilLink . $messageLink);

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

$titleNewPost = Auther\MotorTemplate::cInput("newPostTitle", "text", "","newPostTitle", "Titre...", "$.{1,50}^" );
$descriptionNewPost = Auther\MotorTemplate::cTextArea("newPostDescription","newPostDescription", "exprimez vous...", "","", "$.{1,250}^" );
$submitButtonNewPost = Auther\MotorTemplate::cInput("newPostSubmitButton", "submit", "Confirmer","newPostSubmitButton", "", "" );
$buttonInvisibleFormNewPost = Auther\MotorTemplate::cButton("buttonInvisibleFormNewPost", "buttonInvisibleFormNewPost", "X");
$formNewPost =  Auther\MotorTemplate::cForm("formNewPost","POST","", $titleNewPost . $descriptionNewPost . $submitButtonNewPost . $buttonInvisibleFormNewPost);
$divFormNewPost = Auther\MotorTemplate::cDiv("divFormNewPost", "divFormNewPost", $formNewPost);
$divBottomLeft = Auther\MotorTemplate::cDiv("divBottomLeft", "divBottomLeft", $divFormNewPost . $buttonVisibleFormNewPost);

$js = Auther\MotorTemplate::cJavaScript(file_get_contents("../JsFolder/VisibiltyFormNewPost.js"));

$divMain = Auther\MotorTemplate::cDiv("", "divMain", $divNavigationBar . $divSpaceContent);

$body = $divMain . $divBottomLeft . $js;

?>