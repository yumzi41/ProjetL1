<div id='divEditProfil' class='divEditProfil'><form class='formEditProfil' 
		enctype='multipart/form-data'
		method='POST' 
		action='Main?space=userinterface&section=profil&mode=edit'><p class='imgP'><img src='../ImgProfil/d740ad38cb9e75bb5ad616cb51db8ac520.png' class='imgProfil'></p><input type='file' 
		name='editProfilImgFile' 
		value='' 
		class='editProfilImgFile' 
		placeholder=''
		patter=
		required=''/><input type='text' 
		name='editProfilSurname' 
		value='Noe' 
		class='editProfilSurname' 
		placeholder='Prénom...'
		patter=$.{1,50}^
		required=''/><input type='text' 
		name='editProfilName' 
		value='Ramanan' 
		class='editProfilName' 
		placeholder='Nom...'
		patter=$.{1,50}^
		required=''/><input type='text' 
		name='editProfilPseudo' 
		value='yumzi' 
		class='editProfilPseudo' 
		placeholder='Pseudo...'
		patter=$.{1,50}^
		required=''/><textarea class='editProfilBiographie' name='editProfilBiographie' rows='7' placeholder='Biographie...' cols='' pattern='$.{1,250}^'>JJJJlckjdqlcdjk</textarea><input type='submit' 
		name='editProfilSubmitButton' 
		value='Confirmer' 
		class='editProfilSubmitButton' 
		placeholder=''
		patter=
		required=''/><?= $editProfilResponse ?? ''; ?><a href='Main?space=userinterface&section=profil&mode=visit' class='cancelLinkVisit'> annuler </a> </form></div>