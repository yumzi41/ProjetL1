<?php
namespace Treatment;
class MessageTreatment{

	 static $tabElements = array("EditText", "SubmitButton");

	 static function insert($content){

	 	\Auther\Verify::verifSessionExists();

	 	$query = \Database\Db::getInstance()->prepare("INSERT INTO messages(content, date_publi, fk_user_id) VALUES(:content, now(), :fk_user_id)");

	 	if($query->execute(array("content"=>$content, "fk_user_id"=>$_SESSION["user_id"]))){

	 		$query->closeCursor();
	 		return true;
	 	}else{
	 		
	 		$query->closeCursor();
	 		return false;
	 	}
	 }
	 	
	 

	 static function treatment(){

	 	if(\Auther\Verify::verifPostElementsExist("sendMessage", self::$tabElements)){

	 		self::insert($_POST["sendMessageEditText"]);

	 	}
	 	
	 }
	
}
?>