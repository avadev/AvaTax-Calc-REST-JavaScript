<?php
require('AvaTaxClasses/AvaTax.php');

$serviceURL = "https://development.avalara.net";
$accountNumber = "account.admin.1100014690";
$licenseKey = "avalara";


/*$taxSvc = new TaxServiceRest($serviceURL, $accountNumber, $licenseKey);

$estimateTaxRequest = new EstimateTaxRequest($_POST['latitude'], $_POST['longitude'], $_POST['saleAmount']);

$geoTaxResult = $taxSvc->estimateTax($estimateTaxRequest);
echo json_encode($geoTaxResult);
*/

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