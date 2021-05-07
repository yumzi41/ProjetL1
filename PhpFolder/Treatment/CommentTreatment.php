<?php
namespace Treatment;

class CommentTreatment{

	public static $tabElements = array("EditText", "SubmitButton", "HiddenPostId");

	static function insert($content, $userId, $postId){

		if(isset($_SESSION["user_id"])){


		$query = \Database\Db::getInstance()->prepare("INSERT INTO comments(content, date_publi, fk_user_id, fk_post_id) VALUES(:content, NOW(), :fk_user_id, :fk_post_id)");

			if($query->execute(array("content"=>$content, 
				"fk_user_id"=>$userId, 
				"fk_post_id"=>$postId))){

					$query->closeCursor();
					return true;

				}else{

					$query->closeCursor();
					return false;

					}

		$query->closeCursor();
		return false;

			
		}else{
			header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
			die();
		}

	}


	static function treatment(){
		 if(\Auther\Verify::verifPostElementsExist("sendComment", self::$tabElements)){
		 	self::insert(
		 		$_POST["sendCommentEditText"],
		 		$_SESSION["user_id"],
		 		$_POST["sendCommentHiddenPostId"]);
		 }
	}
}




?>