<?php

			
		$registerResponse = null;

		\Treatment\RegisterTreatment::treatment($registerResponse);

		require Charge\Charge::chargeCacheOrNewWithModel($_SERVER["REQUEST_URI"], "register.php", 3600, "HiddenPhp/register.php", "../HtmlFolder/index.html", "StudHelp.com-register", "../CssFolder/Portal.css", $default);
		

?>