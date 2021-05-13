<?php

// Au départ je pensais que la notion d'injection allait me servir à organiser le code, mais au final elle ne m'a pas servi //
namespace Auther;
class Injection{

	static function getInstanceDb(){
		return \Database\Db::getInstance();
	}

	static function getLoginTreatment(){
		return new \Treatment\LoginTreatment();

	}
	static function getRegisterTreatment(){
		return new \Treatment\RegisterTreatment();

	}

	static function getMotorTemplate(){
		return new MotorTemplate();
	}

	static function getCache($serverName, $fileName, $time){
		return new Cache($serverName, $fileName, $time);
	}

	static function getVerify(){
		return new Verify();
	}

}
?>