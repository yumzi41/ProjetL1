if(document.getElementById('buttonSuppressPost[[post_id]]').style.visibility != 'hidden')
{
	document.getElementById('formSuppressPost[[post_id]]').style.visibility = 'hidden';
}
document.getElementById('buttonSuppressPost[[post_id]]').onclick = function(){
	document.getElementById('buttonSuppressPost[[post_id]]').style.visibility = 'hidden';
	document.getElementById('formSuppressPost[[post_id]]').style.visibility = 'visible';

}
document.getElementById('buttonCanceledSuppressPost[[post_id]]').onclick = function(){
	document.getElementById('buttonSuppressPost[[post_id]]').style.visibility = 'visible';
	document.getElementById('formSuppressPost[[post_id]]').style.visibility = 'hidden';

}