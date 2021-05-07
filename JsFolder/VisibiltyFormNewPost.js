if(document.getElementById('buttonVisibleFormNewPost').style.visibility != "hidden"){

	document.getElementById('divFormNewPost').style.visibility = "hidden";

}
document.getElementById('buttonVisibleFormNewPost').onclick = function(){
	document.getElementById('divFormNewPost').style.visibility = 'visible';
	document.getElementById('buttonVisibleFormNewPost').style.visibility = 'hidden';
}
document.getElementById('buttonInvisibleFormNewPost').onclick = function(){
	document.getElementById('divFormNewPost').style.visibility = 'hidden';
	document.getElementById('buttonVisibleFormNewPost').style.visibility = 'visible';
} 