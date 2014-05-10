<?php
$serviceURL = "https://development.avalara.net";
$accountNumber = "1234567890";
$licenseKey = "A1B2C3D4E5F6G7H8";

$uri = $_POST['uri'];
$method = $_POST['method'];
$request = $_POST['request']; 

$url = $serviceURL . "/1.0/" . $uri;
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $accountNumber . ":" . $licenseKey);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

if ($method == 'POST')
{
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $request); 
}

$curl_response = curl_exec($curl);
curl_close($curl);
echo $curl_response;	

?>