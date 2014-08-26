<?php

if (!function_exists('getallheaders')) 
{ 
    function getallheaders() 
    { 
       $headers = '';
       foreach ($_SERVER as $name => $value) if (substr($name, 0, 5) == 'HTTP_') $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
       return $headers; 
    } 
} 

$request_headers = getallheaders();
$response = array("Access" => "Denied");
$is_json = true;

if ($request_headers["Accept"] === "Application/JGame/UserAuth;") {
  $response["Access"] = "Granted";
  require_once 'private/auth.php';
} else if (true || $request_headers["Accept"] === "Application/JGame/Update;") {
  $response["Access"] = "Granted";
  require_once 'private/updater.php';
}

if ($is_json) {
    header("Content-Type: text/json;");
    echo json_encode($response);
    echo "\n";
} else {
    header("Content-Type: application/zip");
    echo $response;
}