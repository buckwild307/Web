<?php

if (php_sapi_name() === 'cli') {
	$file = $argv[1];
	$hashexec = "php --file sha1.php " . $file;

	if ($argv[4] === 'Linux') {
		$sizeexec = "stat --format=%s " . $file;
	} else {
		$sizeexec = "stat -f %z " . $file;
	}

	if ($argv[3] === "Bootstrap") {
		$filename = "Bootstrap-v" . $argv[2] . ".jar";
	} else if ($argv[3] === "Client") {
		$filename = "Client-v" . $argv[2] . ".jar";
	} else {
		echo 'Invalid Argument 3 (' . $argv[3] . ')';
		exit();
	}

	$json = array("hash" => exec($hashexec),
				  "size" => exec($sizeexec),
				  "filename" => $filename,
				  "URL" => $argv[4] . "index.php?type=" . $argv[3] . "&action=Update&version=" . $argv[2]);

	echo json_encode($json);
} else {
	echo "This command is meant to be run from the command line"; exit();
}