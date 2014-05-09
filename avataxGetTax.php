<?php
require('AvaTaxClasses/AvaTax.php');

$serviceURL = "************";
$accountNumber = "*******";
$licenseKey = "avalara";
	
$taxSvc = new TaxServiceRest($serviceURL, $accountNumber, $licenseKey);

$getTaxRequest = new GetTaxRequest();
// Required Request Parameters
$getTaxRequest->setCustomerCode($_POST['customerCode']);
$getTaxRequest->setDocDate($_POST['docDate']);

// Best Practice Request Parameters
$getTaxRequest->setCompanyCode($_POST['companyCode']);
$getTaxRequest->setClient($_POST['client']);
$getTaxRequest->setDocCode($_POST['docCode']);
$getTaxRequest->setDetailLevel($_POST['detailLevel']);
$getTaxRequest->setCommit($_POST['commit']);
$getTaxRequest->setDocType($_POST['docType']);

// Situational Request Parameters
$getTaxRequest->setCustomerUsageType($_POST['customerUsageType']);
$getTaxRequest->setExemptionNo($_POST['exemptionNo']);
$getTaxRequest->setDiscount($_POST['discount']);

$taxOverride = new TaxOverride(
$_POST['taxOverride']['taxOverrideType'],
$_POST['taxOverride']['taxAmount'],
$_POST['taxOverride']['taxDate'],
$_POST['taxOverride']['reason']);
$getTaxRequest->setTaxOverride($taxOverride); 

// Optional Request Parameters
$getTaxRequest->setPurchaseOrderNo($_POST['purchaseOrderNo']);
$getTaxRequest->setReferenceCode($_POST['referenceCode']);
$getTaxRequest->setPosLaneCode($_POST['posLaneCode']);
$getTaxRequest->setCurrencyCode($_POST['currencyCode']);

$lines = array();
for($i = 0; $i < count($_POST['lines']); $i++)
{
		$line = new Line();
		$line->setLineNo($_POST['lines'][$i]['lineNo']);
		$line->setItemCode($_POST['lines'][$i]['itemCode']);
		$line->setQty($_POST['lines'][$i]['qty']);
		$line->setAmount($_POST['lines'][$i]['amount']);
		$line->setOriginCode($_POST['lines'][$i]['originCode']);
		$line->setDestinationCode($_POST['lines'][$i]['destinationCode']);

		// Best Practice Request Parameters
		$line->setDescription($_POST['lines'][$i]['description']);
		$line->setTaxCode($_POST['lines'][$i]['taxCode']);

		// Situational Request Parameters
		//$line->setCustomerUsageType($_POST['lines'][$i]['customerUsageType']);
		$line->setDiscounted($_POST['lines'][$i]['discounted']);
		$line->setTaxIncluded($_POST['lines'][$i]['taxIncluded']);

/*		$lineTaxOverride = new TaxOverride(
			$postLine->taxOverride->taxOverrideType,
			$postLine->taxOverride->taxAmount,
			$postLine->taxOverride->taxDate,
			$postLine->taxOverride->reason);

		$line->setTaxOverride($lineTaxOverride);	*/	
		
		// Optional Request Parameters
		$line->setRef1($_POST['lines']['ref1']);
		$line->setRef2($_POST['lines']['ref2']);
		$lines[] = $line;				
}
$getTaxRequest->setLines($lines);

$addresses = array();

for($i = 0; $i < count($_POST['addresses']); $i++)
{


	$address = new Address();
	$address->setAddressCode($_POST['addresses'][$i]['addressCode']);
	$address->setLine1($_POST['addresses'][$i]['line1']);
	$address->setLine2($_POST['addresses'][$i]['line2']);
	$address->setLine3($_POST['addresses'][$i]['line3']);
	$address->setCity($_POST['addresses'][$i]['city']);
	$address->setRegion($_POST['addresses'][$i]['region']);
	$address->setCountry($_POST['addresses'][$i]['country']);
	$address->setPostalCode($_POST['addresses'][$i]['postalCode']);
	$address->setLongitude($_POST['addresses'][$i]['longitude']);
	$address->setLatitude($_POST['addresses'][$i]['latitude']);

	$addresses[] = $address;			
}	

$getTaxRequest->setAddresses($addresses);

$getTaxResult = $taxSvc->getTax($getTaxRequest);
echo json_encode($getTaxResult);

?>