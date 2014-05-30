function EstimateTax(geoTaxRequest, callback) {
	var uri = "tax/" + 
		geoTaxRequest.latitude + "," + geoTaxRequest.longitude + 
		"/get?" + "saleamount=" + geoTaxRequest.saleAmount;
	$.ajax({
	    url: 'avatax.php',
	    type: 'POST',
		data: {
			uri: uri,
			method: "GET"
		},
	    success: function(response) {
			callback(JSON.parse(response));
		}
	});
}
function Ping(callback) {
	EstimateTax({
			latitude: 47.627935 ,
			longitude: -122.51702,
			saleAmount: 10
			} , callback);
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
		}
	});		
}

function GetTax(getTaxRequest, callback) {
	var uri = "tax/get";	
	if("client" in getTaxRequest){
		var Client = getTaxRequest.client;
		delete getTaxRequest['client'];
		getTaxRequest['Client'] = Client;		
	}	
	var request = JSON.stringify(getTaxRequest);
	$.ajax({
	    url: 'avatax.php',
	    type: 'POST',
		data: {
			request: request,
			uri: uri,
			method: "POST"
		},
	    success: function(response) {
			callback(JSON.parse(response));
		}
	});	
}

function ValidateAddress(address, callback) {
	var uri = "address/validate?" + jQuery.param(address);
	$.ajax({
	    url: 'avatax.php',
	    type: 'POST',
		data: {
			uri: uri,
			method: "GET"
		},
	    success: function(response) {
			callback(JSON.parse(response));
		}
	});	
}
