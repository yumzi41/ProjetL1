<?php

		$loginResponse = null;

		\Treatment\LoginTreatment::treatment($loginResponse);

		session_destroy();

		require Charge\Charge::chargeCacheOrNewWithModel($_SERVER["REQUEST_URI"], "login.php", 3600, "HiddenPhp/Login.php", "../HtmlFolder/index.html", "StudHelp.com-login", "../CssFolder/Portal.css", $default);
?>