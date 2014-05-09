<?php
require('AvaTaxClasses/AvaTax.php');

$serviceURL = "https://development.avalara.net";
$accountNumber = "************";
$licenseKey = "*********";
	
$taxSvc = new TaxServiceRest($serviceURL, $accountNumber, $licenseKey);


switch ($_POST['method']){
	case 'validateAddress':
		$addressSvc = new AddressServiceRest($serviceURL, $accountNumber, $licenseKey);
		$address = new Address();
		$address->setLine1($_POST['line1']);
		$address->setLine2($_POST['line2']);
		$address->setLine3($_POST['line3']);
		$address->setCity($_POST['city']);
		$address->setRegion($_POST['region']);
		$address->setPostalCode($_POST['postalCode']);
		$address->setCountry($_POST['country']);
		$validateRequest = new ValidateRequest();
		$validateRequest->setAddress($address);
		$validateResult = $addressSvc->Validate($validateRequest);
		echo json_encode($validateResult);
	break;
	case 'ping':
		$geoTaxResult = $taxSvc->ping();
		echo json_encode($geoTaxResult);
	break;
	case 'estimateTax':
		$estimateTaxRequest = new EstimateTaxRequest($_POST['latitude'], $_POST['longitude'], $_POST['saleAmount']);
		$geoTaxResult = $taxSvc->estimateTax($estimateTaxRequest);
		echo json_encode($geoTaxResult);
	break;
	case 'cancelTax':
		$cancelTaxRequest = new CancelTaxRequest();
		$cancelTaxRequest->setCompanyCode($_POST['companyCode']);
		$cancelTaxRequest->setDocType($_POST['docType']);
		$cancelTaxRequest->setDocCode($_POST['docCode']);
		$cancelTaxRequest->setCancelCode($_POST['cancelCode']);
		$cancelTaxResult = $taxSvc->cancelTax($cancelTaxRequest);
		echo json_encode($cancelTaxResult);
	break;
	case 'getTax':

	break;
	default:
		echo "Method not found: " . $_POST['method'];
}

?>