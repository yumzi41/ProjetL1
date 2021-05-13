<?php

	$imgLogin = Auther\MotorTemplate::cImage("../Img/icons8-connexion-au-compte-cloud-femelle-100.png", "imgLogin");
	$imgLoginP = Auther\MotorTemplate::cP("imgLoginP", $imgLogin);

	$emailEditText = Auther\MotorTemplate::cInput("loginEmail",
		"text", 
		"visiteur@gmail.com",
		"loginEmailEditText",
		"veuillez entrer votre email", "");

	$passwordEditText = Auther\MotorTemplate::cInput("loginPassword", 
		"password", 
		"Motdepasse", 
		"loginPasswordEditText",
		"veuillez entrer votre mot de passe", "");

	$submitButton = Auther\MotorTemplate::cInput("loginSubmitButton", 
			"submit", 
			"Valider", 
			"loginSubmitButton", "", ""); 

	$loginResponseC = Auther\MotorTemplate::cContent("loginResponse");

	$registerLink = Auther\MotorTemplate::cA("registerLink", "Main.php?space=register", "s'inscrire." );

	$formLogin = Auther\MotorTemplate::cForm("formLogin",
	 	"POST",
	  	"Main.php?space=login",
	  	$imgLoginP . 
	   	$emailEditText . $passwordEditText . $submitButton . $loginResponseC . $registerLink);

	$body = Auther\MotorTemplate::cDiv("", "divMain", $formLogin);

	
?>