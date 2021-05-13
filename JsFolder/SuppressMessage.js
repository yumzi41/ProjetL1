if(document.getElementById('buttonSuppressMessage[[message_id]]').style.visibility != 'hidden')
{
	document.getElementById('formSuppressMessage[[message_id]]').style.visibility = 'hidden';
}
document.getElementById('buttonSuppressMessage[[message_id]]').onclick = function(){
	document.getElementById('buttonSuppressMessage[[message_id]]').style.visibility = 'hidden';
	document.getElementById('formSuppressMessage[[message_id]]').style.visibility = 'visible';

}
document.getElementById('buttonCanceledSuppressMessage[[message_id]]').onclick = function(){
	document.getElementById('buttonSuppressMessage[[message_id]]').style.visibility = 'visible';
	document.getElementById('formSuppressMessage[[message_id]]').style.visibility = 'hidden';

}