<?php
session_destroy();
require Charge\Charge::chargeCacheOrNewWithModel($_SERVER["REQUEST_URI"], "disconnect.php", 36000, "HiddenPhp/Disconnect.php", "../HtmlFolder/index.html", "StudHelp.com-diconnect", "../CssFolder/Portal.css", $default);

?>