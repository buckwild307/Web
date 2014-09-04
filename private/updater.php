<?php

/*
* $response ==> Response Array
* $request_headers ==> Request Header array
*/

chdir(__DIR__ . '/versions/');

if ($_REQUEST["type"] === "Bootstrap") {
	if ($_REQUEST["action"] === "Update") {
		if (file_exists("Bootstrap-" . $_REQUEST["version"] . ".jar")) {
			header("Content-Type: application/zip");
			$is_json = false;
			$response = file_get_contents("Bootstrap-" . $_REQUEST["version"] . ".jar");
		} else {
			$response["Error"] = "Unknown Version: " . $_REQUEST["version"];
		}
	} else if ($_REQUEST["action"] === "CheckVersion") {
		$file = "Bootstrap-" . $_REQUEST["version"] . ".json";

		if (file_exists($file)) {
			$json = file_get_contents("Bootstrap-" . $_REQUEST["version"] . ".json");
			$raw = json_decode($json, true);

			if (isset($raw["hash"]) && isset($raw["size"]) && isset($raw["filename"]) && isset($raw["url"])) {
				$response["Exists"] = true;
				$response["URL"] = $raw["URL"];
				$response["FileName"] = $raw["filename"];
				$response["FileSize"] = $raw["size"];
				$response["SHA-1"] = $raw["hash"];
			} else {
				$response["Exists"] = false;
			}
		} else {
			$response["Exists"] = false;
		}
	} else {
		$response["Error"] = "Unknown Request: " . $_REQUEST["action"];
	}
} else if ($_REQUEST["type"] === "Client") {
	//
} else {
	$response["Error"] = "Unknown Update Type " . $_REQUEST["type"];
}
