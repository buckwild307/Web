<?php

/*
* add.php
* This file is a sort of php interface to the addversion.sh command
* I made this quickly, pls no h8
*/

$reqkey  = ""; // Upload "key"
$reqpass = ""; // Upload "password"
$webroot = "http://www.example.com/"; // Where to redirect on failure

if ($_REQUEST[$reqkey] === $reqpass && isset($_REQUEST["type"]) && isset($_REQUEST["version"])) {
	chdir('/home/cubition/public_html/auth/manager/');
	$cmd = "sh addversion.sh " . (($_REQUEST["type"] === "Bootstrap") ? "Bootstrap" : "Client") . ".jar " . $_REQUEST["version"] . " " . $_REQUEST["type"];
	$cmd = "stat --format=%s add.php";
} else {
	header("Location: " . $webroot);
}
                            
                            
?>
<!DOCTYPE html>
<html>
	<head><title>Add <?php echo $_REQUEST["type"] . '-v' . $_REQUEST["version"]; ?></title></head>
	<body>
		<pre><?php passthru($cmd); ?></pre>
	</body>
</html>