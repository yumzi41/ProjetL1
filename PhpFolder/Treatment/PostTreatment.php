<?php
namespace Treatment;
class PostTreatment{
	
	static $tabElements = array("Title", "Description", "SubmitButton");

	static function insert($title, $description){

			$query = \Database\Db::getInstance()->prepare("INSERT INTO posts(title, description, date_publi, fk_user_id) VALUES(:title, :description, NOW(), :fk_user_id)");
			
			if($query->execute(array(
					"title"=> $title,
					"description"=> $description ,
					"fk_user_id"=> $_SESSION["user_id"]))){

				
				$query->closeCursor();
				return true;

			}else{
				$query->closeCursor();
				return false;
			}
	}

	static function treatment(){

		\Auther\Verify::verifSessionExists();

		if(\Auther\Verify::verifPostElementsExist("newPost", self::$tabElements)){
			
			self::insert($_POST["newPostTitle"], 
				$_POST["newPostDescription"]);
		}
	}
}
?>
