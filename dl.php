<?php

if ((!isset($_REQUEST["type"])) || !($_REQUEST["type"] === 'Client' || $_REQUEST["type"] === 'Bootstrap'))
{
	echo "Invalid Request";
	die();
}

chdir('private/versions/');

$cjson = file_get_contents($_REQUEST["type"] . '-Current.json');
$jraw = json_decode($cjson, true);
$file = $jraw["filename"];

header("Content-Type: Application/zip");
header("Content-Length: " . filesize($file));
header('Content-Disposition: attachment; filename="' . $_REQUEST["type"] . '.jar"');

echo file_get_contents($file);
die();