<?php
		
	require Charge\Charge::chargeCacheOrNewWithModel($_SERVER["REQUEST_URI"], "home.php", 3600, "HiddenPhp/Home.php", "../HtmlFolder/index.html", "home", "../CssFolder/Portal.css", $default);
	
?>