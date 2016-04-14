<div class="regis">

<h1 class="t-regis"><?php echo empty($sess) ? "login" : "Order"?></h1>
    <p class="intro"><!-- Silahkan lengkapi registrasi. --></p>

<script type="text/javascript" language="javascript">
mixpanel.track("Buy page");
</script>
<?php
$campaign_id = $campaign[0]['campaign_id'];
?>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.validate.1.10.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.cookie.js"></script>
    <form id="frmProfile" name="frmProfile" action="<?= site_url("/campaign/submit_buy/$slug"); ?>" method="post">
    <!-- start package -->
    <div class="box-package bg-grad-1">
        <h2> Paket Livestreaming</h2>
        <div class="clearit"></div>
    <?php foreach($campaign as $row) {?>

        <div class="wrap-pack">
            <div class="title"><?=$row['package_name']?></div>
            <div class="box-kickoff">
                <!-- s: scroll -->
                <div class="scroll">
                    <table width="235" cellpadding="0" cellspacing="0">
                        <?php foreach ($row['matches'] as $key => $match) { ?>
                        <!-- Start Here -->
                        <tr data-match_id='<?= $match['match_id'] ?>'>
                            <td width="50"><a class="team-<?php echo $match['team_A_id'] ?>"></a></td>
                            <td width="135">
                                <?php $localTime = local_from_utc($match['date_utc'],$match['time_utc'])?>
                                <h4><?= $localTime->format('Y-m-d') ?></h4>
                                <h5><?= $localTime->format('H:i:s') ?></h5>
                                <div class="clearit"></div>
                                <div class="match"><?php echo substr($match['team_A_name'],0,3) ?> <span>vs</span> <?php echo substr($match['team_B_name'],0,3) ?></div>
                            </td>
                            <td width="50"><a class="team-<?php echo $match['team_B_id'] ?>"></a></td>
                        </tr>
                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                        <!-- End Here -->
                       <?php } ?>
                    </table>
                </div>
                <!-- e: scroll -->
                <h3><?=format_rupiah($row['price'])?> IDR</h3>
                <div class="pilih">
                    <input class="price_list" id="price_list<?=$row['id']?>" type="checkbox" name="package[]" value="<?=$row['id']?>" onclick="set_price(<?=$row['id']?>)" />
                    <input type="hidden" id="price<?=$row['id']?>" name="price<?=$row['id']?>" value="<?=$row['price']?>" />
                    <label for="price_list<?=$row['id']?>">Pilih Paket</label>
                </div>
            </div>
        </div>

    <?php
    }
    ?>

        <div class="clearit"></div>

        <!-- s: total -->
        <table class="total" cellpadding="0" cellspacing="0">
            <!--
            <thead style="background:#010042;">
                <tr>
                    <th align="left">Paket</th>
                    <th width="100" align="center">Price</th>
                </tr>
            </thead>
            -->
            <tbody style="background:#fff;">
                <tr>
                    <td align="left">Discount</td>
                    <td align="right" id="discount">0</td>
                </tr>
            </tbody>
            <tfoot style="background:#d8dfec;">
                <tr>
                    <td align="left">Total</td>
                    <td align="right" id="total_amount">0</td>
                </tr>
            </tfoot>
        </table>
        <!-- e: total -->

        <table width="500" cellpadding="0" cellspacing="0" class="coupon">
            <tr>
                <td align="left">
                    <h2 class="teks">
                      Anda dapat menyaksikan secara gratis paket ini dengan memasukan kode diskon:
                      <em>AyooNobar</em>
                    </h2>
                    <input type="text" class="code" id="discount_code" name="discount_code" />
                    <input type="button" id="btn_discount_code" name="submitcode" value="Apply" onclick="check_discount_code()" />
                </td>

                <td></td>
            </tr>
        </table>

        <div class="clearit"></div>

    </div>
    <!-- end package -->


    <!-- start perangkat & kompatibilitas -->
   <?php $this->load->view('campaign/_devicebox'); ?>
    <!-- end & perangkat & kompatibilitas -->

    <?php
        if (empty($sess)) {
            $this->load->view('campaign/_loginbox');
        }
    ?>

<?php
    /* disable campaign/submit_buy for temporary usage */
    if ($sess['id_profile'] == '0') {
        echo '<div class="box-info bg-grad-1">';
        echo '<h2> Informasi Pelanggan</h2>';
        echo '<div class="clearit"></div>';
        //echo '<form id="frmProfile" name="frmProfile" action="'.site_url('campaign/submit_buy/'.$slug).'" method="post">';
        $this->load->view('register_form');
        echo '</div>';
    }
?>


    <!-- s: test step -->

                <!-- e: test step -->


    <div class="box-payment bg-grad-1">
		<h2>pembayaran</h2>
        <div class="clearit"></div>


        <div class="metode">
            <table cellpadding="0" cellspacing="0" class="payment">

        		<tr>
            		<td width="40"><input class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="01" checked /></td>
            		<td>
                		<h3>Pembayaran VISA/MASTER</h3>
                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-visa.jpg" width="56" height="34" alt="" /><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-mastercard.gif" width="53" height="34" alt="" />
                    </td>
                </tr>
