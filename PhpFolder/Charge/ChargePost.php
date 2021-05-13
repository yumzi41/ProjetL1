<?php
// Même principe que ChargeChat //
namespace Charge;
class ChargePost{


	static function chargePostSection(&$contentUserInterfaceMiddle, $kserver, $userId, int $nbr){

		\Treatment\PostTreatment::treatment();

		\Treatment\CommentTreatment::treatment();

		$contentUserInterfaceMiddle = file_get_contents(\Charge\ChargePost::chargeCacheOrNewPostSection($kserver, 60, $userId, $nbr));


	}

	static function chargeCacheOrNewPostSection($kserver, $time, $userId, int $nbr){

		$cache = \Auther\Injection::getCache($kserver, "post.php" . $userId, $time);
		
		if($cache->verifyCacheFileExists() && false){

			return $cache->getPathCache();


		}else{

			$htmlContent = self::ChargePost($userId, $nbr);
			$cache->setContent($htmlContent);

			return $cache->getPathCache();
		}

	}

	// cette fonction prend en paramêtre userId qui, dans le cas d'un userId null, chargera le fil d'actualité global sinon, seulement les posts associés à l'utilisateur de session pour compléter la section profil //

	static function chargePost($userId, int $nbr){

		$content = "";

		if($userId==null){

			$order = "SELECT * FROM posts AS p LEFT JOIN users AS u ON (p.fk_user_id = u.user_id) ORDER BY date_publi DESC LIMIT :nbr";

			$action = "Main?space=userinterface&section=actu&update=true";

		}else{

			$order = "SELECT * FROM posts AS p LEFT JOIN users AS u ON (p.fk_user_id = u.user_id) WHERE user_id = :user_id ORDER BY date_publi DESC LIMIT :nbr";

			$action = "Main?space=userinterface&section=profil&update=true";

		}

		$query = \Database\Db::getInstance()->prepare($order);
		
		if($query){

				$query->bindParam("nbr", $nbr, \PDO::PARAM_INT);
				
				if(!$userId==null){

					$query->bindParam("user_id", $userId, \PDO::PARAM_INT);
				}
				
				$query->execute();

				while($row = $query->fetch()){
					 // j'aurai aimé dissimuler cette partie du code mais je n'ai pas trouvé le moyen de faire communiquer la variable $row entres plusieurs fichiers php //

					$date = \Auther\MotorTemplate::cP("date_publi", "Le : " . $row["date_publi"] . ", ");
					$pseudo = \Auther\MotorTemplate::cP("pseudo", "de : " . $row["pseudo"] . ", ");
					$title = \Auther\MotorTemplate::cP("title", "intitulé : " . $row["title"] . ".");

					// onn vérifie la cohérence de l'url de la photonde profil sinon on affiche celle par défaut //

					if($row["url_img_profil"]==null || $row["url_img_profil"]=="" || !file_exists($row["url_img_profil"])){

					$imgProfil = \Auther\MotorTemplate::cImage("../Img/avatar.png","imgProfilPost");

					}else{

					$imgProfil = \Auther\MotorTemplate::cImage($row["url_img_profil"],"imgProfilPost");

					}

					$imgProfilP = \Auther\MotorTemplate::cP("imgProfilPostP", $imgProfil);
					
					$description = \Auther\MotorTemplate::cP("description", $row["description"]);

					$sendCommentEditText = \Auther\MotorTemplate::cInput("sendCommentEditText", "text", "", "sendCommentEditText", "commenter", "");
					$sendCommentSubmitButton = \Auther\MotorTemplate::cInput("sendCommentSubmitButton", "submit", "Go", "sendCommentSubmitButton", "", "");

					$sendCommentHiddenPostId = \Auther\MotorTemplate::cInput("sendCommentHiddenPostId", "hidden", $row['post_id'], "sendCommentHiddenPostId", "", "");

					$formSendComment = \Auther\MotorTemplate::cForm("formSendComment","POST", $action . "#" . $row["post_id"], $sendCommentEditText . $sendCommentSubmitButton . $sendCommentHiddenPostId);
					
					$divHead = \Auther\MotorTemplate::cDiv("", "divHead", $imgProfilP . $date . $pseudo . $title);
					$divImg = \Auther\MotorTemplate::cDiv("", "divImg", self::chargeImgPost($row["post_id"]));
					$divCom = \Auther\MotorTemplate::cDiv("", "divCom", self::chargeComPost($row["post_id"], 15));


					$divLeft = \Auther\MotorTemplate::cDiv("", "divLeft", $divHead . $description . $divImg);
					$divRight = \Auther\MotorTemplate::cDiv("", "divRight", $formSendComment . $divCom);

					$suppress = "";
					$suppressJs = "";

					// dans le cas où userId n'est pas null, on ajoutera les êlements qui permettront la suppression d'un post et le Js qui permettra d'avoir des boutons dynamiques //

					if($userId!=null){

						require("HiddenPhp/SuppressPost.php");

						$suppress = \Auther\MotorTemplate::tagReplace("post_id", $row["post_id"], $suppressElements);

						$suppressJs = \Auther\MotorTemplate::cJavascript(
							\Auther\MotorTemplate::tagReplace("post_id", $row["post_id"],
							 file_get_contents("../JsFolder/SuppressPost.js")));

					}

					$divPost = \Auther\MotorTemplate::cDiv($row["post_id"], "divPost", $divLeft . $divRight . $suppress . $suppressJs);

					$content = $content . $divPost;

					}
					
			$query->closeCursor();
			return $content;


		}
		$query->closeCursor();
		return $content;
	}

	// cette fonction ne sera pas utilisée dans le projet //

	static function chargeImgPost($postId){

		$content = "";

		$query = \Database\Db::getInstance()->prepare("SELECT * FROM imgPost WHERE fk_post_id = :fk_post_id");

		if($query){
			$query->execute(array("fk_post_id"=>$postId));

				while($row = $query->fetch()){

				}
				$query->closeCursor();
				return $content;
		}
		$query->closeCursor();
		return $content;

	}

	// récupération de tous les commmentaires pour chaque post //

	static function chargeComPost($postId, $nbr){

		$content = "";

		$query = \Database\Db::getInstance()->prepare("SELECT c.content, u.pseudo, u.url_img_profil FROM comments AS c LEFT JOIN users AS u ON (c.fk_user_id = u.user_id) WHERE c.fk_post_id = :fk_post_id LIMIT :nbr");

		if(!$query==null){

			$query->bindParam("fk_post_id", $postId, \PDO::PARAM_INT);
			$query->bindParam("nbr", $nbr, \PDO::PARAM_INT);
			$query->execute();


				while($row = $query->fetch()){

					if($row["url_img_profil"]==null || $row["url_img_profil"]=="" || !file_exists($row["url_img_profil"])){

					$imgProfil = \Auther\MotorTemplate::cImage("../Img/avatar.png", "imgProfilComment");

					}else{

					$imgProfil = \Auther\MotorTemplate::cImage($row["url_img_profil"], "imgProfilComment");

					}

					$imgProfilP = \Auther\MotorTemplate::cP("imgProfilCommentP", $imgProfil);

					$pseudo = \Auther\MotorTemplate::cP("pseudo", $row["pseudo"]);

					$text = \Auther\MotorTemplate::cP("text", $row["content"]);

					$divHead = \Auther\MotorTemplate::cDiv("", "divHeadComment", $imgProfilP . $pseudo);

					$content = $content. \Auther\MotorTemplate::cDiv("", "divComment", $divHead. $text);

				}
				$query->closeCursor();
				return $content;
		}
		$query->closeCursor();
		return $content;

	}
}


?>