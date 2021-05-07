<?php
namespace Auther;
class Cache{

	private static $FOLDER_CACHE_NAME = '../HtmlFolder/Cache';
	private $time = null;
	private $hashName;

	function __construct($serverName, $fileName, $time){
		$this->verifyCacheFolderExists();
		$serverName = str_replace("\\", "/", $serverName);
		$serverNameSplit = explode("/", $serverName);
		$serverName = $serverNameSplit[0] . $serverNameSplit[1]. $serverNameSplit[2];
		$this->hashName = md5($serverName . $fileName);
		$this->time = $time;
		

	}

	public function getPathCache(){
		return self::$FOLDER_CACHE_NAME . "/" . $this->hashName;

	}
	private function verifyCacheFolderExists(){
		if (!file_exists(self::$FOLDER_CACHE_NAME)) {
			mkdir(self::$FOLDER_CACHE_NAME);
		}
	}

	public function verifyCacheFileExists(){
		if(file_exists(self::$FOLDER_CACHE_NAME . "/" . $this->hashName)){
			return $this->time + filemtime(self::$FOLDER_CACHE_NAME . "/" . $this->hashName) > time();
		}else 
			return false;
	}



	static function createOrRechargePage($serverName, $fileName){

	}

	public function setContent($content){
		$f = fopen(self::$FOLDER_CACHE_NAME . "/" . $this->hashName, "w");
		fwrite($f, $content);
		fclose($f);
	}

	public function getContent(){
		return file_get_contents(self::$FOLDER_CACHE_NAME . "/" . $this->hashName);
	}
}
?>