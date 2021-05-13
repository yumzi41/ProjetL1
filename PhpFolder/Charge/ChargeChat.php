<?php
// La classe ChargeChat centralise les fonctions qui récuperent les données en rapport avec le chat //
namespace Charge;
class ChargeChat{

	
	// Dans cette fonction il fallait récupérer une variable lors de l'affichage d'une première partie puis récupérer cette partie dans l'affichage d'une seconde partie, c'est pour cela que j'ai utilisé deux mises en mémoire tampon grâce à ob_start() et ob_get_clean(, enfin on modifie la variable passée en paramêtre pour lui transmettre toutes les données chargées. De plus, j'y ai ajouté les traitements des formulaires qui permettront l'ajout et la suppression de certains messages //
	
	static function chargeChatSection(&$contentUserInterfaceMiddle, $default, $nbr){

		\Auther\Verify::verifSessionExists();

		\Treatment\MessageTreatment::treatment();

		\Treatment\SuppressMessageTreatment::treatment();

		ob_start();

		ob_start();

		require(self::chargeCacheOrNewAllMessages($nbr));

		$contentAllMessages = ob_get_clean();

		require(self::chargeCacheOrNewMainDiv($default));

		$contentUserInterfaceMiddle = ob_get_clean();


	}
 	// Cette fonction chargera chaque message

	static function chargeMessage($userId, $urlImgProfil, $pseudo, $date, $content, $messageId){

		$class = "divMessage";

		$pseudoP = \Auther\MotorTemplate::cP("pseudo", $pseudo . ", ");

		$dateP = \Auther\MotorTemplate::cP("date", "Le " . $date);

		$contentP = \Auther\MotorTemplate::cP("content", $content);

		if($urlImgProfil==null || $urlImgProfil=="" || !file_exists($urlImgProfil)){

			$imgProfil = \Auther\MotorTemplate::cImage("../Img/avatar.png","imgProfil");

		}else{

			$imgProfil = \Auther\MotorTemplate::cImage($urlImgProfil,"imgProfil");

		}

		$imgProfilP = \Auther\MotorTemplate::cP("imgProfilP", $imgProfil);
		

		$suppress = "";
		$suppressJs = "";

		if($userId==$_SESSION['user_id']){

			require("HiddenPhp/SuppressMessage.php");

			$suppress = \Auther\MotorTemplate::tagReplace("message_id", $messageId, $suppressElements);

			$pseudoP = \Auther\MotorTemplate::cP("pseudo", "---vous---");

			$suppressJs = \Auther\MotorTemplate::cJavascript(\Auther\MotorTemplate::tagReplace(
				"message_id", $messageId, file_get_contents("../JsFolder/SuppressMessage.js")));

			$class = "divPersonnalMessage";

		}

		$divHead = \Auther\MotorTemplate::cDiv("divHead", "divHead", $imgProfilP  . $pseudoP . $dateP);

		return \Auther\MotorTemplate::cDiv("divMessage" . $messageId, $class, $divHead . $contentP . $suppress . $suppressJs);

	}

	// cette fonction chargera tout les messages avec une limite que l'on pourra fixer suivant les cas //

	static function chargeAllMessages($nbr){

		$content = "";

		$query = \Database\Db::getInstance()->prepare(
			"SELECT m.message_id, m.content, m.date_publi, m.fk_user_id, u.pseudo, u.url_img_profil FROM messages AS m LEFT JOIN users AS u ON (m.fk_user_id = u.user_id) ORDER BY m.date_publi DESC LIMIT :nbr");

		$query->bindParam("nbr", $nbr, \PDO::PARAM_INT);

		if($query->execute()){

			while($row = $query->fetch()){

				$content = $content . self::chargeMessage(
					$row["fk_user_id"],
					$row["url_img_profil"],
					$row["pseudo"],
					$row["date_publi"],
					$row["content"],
					$row["message_id"]);
			}

			$query->closeCursor();
			return $content;

		}else{

			$query->closeCursor();
			return $content;
		}
	}

	// cette fonction charge le div principal de la section chat, comme les composants restent les mêmes, on effectuera une récupération cache //

	static function chargeCacheOrNewMainDiv($default){

		$cache = \Auther\Injection::getCache($_SERVER["REQUEST_URI"], "chat.php", 3600);
		
		if($cache->verifyCacheFileExists() && $default){

			return $cache->getPathCache();

		}else{

			require("HiddenPhp/Chat.php");

			$cache->setContent($body);

			return $cache->getPathCache();

		}

	}

	// cette fonction sert à récupérer ou non le cache du chat global. Je l'ai désactivé pour toujours réactualiser les messages et éviter des problêmes d'affichages //

	static function chargeCacheOrNewAllMessages($nbr){

		$cache = \Auther\Injection::getCache($_SERVER["REQUEST_URI"], "AllMessages.php" . $_SESSION["user_id"], 360000);
		
		if($cache->verifyCacheFileExists() && false){

			return $cache->getPathCache();

		}else{

		
			$cache->setContent(self::chargeAllMessages($nbr));

			return $cache->getPathCache();

		}

	}


	
}
?>