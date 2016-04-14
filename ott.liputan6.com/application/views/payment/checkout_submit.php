<?php
$txt        = $invoice['totalamount'].'708'.'2P4TxbE2jz7X'.$invoice['transidmerchant'];
$WORDS      = sha1($txt);
$action_url = (HOST == 'staging.' || HOST == 'devil.' || HOST == 'local.') ? 'http://103.10.129.17/Suite/Receive' : 'https://pay.doku.com/Suite/Receive';
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function closethisasap (){
    document.forms["MerchatPaymentPage"].submit();
}
</script>
<body onload="closethisasap();">
<form action="<?=$action_url?>" id="MerchatPaymentPage" name="MerchatPaymentPage" method="post" >
<input name="BASKET" type="hidden" id="BASKET" value="<?=$invoice['basket']?>" />
<input name="MALLID" type="hidden" id="MALLID" value="708" />
<input name="CHAINMERCHANT" type="hidden" id="CHAINMERCHANT" value="NA" />
<input name="CURRENCY" type="hidden" id="CURRENCY" value="360" size="3" maxlength="3" />
<input name="PURCHASECURRENCY" type="hidden" id="PURCHASECURRENCY" value="360" size="3" maxlength="3" />
<input name="AMOUNT" type="hidden" id="AMOUNT" value="<?=$invoice['totalamount']?>" />
<input name="PURCHASEAMOUNT" type="hidden" id="PURCHASEAMOUNT" value="<?=$invoice['totalamount']?>" />
<input name="TRANSIDMERCHANT" type="hidden" id="TRANSIDMERCHANT" value="<?=$invoice['transidmerchant']?>" />
<input type="hidden" id="WORDS" name="WORDS" value="<?=$WORDS?>" />
<input type="hidden" id="SESSIONID" name="SESSIONID" value="<?=$this->session->userdata('session_id')?>" />
<input name="REQUESTDATETIME" type="hidden" id="REQUESTDATETIME" value="<?=date("YmdHis")?>" />
<input name="PAYMENTCHANNEL" type="hidden" id="REQUESTDATETIME" value="<?=$PAYMENTCHANNEL?>" />
<input name="EMAIL" type="hidden" id="EMAIL" value="<?=$sess_profile['email']?>" size="12" />
<input name="NAME" type="hidden" id="NAME" value="<?=$sess_profile['first_name'].' '.$sess_profile['last_name']?>" size="30" maxlength="50" />
<input name="ADDRESS" type="hidden" id="ADDRESS" value="<?=$sess_profile['address']?>" size="50" maxlength="50" />
<input name="COUNTRY" type="hidden" id="COUNTRY" value="360" size="50" maxlength="50" />
<input name="STATE" type="hidden" id="STATE" value="<?=$sess_profile['nama_propinsi']?>" size="50" maxlength="50" />
<input name="CITY" type="hidden" id="CITY" value="<?=$sess_profile['nama_kabupaten_kota']?>" size="50" maxlength="50" />
<input name="PROVINCE" type="hidden" id="PROVINCE" value="<?=$sess_profile['nama_propinsi']?>" size="50" maxlength="50" />
<input name="ZIPCODE" type="hidden" id="ZIPCODE" value="<?=$sess_profile['postal_code']?>" size="6" maxlength="10" />
<input name="HOMEPHONE" type="hidden" id="HOMEPHONE" value="<?=$sess_profile['phone']?>" size="12" maxlength="20" />
<input name="MOBILEPHONE" type="hidden" id="MOBILEPHONE" value="<?=$sess_profile['phone']?>" size="12" maxlength="20" />
<input name="WORKPHONE" type="hidden" id="WORKPHONE" value="<?=$sess_profile['phone']?>" size="12" maxlength="20" />
<input name="BIRTHDATE" type="hidden" id="BIRTHDATE" value="" size="12" maxlength="8" />
</form>
</body>
</head>
</html>
