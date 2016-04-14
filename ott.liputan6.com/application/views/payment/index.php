<script language="JavaScript" type="text/javascript" src="http://luna.nsiapay.com/dateformat.js"></script>
<script language="JavaScript" type="text/javascript" src="http://luna.nsiapay.com/sha-1.js"></script>
<script language="javascript" type="text/javascript">
function getRequestDateTime() {
	var now = new Date();

	document.MerchatPaymentPage.REQUESTDATETIME.value = dateFormat(now, "yyyymmddHHMMss");	
}

function randomString(STRlen) {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = STRlen;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}

	return randomstring;

}

function genInvoice() {	
	document.MerchatPaymentPage.TRANSIDMERCHANT.value = randomString(12);
}

function genSessionID() {	
	document.MerchatPaymentPage.SESSIONID.value = randomString(20);
}

function genBookingCode() {	
	document.MerchatPaymentPage.BOOKINGCODE.value = randomString(6);
}

function getWords() {

	var msg = document.MerchatPaymentPage.AMOUNT.value + document.MerchatPaymentPage.MALLID.value + "2P4TxbE2jz7X" + document.MerchatPaymentPage.TRANSIDMERCHANT.value;
	
	document.MerchatPaymentPage.WORDS.value = SHA1(msg);	
}
</script>

<form action="http://103.10.129.17/Suite/Receive" id="MerchatPaymentPage" name="MerchatPaymentPage" method="post" >
	
<table width="600" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td width="100" class="field_label">BASKET</td>
    <td width="500" class="field_input"><input name="BASKET" type="text" id="BASKET" value="Test Basket Blackberry 9850,94000.00,1,94000.00;Shipping cost,3000.00,2,6000.00" size="100" /></td>
  </tr>
  <tr>
    <td width="100" class="field_label">MALLID</td>
    <td width="500" class="field_input"><input name="MALLID" type="text" id="MALLID" value="708" size="12" /></td>
  </tr>
  <tr>
    <td width="100" class="field_label">CHAINMERCHANT</td>
    <td width="500" class="field_input"><input name="CHAINMERCHANT" type="text" id="CHAINMERCHANT" value="NA" size="12" /></td>
  </tr>
  <tr>
    <td class="field_label">CURRENCY</td>
    <td class="field_input"><input name="CURRENCY" type="text" id="CURRENCY" value="360" size="3" maxlength="3" /></td>
  </tr>
  <tr>
    <td class="field_label">PURCHASECURRENCY</td>
    <td class="field_input"><input name="PURCHASECURRENCY" type="text" id="PURCHASECURRENCY" value="360" size="3" maxlength="3" /></td>
  </tr>
  <tr>
    <td class="field_label">AMOUNT</td>
    <td class="field_input"><input name="AMOUNT" type="text" id="AMOUNT" value="100000.00" size="12" /></td>
  </tr>
  <tr>
    <td class="field_label">PURCHASEAMOUNT</td>
    <td class="field_input"><input name="PURCHASEAMOUNT" type="text" id="PURCHASEAMOUNT" value="100000.00" size="12" /></td>
  </tr>
  <tr>
    <td class="field_label">TRANSIDMERCHANT</td>
    <td class="field_input"><input name="TRANSIDMERCHANT" type="text" id="TRANSIDMERCHANT" size="16" /></td>
  </tr>
  <tr>
    <td class="field_label">WORDS</td>
    <td class="field_input"><input type="text" id="WORDS" name="WORDS"  size="60" />&nbsp;&nbsp;<input type="button" value="Generate WORDS" onClick="getWords();">&nbsp;</td>
  </tr>
  <tr>
    <td class="field_label">REQUESTDATETIME</td>
    <td class="field_input"><input name="REQUESTDATETIME" type="text" id="REQUESTDATETIME" size="14" maxlength="14" />
      (YYYYMMDDHHMMSS)</td>
  </tr>

  <tr>
    <td class="field_label">SESSIONID</td>
    <td class="field_input"><input type="text" id="SESSIONID" name="SESSIONID" /></td>
  </tr>
  <tr>
    <td class="field_label">PAYMENTCHANNEL</td>
    <td class="field_input">
                              <select name="PAYMENTCHANNEL" onchange="inputCardNumber(this[this.selectedIndex].value);">
                                <option selected="selected" value="">NONE</option>
                                <option value="01">Visa/Mastercard</option>
				<option value="04">DOKUWALLET</option>
				<option value="05">Permata VA</option>
				<option value="06">Epay BRI</option>
                              </select>
    </td>
  </tr>
  <tr>
    <td width="100" class="field_label">EMAIL</td>
    <td width="500" class="field_input"><input name="EMAIL" type="text" id="EMAIL" value="sandi@nsiapay.net" size="12" /></td>
  </tr>
  <tr>
    <td class="field_label">NAME</td>
    <td class="field_input"><input name="NAME" type="text" id="NAME" value="Sends" size="30" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">ADDRESS</td>
    <td class="field_input"><input name="ADDRESS" type="text" id="ADDRESS" value="Jl. Duren Tiga" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">COUNTRY</td>
    <td class="field_input"><input name="COUNTRY" type="text" id="COUNTRY" value="360" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">STATE</td>
    <td class="field_input"><input name="STATE" type="text" id="STATE" value="Jakarta" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">CITY</td>
    <td class="field_input"><input name="CITY" type="text" id="CITY" value="JAKARTA SELATAN" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">PROVINCE</td>
    <td class="field_input"><input name="PROVINCE" type="text" id="PROVINCE" value="JAKARTA" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="field_label">ZIPCODE</td>
    <td class="field_input"><input name="ZIPCODE" type="text" id="ZIPCODE" value="12000" size="6" maxlength="10" /></td>
  </tr>
  <tr>
    <td class="field_label">HOMEPHONE</td>
    <td class="field_input"><input name="HOMEPHONE" type="text" id="HOMEPHONE" value="0217998391" size="12" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="field_label">MOBILEPHONE</td>
    <td class="field_input"><input name="MOBILEPHONE" type="text" id="MOBILEPHONE" value="0217998391" size="12" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="field_label">WORKPHONE</td>
    <td class="field_input"><input name="WORKPHONE" type="text" id="WORKPHONE" value="0217998391" size="12" maxlength="20" /></td>
  </tr>
  <tr>
    <td class="field_label">BIRTHDATE</td>
    <td class="field_input"><input name="BIRTHDATE" type="text" id="BIRTHDATE" value="19880101" size="12" maxlength="8" /></td>
  </tr>
  <tr>
  	<td class="field_input" colspan="2">&nbsp;</td>
  </tr>
  
</table><br /><br />
<input name="submit" type="submit" class="bt_submit" id="submit" value="SUBMIT" />
</form>
<script language="javascript" type="text/javascript">

genInvoice();

getRequestDateTime();
genSessionID();

</script>