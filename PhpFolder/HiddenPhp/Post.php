<?php
$date = \Auther\MotorTemplate::cP("date_publi", "Le : " . $GLOBALS["row"]["date_publi"] . ", ");
$pseudo = \Auther\MotorTemplate::cP("pseudo", "de : " . $GLOBALS["row"]["pseudo"] . ", ");
$title = \Auther\MotorTemplate::cP("title", "intitulé : " . $GLOBALS["row"]["title"] . ".");

$description = \Auther\MotorTemplate::cP("description", $GLOBALS["row"]["description"]);

$sendCommentEditText = \Auther\MotorTemplate::cInput("sendCommentEditText", "text", "", "sendCommentEditText", "commenter", "");
$sendCommentSubmitButton = \Auther\MotorTemplate::cInput("sendCommentSubmitButton", "submit", "Go", "sendCommentSubmitButton", "", "");

$sendCommentHiddenPostId = \Auther\MotorTemplate::cInput("sendCommentHiddenPostId", "hidden", $GLOBALS["row"]['post_id'], "sendCommentHiddenPostId", "", "");

$formSendComment = \Auther\MotorTemplate::cForm("formSendComment","POST", $action . "#" . $GLOBALS["row"]["post_id"], $sendCommentEditText . $sendCommentSubmitButton . $sendCommentHiddenPostId);

$divHead = \Auther\MotorTemplate::cDiv("", "divHead", $date . $pseudo . $title);
$divImg = \Auther\MotorTemplate::cDiv("", "divImg", self::chargeImgPost($GLOBALS["row"]["post_id"]));
$divCom = \Auther\MotorTemplate::cDiv("", "divCom", self::chargeComPost($GLOBALS["row"]["post_id"], 15));


$divLeft = \Auther\MotorTemplate::cDiv("", "divLeft", $divHead . $description . $divImg);
$divRight = \Auther\MotorTemplate::cDiv("", "divRight", $formSendComment . $divCom);


$divPost = \Auther\MotorTemplate::cDiv($GLOBALS["row"]["post_id"], "divPost", $divLeft . $divRight);
?>