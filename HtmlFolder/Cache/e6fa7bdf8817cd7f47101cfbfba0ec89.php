<!DOCTYPE html>
<html>
<head>
	<title>StudHelp.com-login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CssFolder/Portal.css">
</head>
<body>
	<div id='' class='divMain'><form class='formLogin' 
		method='POST' 
		action='Main.php?space=login'><p class='imgLoginP'><img src='../Img/icons8-connexion-au-compte-cloud-femelle-100.png' class='imgLogin'></p><input type='text' 
		name='loginEmail' 
		value='slapirock@gmail.com' 
		class='loginEmailEditText' 
		placeholder='veuillez entrer votre email'
		patter=
		required=''/><input type='password' 
		name='loginPassword' 
		value='K2z623pt?' 
		class='loginPasswordEditText' 
		placeholder='veuillez entrer votre mot de passe'
		patter=
		required=''/><input type='submit' 
		name='loginSubmitButton' 
		value='Valider' 
		class='loginSubmitButton' 
		placeholder=''
		patter=
		required=''/><?= $loginResponse ?? ''; ?><a href='Main.php?space=register' class='registerLink'> s'inscrire. </a> </form></div>
</body>
</html>