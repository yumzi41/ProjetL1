<?php
namespace Charge;

class ChargePost{


	static function chargeCacheOrNewPostSection($kserver, $time, $userId, int $nbr, $default){

		$cache = \Auther\Injection::getCache($kserver, "post" . $userId, $time);
		
		if($cache->verifyCacheFileExists() && $default){

			return $cache->getPathCache();


		}else{

			$htmlContent = self::ChargePost($userId, $nbr);
			$cache->setContent($htmlContent);

			return $cache->getPathCache();

		}

	}


	static function chargePost($userId, int $nbr){

		$content = "";

		if($userId==null){

			$order = "SELECT * FROM posts AS p LEFT JOIN users AS u ON (p.fk_user_id = u.user_id) ORDER BY date_publi DESC LIMIT :nbr";

		}else{

			$order = "SELECT * FROM posts AS p LEFT JOIN users AS u ON (p.fk_user_id = u.user_id) WHERE user_id = :user_id ORDER BY date_publi DESC LIMIT :nbr";

		}

		$query = \Database\Db::getInstance()->prepare($order);
		
		if($query){

				$query->bindParam("nbr", $nbr, \PDO::PARAM_INT);
				
				if(!$userId==null){

					$query->bindParam("user_id", $userId, \PDO::PARAM_INT);
					
				}
				
				$query->execute();

				while($row = $query->fetch()){
					$date = \Auther\MotorTemplate::cP("date_publi", "Le : " . $row["date_publi"] . ", ");
					$pseudo = \Auther\MotorTemplate::cP("pseudo", "de : " . $row["pseudo"] . ", ");
					$title = \Auther\MotorTemplate::cP("title", "intitulé : " . $row["title"] . ".");
					
					$description = \Auther\MotorTemplate::cP("description", $row["description"]);

					$sendCommentEditText = \Auther\MotorTemplate::cInput("sendCommentEditText", "text", "", "sendCommentEditText", "commenter", "");
					$sendCommentSubmitButton = \Auther\MotorTemplate::cInput("sendCommentSubmitButton", "submit", "Go", "sendCommentSubmitButton", "", "");

					$sendCommentHiddenPostId = \Auther\MotorTemplate::cInput("sendCommentHiddenPostId", "hidden", $row['post_id'], "sendCommentHiddenPostId", "", "");

					$formSendComment = \Auther\MotorTemplate::cForm("formSendComment","POST", "#" . $row["post_id"], $sendCommentEditText . $sendCommentSubmitButton . $sendCommentHiddenPostId);
					
					$divHead = \Auther\MotorTemplate::cDiv("", "divHead", $date . $pseudo . $title);
					$divImg = \Auther\MotorTemplate::cDiv("", "divImg", self::chargeImgPost($row["post_id"]));
					$divCom = \Auther\MotorTemplate::cDiv("", "divCom", self::chargeComPost($row["post_id"], 15));


					$divLeft = \Auther\MotorTemplate::cDiv("", "divLeft", $divHead . $description . $divImg);
					$divRight = \Auther\MotorTemplate::cDiv("", "divRight", $formSendComment . $divCom);

				
					$divPost = \Auther\MotorTemplate::cDiv($row["post_id"], "divPost", $divLeft . $divRight);

					$content = $content . $divPost;

					}
					
			$query->closeCursor();
			return $content;


		}
		$query->closeCursor();
		return $content;
	}

	static function chargeImgPost($postId){

		$content = "";

		$query = \Database\Db::getInstance()->prepare("SELECT * FROM imgPost WHERE fk_post_id = :fk_post_id");

		if($query){
			$query->execute(array("fk_post_id"=>$postId));

				while($row = $query->fetch()){

					//recuperation link img

				}
				$query->closeCursor();
				return $content;
		}
		$query->closeCursor();
		return $content;

	}


	static function chargeComPost($postId, $nbr){

		$content = "";

		$query = \Database\Db::getInstance()->prepare("SELECT c.content, c.date_publi, u.pseudo FROM comments AS c LEFT JOIN users AS u ON (c.fk_user_id = u.user_id) WHERE c.fk_post_id = :fk_post_id LIMIT :nbr");

		if(!$query==null){

			$query->bindParam("fk_post_id", $postId, \PDO::PARAM_INT);
			$query->bindParam("nbr", $nbr, \PDO::PARAM_INT);
			$query->execute();


				while($row = $query->fetch()){


					$date = \Auther\MotorTemplate::cP("date", $row["date_publi"]);

					$pseudo = \Auther\MotorTemplate::cP("pseudo", $row["pseudo"]);

					$text = \Auther\MotorTemplate::cP("text", $row["content"]);

					$content = $content. \Auther\MotorTemplate::cDiv("", "divComment", $pseudo . $date . $text);

				}
				$query->closeCursor();
				return $content;
		}
		$query->closeCursor();
		return $content;

	}
}


?>