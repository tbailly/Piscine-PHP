<?php

$data = file_get_contents("../img/42.png");
$image_base64 = 'data:image/png;base64,' . base64_encode($data);

if ($_SERVER && isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"]) &&
	$_SERVER['PHP_AUTH_USER'] === "zaz" && $_SERVER['PHP_AUTH_PW'] === "jaimelespetitsponeys")
	echo "<html><body>Bonjour Zaz<br /><img src='" . $image_base64 . "'></body></html>\n";
else
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";

?>
