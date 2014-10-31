(function (win) {
	
	var AVATAX_URL = 'AvaTax.php';
	
	function formEncodeURIComponent (str) {
		return encodeURIComponent(str).replace('%20','+');
	}
	
	function uriSerialize(params, inForm) {
		var paramsArr = [],
			encoder = inForm ? formEncodeURIComponent : encodeURIComponent;
		for(var i in params) {
			paramsArr.push( encoder(i)+'='+encoder(params[i]) )
		}
		return paramsArr.join('&');
	}
	
	function post(params, cb) {
		var xhr = new XMLHttpRequest(),
			data;
		
		xhr.open('POST', AVATAX_URL, true);
		xhr.onload = function () {
			if(xhr.status < 400) {
				cb(JSON.parse(xhr.responseText));
			} else {
				// There is no error handling in the code as it stands
				// For backward compatibility, do nothing here for now
			}
		};
		if(FormData) {
			data = new FormData();
			for(var i in params) {
				data.append( i, params[i] );
			}
		} else {
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			data = uriSerialize(params, true);
		}
		xhr.send(data);
	}
	
	function EstimateTax(geoTaxRequest, callback) {
		var uri = "tax/" +
			geoTaxRequest.latitude + "," + geoTaxRequest.longitude +
			"/get?" + "saleamount=" + geoTaxRequest.saleAmount;
		post({
				uri: uri,
				method: "GET"
			}, callback);
	}
	function Ping(callback) {
		EstimateTax({
				latitude: 47.627935 ,
				longitude: -122.51702,
				saleAmount: 10
				} , callback);
	}
	function CancelTax(cancelTaxRequest, callback) {
		var uri = "tax/cancel",
			request = JSON.stringify(cancelTaxRequest);
		
		post({
				request: request,
				uri: uri,
				method: "POST"
			}, function(response) {
				if("CancelTaxResult" in response){
					callback(response.CancelTaxResult);
				} else{
					callback(response);
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
		post({
				request: request,
				uri: uri,
				method: "POST"
			}, callback);
	}
	
	function ValidateAddress(address, callback) {
		var uri = "address/validate?" + uriSerialize(address, false);
		post({
				uri: uri,
				method: "GET"
			}, callback);
	}
	
	win.EstimateTax = EstimateTax;
	win.Ping = Ping;
	win.CancelTax = CancelTax;
	win.GetTax = GetTax;
	win.ValidateAddress = ValidateAddress;
})(this);