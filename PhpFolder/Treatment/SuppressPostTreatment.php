<?php
namespace Treatment;

class SuppressPostTreatment{

	static $tabElements = array("SubmitButton", "HiddenPostId");

	static function suppress($postId){

		$query = \Database\Db::getInstance()->prepare("DELETE FROM posts WHERE post_id = :post_id");

		$query->bindParam("post_id", $postId, \PDO::PARAM_INT);

		if($query->execute()){
			
			$query->closeCursor();
			return true;

		}else{
			
			$query->closeCursor();
			return false;

		}
	}

	static function treatment(){

		\Auther\Verify::verifSessionExists();

		if(\Auther\Verify::verifPostElementsExist("suppressPost", self::$tabElements)){

			self::suppress($_POST["suppressPostHiddenPostId"]);

		}
	}		
}
?>