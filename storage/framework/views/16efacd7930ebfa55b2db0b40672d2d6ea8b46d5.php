<html>
<head>
<script src="https://www.paypalobjects.com/js/external/dg.js" type="text/javascript"></script>
</head>

<body>
	<form id="form_pp" name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"  target="PPDGFrame">
				        <input type="hidden" name="cmd" value="_donations">
				        <input type="hidden" name="return" value="http://site.com/success">
				        <input type="hidden" name="cancel_return"   value="http://site.com/cancel">
				        <input type="hidden" name="notify_url" value="http://site.com/ipn">
				        <input type="hidden" name="currency_code" value="USD">
				        <input type="hidden" name="amount" id="amount" value="100">
				        <input type="hidden" name="item_name" value="Testing">
				        <input type="hidden" name="business" value="miguelvasquezweb@gmail.com">
				        <label for="buy">Buy Now:</label>
				        <input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif">
				        </form>


<script type="text/javascript" charset="utf-8">
var embeddedPPFlow = new PAYPAL.apps.DGFlow({trigger: 'submitBtn'});
</script>
</body>

</html>
The sample above shows the functionality for a final payment page (checkout page). This sa