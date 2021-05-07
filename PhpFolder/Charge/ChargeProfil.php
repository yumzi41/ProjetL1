<?php
namespace Charge;

class ChargeProfil{

	static function ChargeProfil($userId){

		$content = "";

		if(isset($_SESSION["user_id"])){

			$query = \Database\Db::getInstance()->prepare("SELECT * FROM users AS u LEFT JOIN imgProfil AS i ON (u.user_id = i.fk_user_id) WHERE user_id = :user_id)");

			if($query->execute(array("user_id"=>$userId))){
				$row = $query->fetch();
				if($row!=null){
					/* comment test change */
				}


			}else{
				$query->closeCursor();
				return $content;
			}

		}else{
			header('Location:http://localhost/ProjetL1/PhpFolder/Main.php');
			die();
		}
	}
	
}
?>