<?php
namespace Treatment;
class PostTreatment{
	
	static $tabElements = array("Title", "Description", "SubmitButton");

	static function insert($title, $description){
		if(isset($_SESSION["user_id"])){

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

		}else{
			header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
			die();
		}
	}

	static function treatment(){
		if(\Auther\Verify::verifPostElementsExist("newPost", self::$tabElements)){
			self::insert($_POST["newPostTitle"], 
				$_POST["newPostDescription"]);
		}
	}
}
?>
