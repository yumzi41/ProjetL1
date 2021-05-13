<?php
namespace Treatment;
class SuppressMessageTreatment{

	static $tabElements = array("SubmitButton", "HiddenMessageId");

	static function suppress($messageId){

		\Auther\Verify::verifSessionExists();

		$query = \Database\Db::getInstance()->prepare("DELETE FROM messages WHERE message_id = :message_id");

		$query->bindParam("message_id", $messageId, \PDO::PARAM_INT);

		if($query->execute()){

			$query->closeCursor();
			return true;

		}else{

			$query->closeCursor();
			return false;

		}


	}

	static function treatment(){

		if(\Auther\Verify::verifPostElementsExist("suppressMessage", self::$tabElements)){

			self::suppress($_POST["suppressMessageHiddenMessageId"]);

		}
	}

	
}
?>