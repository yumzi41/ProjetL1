<?php
namespace Auther;
class MotorTemplate{

	static function tagReplace($tag, $content, $htmlContent){
		return str_replace("[[". $tag . "]]", $content, $htmlContent);
	}
	static function cDiv($id, $class, $element){
		return "<div id='{$id}' class='{$class}'>" . $element . "</div>";
	}
	static function cInput($name, $type, $value, $class, $placeholder, $pattern){

		return "<input type='{$type}' 
		name='{$name}' 
		value='{$value}' 
		class='{$class}' 
		placeholder='{$placeholder}'
		patter={$pattern}
		required=''/>";

	}

	static function cTextarea($id, $name, $placeholder, $rows, $columns, $pattern, $value){
		return "<textarea id='{$id}' name='{$name}' rows='{$rows} cols='{$columns}' pattern='{$pattern}'></textarea>";
	}

	static function cA($class, $href, $value){
		return "<a href='{$href}' class='{$class}'> {$value} </a> ";
	}

	static function cForm($class, $method, $action, $element){
		return "<form class='{$class}' 
		method='{$method}' 
		action='{$action}'>" .
		$element . "</form>";
	}

	static function cFormImg($class, $method, $action, $element){
		return "<form class='{$class}' 
		enctype='multipart/form-data'
		method='{$method}' 
		action='{$action}'>" .
		$element . "</form>";
	}

	static function cP($class, $value){
		return "<p class='{$class}'>{$value}</p>";
	}

	static function cImage($href, $class){
		return "<img src='{$href}' class='{$class}'>";
	}

	static function cContent($name){
		return "<?= $" . $name . " ?? ''; ?>";
	}

	static function cJavaScript($script){
		return "<script> {$script} </script>";
	}

	static function cOnClick($id, $function){
		return "document.getElementById('{$id}').onclick = function(){{$function}}";
	}

	static function cButton($id, $class, $value){
		return "<button id='{$id}' class='{$class}'> {$value} </button>";
	}
}
?>