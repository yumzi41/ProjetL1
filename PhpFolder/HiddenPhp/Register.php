<?php
			$imgRegister = Auther\MotorTemplate::cImage("../Img/icons8-connexion-au-compte-cloud-male-100.png", "imgRegister");
			$imgRegisterP = Auther\MotorTemplate::cP("imgRegisterP", $imgRegister);


			$surnameEditText = Auther\MotorTemplate::cInput("registerSurname", 
				"text", 
				"Noe", 
				"registerSurnameEditText",
				"veuillez entrer votre prenom", "");

			$nameEditText = Auther\MotorTemplate::cInput("registerName", 
				"text", 
				"Ramanan", 
				"registerNameEditText",
				"veuillez entrer votre nom", "");

			$emailEditText = Auther\MotorTemplate::cInput(
				"registerEmail", 
				"text", 
				"slap@gmail.com", 
				"registeremailEditText",
				"veuillez entrer votre email", "");

			$pseudoEditText = Auther\MotorTemplate::cInput("registerPseudo", 
				"text", 
				"yumzi",
				"registerPseudoEditText",
				"veuillez entrer votre pseudo", "");

			$passwordEditText = Auther\MotorTemplate::cInput("registerPassword", 
				"password", 
				"K2z623pt?", 
				"registerPasswordEditText","veuillez entrer votre mot de passe", "");

			$passwordConfirmEditText = Auther\MotorTemplate::cInput("registerPasswordConfirm", 
				"password", 
				"K2z623pt?", 
				"registerPasswordConfirmEditText",
				"veuillez confirmer votre mot de passe", "");

			$submitButton = Auther\MotorTemplate::cInput("registerSubmitButton", 
				"submit", 
				"Valider", 
				"registerSubmitButton","", "");

			$registerResponseC = Auther\MotorTemplate::cContent("registerResponse");

			$loginLink = Auther\MotorTemplate::cA("loginLink", "Main.php?space=login", "se connecter.");


			$formRegister = Auther\MotorTemplate::cForm("formRegister",
	  			"POST",
	  			"Main.php?space=register",
	  			$imgRegisterP . 
	  			$surnameEditText . $nameEditText .
	  			$pseudoEditText . $emailEditText . 
	   			$passwordEditText . $passwordConfirmEditText . 
	   			$submitButton . $registerResponseC . $loginLink);

			$body = Auther\MotorTemplate::cDiv("", "divMain", $formRegister);


?>