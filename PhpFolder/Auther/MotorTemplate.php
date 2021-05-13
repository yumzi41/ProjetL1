<?php

// MotorTemplate permet de transformer le html en programmation orientée objet qui rendra le code bien plus lisible //

namespace Auther;
class MotorTemplate{

	static function tagReplace($tag, $content, $htmlContent){
		return str_replace("[[". $tag . "]]", $content, $htmlContent);
	}
	static function cDiv($id, $class, $element){
		return "<div id='{$id}' class='{$class}'>" . $element . "</div>";
	}
	static function cInput($name, $type, $value, $class, $placeholder, $pattern){

		if($pattern==""|| $pattern==null){

		return "<input type='{$type}' 
		name='{$name}' 
		value='{$value}' 
		class='{$class}'
		pattern='?'
		placeholder='{$placeholder}'
		/>";


		}else{

		return "<input type='{$type}' 
		name='{$name}' 
		value='{$value}' 
		class='{$class}' 
		placeholder='{$placeholder}'
		pattern='{$pattern}'
		required='true' />";
	}
}

	static function cTextarea($class, $name, $placeholder, $rows, $columns, $pattern, $value){
		return "<textarea class='{$class}' name='{$name}' rows='{$rows}' placeholder='{$placeholder}' cols='{$columns}' pattern='{$pattern}'>{$value}</textarea>";
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

	static function cFormWithId($id, $class, $method, $action, $element){
		return "<form 
		id='{$id}'
		class='{$class}'
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

	static function cChangeStyleJs($id, $style, $value){
		return "document.getElementById('{$id}').style.{$style} = '{$value}';";
	}

	static function cOnClick($id, $function){
		return "document.getElementById('{$id}').onclick = function(){{$function}}";
	}

	static function cButton($id, $class, $value){
		return "<button id='{$id}' type='button' class='{$class}'> {$value} </button>";
	}
}
?>