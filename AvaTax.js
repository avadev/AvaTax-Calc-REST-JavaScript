function EstimateTax(geoTaxRequest, callback) {
	var uri = "tax/" + geoTaxRequest.latitude + "," + geoTaxRequest.longitude + "/get?" + "saleamount=" + geoTaxRequest.saleAmount;
	$.ajax({
	    url: 'avatax.php',
	    type: 'POST',
		data: {
			uri: uri,
			method: "GET"
		},
	    success: function(response) {
			callback(JSON.parse(response));
		}});
}

function CancelTax(cancelTaxRequest, callback) {
	var uri = "tax/cancel";
	var request = JSON.stringify(cancelTaxRequest);
	$.ajax({
	    url: 'avatax.php',
	    type: 'POST',
		data: {
			request: request,
			uri: uri,
			method: "POST"
		},
	    success: function(response) {
			if("CancelTaxResult" in JSON.parse(response)){
				callback(JSON.parse(response).CancelTaxResult);
			}
			else{
				callback(JSON.parse(response));
			}
		}});	
	
}

function GetTax(){}
function Ping(){}
function ValidateAddress(){}
