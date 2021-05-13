<?php

$contentAllMessagesC = \Auther\MotorTemplate::cContent("contentAllMessages");

$divAllMessages = \Auther\MotorTemplate::cDiv("divAllMessages", "divAllMessages", $contentAllMessagesC);

$sendMessageEditText = \Auther\MotorTemplate::cInput("sendMessageEditText", "text", "", "sendMessageEditText", "discuter...", "^.{1,}$");

$sendMessageSubmitButton = \Auther\MotorTemplate::cInput("sendMessageSubmitButton", "submit", "Envoyer", "sendMessageSubmitButton", "", "");

$formSendMessage = \Auther\MotorTemplate::cForm("formSendMessage", "POST", "http://localhost/ProjetL1/PhpFolder/Main?space=userinterface&section=chat&update=true", $sendMessageEditText . $sendMessageSubmitButton);

$body = \Auther\MotorTemplate::cDiv("divChat", "divChat", $divAllMessages . $formSendMessage);

?>