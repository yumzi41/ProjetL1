<?php

// on centralise ici le traitement de récupération du cache ou non //

namespace Charge;
class Charge{

	static function chargeCacheOrNewWithModel($kserver, $kfileName, $time, $requireFile, $HtmlModel, $title, $css, $default){

		$cache = \Auther\Injection::getCache($kserver, $kfileName, $time);
		
		if($cache->verifyCacheFileExists() && $default){

			return $cache->getPathCache();

		}else{

			require($requireFile);

			$htmlContent = file_get_contents($HtmlModel);
			$htmlContent = \Auther\MotorTemplate::tagReplace("body", $body, $htmlContent);
			$htmlContent = \Auther\MotorTemplate::tagReplace("title", $title, $htmlContent);
			$htmlContent = \Auther\MotorTemplate::tagReplace("css", $css, $htmlContent);
			$cache->setContent($htmlContent);

			return $cache->getPathCache();

		}

	}

	

} 
 ?>