<?php
if (isset($_GET['all_payments'])) :
?>
        		<tr>
                    <td colspan="2"><div class="bb-1"></div></td>
                </tr>

        		<tr>
            		<td width="40"><input class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="04" /></td>
            		<td>
                		<h3>Pembayaran melalui DOKU e-wallet</h3>
                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-doku.gif" width="129" height="32" alt="" />
                    </td>ents
                </tr>
        		<tr>
                		<td colspan="2"><div class="bb-1"></div></td>
                </tr>
        		<tr>
            		<td width="40"><input class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="05" /></td>
            		<td>
                    		<h3>Pembayaran Permata VA</h3>

                    </td>
                </tr>
        		<tr>
                		<td colspan="2"><div class="bb-1"></div></td>
                </tr>
        		<tr>
                		<td width="40"><input class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="06" /></td>
                		<td>
                        		<h3>Pembayaran melalui e-Pay BRI</h3>
                        		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-bripayment.jpg" width="50" height="14" alt="" />
                        </td>
                </tr>
<?php
endif;
?>
            </table>

            <!--  <input class="payment_channel" type="hidden" name="PAYMENTCHANNEL" value="07" /> -->

            <table cellpadding="0" cellspacing="0" class="buy2">
        		<tr>
            		<td width="450"><input id="accept_terms_and_conditions" type="checkbox" class="setuju" /><label for="accept_terms_and_conditions">Saya sudah membaca dan setuju mengenai <a href="<?=site_url('terms-and-condition')?>" target="_blank">Terms & Conditions</a></label></td>
                    <td width="300"><input class="bayar" type="submit" value="BAYAR" /></td></td>
                    <td><a class="home" href="<?=base_url()?>">HOME</a></td>
                </tr>
            </table>
        </div>

    </div>
    <input type="hidden" id="disc_type" name="disc_type" />
    <input type="hidden" id="disc_value" name="disc_value" />
    <input type="hidden" id="disc_global" name="disc_global" />
    <input type="hidden" id="campaign_id" name="campaign_id" value="<?=$campaign_id?>" />
    </form>
    <script type="text/javascript">
    $(function() {
        $("#frmProfile").validate({
        	rules: {
        		email: {required: true, email: true},
        		code: { required: true }
        	},
        	messages: {
        		email: "Please enter a valid email address"
        	},
        	submitHandler: function(form) {
        		$("#frmProfile").block();
            var lastSubmitFormData = null;
        		jQuery(form).ajaxSubmit({
        		    beforeSubmit: function (formData, jqForm, options) {
                        lastSubmitFormData = formData;
                        var ok = '';
                        $('input:checkbox.setuju').each(function () {
                            if (this.checked) ok = $(this).val();
                        });

                        if (ok == '') {
                            alert('Anda belum menyetujui Term Conditions');
                            $("#frmProfile").unblock();
                            return false;
                        }


                        return true;
                    },
            		success : function(data) {
            			var obj = jQuery.parseJSON(data);
                        if (obj.status == 'error') {
                            alert(obj.message);
                        } else {
                            mixpanel.track('Proceed to payment', lastSubmitFormData);
                            var pc = '';
                            $('input:radio.payment_channel').each(function () {
                                if (this.checked) pc = $(this).val();
                            });

                           window.location.href = '<?=site_url('payment/checkout_redirect')?>/' + pc;
                        }
                        $("#frmProfile").unblock();
            		}
        		});
        	}
        });
    });

    Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
        var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
        return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
    };

    function set_price(val) {
        var total_price = 0;
        var cookie_price = '';
        var i = 0;

        $('input:checkbox.price_list').each(function () {
            if (this.checked) {
                val = $(this).val();
                total_price = total_price + parseFloat($("#price"+val).val());
                cookie_price = cookie_price + val + ',';
                i++;
            }
        });

        $.cookie('cookie_price', cookie_price, { expires: 1, path: '/' });

        var diskon_value = $("#disc_value").val();
        if (total_price > 0 && diskon_value != '') {
            diskon_price = (diskon_value/100) * total_price;
            total_price  = total_price - diskon_price;
        }

        $("#total_amount").html(total_price.formatMoney(2,',','.'));

        if(parseFloat(total_price) > 0){
            $(".payment").show();
        }else{
            $(".payment").hide();
        }
    }

    function check_discount_code() {
        var code = $("#discount_code").val();
        mixpanel.track('Use discount code', {'code' : code });

        if (code == '') {

            $("#disc_type").val('');
            $("#disc_value").val('');
            $("#disc_global").val('');

            $("#discount").html('0');
            $("#discount_code").val('');

            $.cookie('cookie_diskon', $("#discount_code").val(), { expires: 1, path: '/' });
            set_price(0);

        } else {

            $("#frmProfile").block();
            $.post("<?=site_url('payment/check_discount')?>", { 'discount_code': code, 'campaign_id': '<?=$campaign_id?>' }, function(data) {
    			var obj = jQuery.parseJSON(data);
                if (obj.status == 'error') {
                    alert(obj.message);

                    $("#disc_type").val('');
                    $("#disc_value").val('');
                    $("#disc_global").val('');

                    $("#discount").html('0');
                    $("#discount_code").val('');

                } else {
                    $("#disc_type").val(obj.type);
                    $("#disc_value").val(obj.value);
                    $("#disc_global").val(obj.global);

                    $("#discount").html(obj.value + '%');
                }

                $.cookie('cookie_diskon', $("#discount_code").val(), { expires: 1, path: '/' });
                set_price(0);

                $("#frmProfile").unblock();
            });
        }
    }

    if ($.cookie('cookie_price') != undefined) {
        if ($.cookie('cookie_price') != '') {
            var price_id = $.cookie('cookie_price').split(",");
            for(i = 0; i < price_id.length - 1; i++){
                $("#price_list" + price_id[i]).attr('checked', true);
            }
        }

        if ($.cookie('cookie_diskon') != undefined && $.cookie('cookie_diskon') != '') {
            $("#discount_code").val($.cookie('cookie_diskon'));
            check_discount_code();
        } else {
            set_price(0);
        }
    }
    </script>
</div>
