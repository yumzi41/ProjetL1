<?php
namespace Charge;

class Charge{

	static function chargeCacheOrNewWithModel($kserver, $kfileName, $time, $requireFile, $HtmlModel, $title, $css, $default){

		\Auther\Verify::verifUpdateMode($default);

		$cache = \Auther\Injection::getCache($kserver, $kfileName, $time);
		
		if($cache->verifyCacheFileExists() && $default){

			return $cache->getPathCache();

		//login space init

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

