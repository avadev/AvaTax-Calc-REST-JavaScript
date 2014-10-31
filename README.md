AvaTax-REST-JavaScript
=====================
[Other Samples](http://developer.avalara.com/api-docs/api-sample-code)

This is a barebones JavaScript sample demonstrating the [AvaTax REST API](http://developer.avalara.com/api-docs/rest) methods:
 [tax/get POST](http://developer.avalara.com/api-docs/rest/tax/post/), [tax/get GET](http://developer.avalara.com/api-docs/rest/tax/get), [tax/cancel POST](http://developer.avalara.com/api-docs/rest/tax/cancel), and [address/validate GET](http://developer.avalara.com/api-docs/rest/address-validation). Calculation output is minimally parsed and output to the browser. 
 
 For more information on the use of these methods and the AvaTax product, please visit our [developer site](http://developer.avalara.com/) or [homepage](http://www.avalara.com/)
 
Dependencies:
-----------
- PHP 5.0 or later


Requirements:
----------
- Authentication requires an valid **Account Number** and **License Key**, which should be entered in AvaTax.php
- If you do not have an AvaTax account, a free trial account can be acquired through our [developer site](http://developer.avalara.com/api-get-started)
 

Contents:
----------
 
<table>
<th colspan="2" align=left>Sample Files</th>
<tr><td>CancelTaxTest.html</td><td>Demonstrates the <a href="http://developer.avalara.com/api-docs/rest/tax/cancel">CancelTax</a> method used to <a href="http://developer.avalara.com/api-docs/api-reference/canceltax">void a document</a>.</td></tr>
<tr><td>EstimateTaxTest.html</td><td>Demonstrates the <a href="http://developer.avalara.com/api-docs/rest/tax/get">EstimateTax</a> method used for product- and line- indifferent tax estimates.</td></tr>
<tr><td>GetTaxTest.html</td><td>Demonstrates the <a href="http://developer.avalara.com/api-docs/rest/tax/post">GetTax</a> method used for product- and line- specific <a href="http://developer.avalara.com/api-docs/api-reference/gettax">calculation</a>.</td></tr>
<tr><td>PingTest.html</td><td>Uses a hardcoded EstimateTax call to test connectivity and credential information.</td></tr>
<tr><td>ValidateAddressTest.html</td><td>Demonstrates the <a href="http://developer.avalara.com/api-docs/rest/address-validation">ValidateAddress</a> method to <a href="http://developer.avalara.com/api-docs/api-reference/address-validation">normalize an address</a>.</td></tr>
<th colspan="2" align=left>Other Files</th>
<tr><td>AvaTax.js</td><td>Contains the core classes and builds method-specific URIs, etc to call the service with AvaTax.php.</td></tr>
<tr><td>AvaTax.php</td><td>Provides a server-side php proxy to make the service calls, contains the AvaTax account credentials used for all calls.</td></tr>
<tr><td>.gitattributes</td><td>-</td></tr>
<tr><td>.gitignore</td><td>-</td></tr>
<tr><td>LICENSE.md</td><td>-</td></tr>
<tr><td>README.md</td><td>-</td></tr>
</table>

