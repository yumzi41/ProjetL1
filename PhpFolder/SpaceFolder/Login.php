<?php
// loginResponse init

		$loginResponse = null;

		\Treatment\LoginTreatment::treatment($loginResponse);

		require Charge\Charge::chargeCacheOrNewWithModel($_SERVER["REQUEST_URI"], "login.php", 3600, "HiddenPhp/Login.php", "../HtmlFolder/index.html", "login", "../CssFolder/Portal.css", $default);
		

?>