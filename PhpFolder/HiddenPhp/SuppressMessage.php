<?php
$buttonSuppressMessage = \Auther\MotorTemplate::cButton("buttonSuppressMessage[[message_id]]", "buttonSuppressMessage", "suppimer");

$buttonCancelledSuppressMessage = \Auther\MotorTemplate::cButton("buttonCanceledSuppressMessage[[message_id]]", "buttonCancelledSuppressMessage", "annuler");

$suppressMessageSubmitButton = \Auther\MotorTemplate::cInput("suppressMessageSubmitButton", "submit", "confirmer", "suppressMessageSubmitButton", "", "");


$suppressMessageHiddenMessageId = \Auther\MotorTemplate::cInput("suppressMessageHiddenMessageId", "hidden", "[[message_id]]", "suppressMessageHiddenMessageId", "", "");

$formSuppressMessage = \Auther\MotorTemplate::cFormWithId("formSuppressMessage[[message_id]]","formSuppressMessage" ,"POST", "Main?space=userinterface&section=chat&update=true", $suppressMessageSubmitButton . $buttonCancelledSuppressMessage . $suppressMessageHiddenMessageId);

$suppressElements = $buttonSuppressMessage . $formSuppressMessage;
?>