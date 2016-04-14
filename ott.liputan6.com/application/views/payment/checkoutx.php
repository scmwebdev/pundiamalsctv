<?php
if (empty($cart)) {
    echo '<p align="center">No Packages Selected</p>';
} else {
    echo '<h2>Your Carts</h2>';
    echo '<table cellpadding="5" cellspacing="1" width="100%" style="border:1px solid #666"><tr bgcolor="#00BDFF"><td><b>Item Name</b></td><td align="center"><b>Qty</b></td><td align="right"><b>Amount</b></td></tr>';
    $total_amount = 0;
    foreach($cart as $row) {
        $total_amount += $row['price'];
        echo '<tr bgcolor="#CCF2FF"><td>'.$row['name'].'</td><td align="center">1</td><td align="right">'.format_rupiah($row['price']).'</td></tr>';
    }
    
    if (empty($discount)) {
        $discount_harga = 0;
    } else {
        $discount_harga = ($discount['type'] == 'percentage') ? ($discount['value']/100)*$total_amount : $discount['value'];
        echo '<tr bgcolor="#00BDFF"><td colspan="2" align="right"><b>Discount ('.format_rupiah($discount['value']).(($discount['type'] == 'percentage') ? '%' : ' IDR').')</b></td><td align="right"><b>-'.format_rupiah($discount_harga).'</b></td></tr>';
    }
    
    echo '<tr bgcolor="#00BDFF"><td colspan="2" align="right"><b>Total Amount</b></td><td align="right"><b>'.format_rupiah($total_amount-$discount_harga).'</b></td></tr>';
    echo '</table>';
?>

    <br/><br/>
    <form name="frmDisc" id="frmDisc" action="<?=site_url('payment/check_discount')?>" method="post">
    Discount Code : <input type="text" name="discount_code" class="required" /> <input type="submit" name="submit" value="Apply" />
    </form>
    <br/><br/>
    <form action="<?=site_url('payment/checkout_submit')?>" method="post">
        Choose Your Payment Type : 
        <input type="radio" name="PAYMENTCHANNEL" value="01" checked> Visa/Mastercard &nbsp;&nbsp; 
        <input type="radio" name="PAYMENTCHANNEL" value="04"> DOKUWALLET &nbsp;&nbsp; 
        <input type="radio" name="PAYMENTCHANNEL" value="05"> Permata VA &nbsp;&nbsp; 
        <input type="radio" name="PAYMENTCHANNEL" value="06"> Epay BRI &nbsp;&nbsp; 
        <input type="submit" name="submit" value="Pay Now" />
    </form>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.validate.1.10.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.form.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#frmDisc").validate({
        	rules: {
        		email: {required: true, email: true},
        		code: { required: true }
        	},
        	messages: {
        		email: "Please enter a valid email address"
        	},
        	submitHandler: function(form) {
        		$("#frmDisc").block();
        		jQuery(form).ajaxSubmit({
            		success : function(data) {
            			var obj = jQuery.parseJSON(data);
                        if (obj.status == 'error') {
                            alert(obj.message);
                        } else {
                            //alert(obj.message);
                            location.reload();
                        }
                        $("#frmDisc").unblock();
            		}
        		});
        	}
        });
    });
    </script>
<?
}
?>