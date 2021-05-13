<!DOCTYPE html>
<html>
<head>
	<title>StudHelp.com-userinterface</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CssFolder/UserInterface.css">
</head>
<body>
	<div id='' class='divMain'><div id='' class='divNavigationBar'><a href='Main?space=userinterface&section=actu' class='actuLink'> Actualité </a> <a href='Main?space=userinterface&section=profil' class='profilLink'> Mon Profil </a> <a href='Main?space=userinterface&section=message' class='messageLink'> Message </a> </div><div id='' class='divSpaceContent'><div id='' class='divContentUserInterfaceLeft'><?= $contentUserInterfaceLeft ?? ''; ?></div><div id='' class='divContentUserInterfaceMiddle'><?= $contentUserInterfaceMiddle ?? ''; ?></div><div id='' class='divContentUserInterfaceRight'><?= $contentUserInterfaceRight ?? ''; ?></div></div></div><div id='divBottomLeft' class='divBottomLeft'><div id='divFormNewPost' class='divFormNewPost'><form class='formNewPost' 
		method='POST' 
		action='Main?space=userinterface&section=profil&update=true'><input type='text' 
		name='newPostTitle' 
		value='' 
		class='newPostTitle' 
		placeholder='Titre...'
		patter=$.{1,50}^
		required=''/><textarea class='newPostDescription' name='newPostDescription' rows='' placeholder='exprimez vous...' cols='' pattern='$.{1,250}^'></textarea><input type='submit' 
		name='newPostSubmitButton' 
		value='Confirmer' 
		class='newPostSubmitButton' 
		placeholder=''
		patter=
		required=''/><button id='buttonInvisibleFormNewPost' type='button' class='buttonInvisibleFormNewPost'> X </button></form></div><button id='buttonVisibleFormNewPost' type='button' class='buttonVisibleFormNewPost'> Nouveau Post </button></div><script> if(document.getElementById('buttonVisibleFormNewPost').style.visibility != "hidden"){

	document.getElementById('divFormNewPost').style.visibility = "hidden";

}
document.getElementById('buttonVisibleFormNewPost').onclick = function(){
	document.getElementById('divFormNewPost').style.visibility = 'visible';
	document.getElementById('buttonVisibleFormNewPost').style.visibility = 'hidden';
}
document.getElementById('buttonInvisibleFormNewPost').onclick = function(){
	document.getElementById('divFormNewPost').style.visibility = 'hidden';
	document.getElementById('buttonVisibleFormNewPost').style.visibility = 'visible';
}  </script>
</body>
</html>