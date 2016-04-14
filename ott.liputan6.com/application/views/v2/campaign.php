<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/cart-step.css" type="text/css" media="screen" />


<script type="text/javascript" language="javascript">
mixpanel.track("Buy page");
</script>
<?php
$campaign_id = $campaign[0]['campaign_id'];
?>
<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/validation.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.validate.1.10.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.cookie.js"></script>
<form id="frmProfile" name="frmProfile" action="<?= site_url("/campaign/submit_buy/$slug"); ?>" method="post">

<div class="cart-header-wrap">
    <div class="cart-page-header">
    <div class="cart-steps">
        <a id="button1" class="cart-no-deco cart-bind-cicode" href="#">
          <div class="cart-step-wrap cart-step-1">
              <div class="cart-step-line-inactive"></div>
              <div class="cart-step-active step1">1</div>
              <div class="cart-step-text-active step2">Paket Livestreaming</div>
          </div>
        </a>
        <a id="button2" class="cart-no-deco cart-bind-cicode" href="#">
          <div class="cart-step-wrap cart-step-2">
              <div class="cart-step-line-inactive"></div>
              <div class="cart-step-inactive step1">2</div>
              <div class="cart-step-text-inactive step2">Data Pribadi</div>
          </div>
        </a>
        <a id="button3" class="cart-no-deco cart-bind-cicode" href="#">
        <div class="cart-step-wrap cart-step-3">
            <div class="cart-step-line-inactive"></div>
            <div class="cart-step-inactive step1">3</div>
            <div class="cart-step-text-inactive step2">Bayar</div>
        </div>
        </a>
        <? /* <a id="button4" class="cart-no-deco cart-bind-cicode" href="#"> */ ?>
        <div class="cart-step-wrap cart-step-4">
            <div class="cart-step-inactive step1">4</div>
            <div class="cart-step-text-inactive step2">Thank You</div>
        </div>
        <? /* </a> */ ?>
    </div>
  </div>
</div>

<div id="tab1" style="display:block">
  <div id="paket-livestreaming">
  <?php $i=0; foreach($campaign as $row) : ?>

    <div id="paket-livestreaming-inside" class="fl<?=$i>0?' ml40':''?>">
      <div class="title"><?=$row['package_name']?></div>
      <div class="isi">
        <div class="scroll">
          <table width="285" border="0" cellspacing="2" cellpadding="2">
            <?php foreach ($row['matches'] as $key => $match) : ?>
                  <!-- Start Here -->
                  <tr data-match_id='<?= $match['match_id'] ?>'>
                      <?php $localTime = local_from_utc($match['date_utc'],$match['time_utc'])?>
                      <td width="65" align="center"><a class="team-<?php echo $match['team_A_id'] ?>"></a></td>
                      <td width="65" align="center"><span style="font-size:11px"><?= $localTime->format('Y-m-d') ?></span><br>
                          <span style="font-weight:bold"><?php echo $match['team_A_tla'] ?></span></td>
                      <td width="26" align="center"><span style="font-weight:bold; color:#FF0000">VS</span></td>
                      <td width="62" align="center"><span style="font-size:11px"><?= $localTime->format('H:i:s') ?></span><br>
                          <span style="font-weight:bold"><?php echo $match['team_B_tla'] ?></span></td>
                      <td width="67" align="center"><a class="team-<?php echo $match['team_B_id'] ?>"></a></td>
                  </tr>
                  <tr><td colspan="5" align="center" id="line4">&nbsp;</td></tr>
                  <!-- End Here -->
            <?php endforeach ?>
          </table>
        </div>

        <div class="harga"><?=format_rupiah($row['price'])?> IDR</div>
        <div class="pilihpaket">
          <input class="price_list" id="price_list<?=$row['id']?>" type="checkbox" name="package[]" value="<?=$row['id']?>" onclick="set_price(<?=$row['id']?>)" />
          <input type="hidden" id="price<?=$row['id']?>" name="price<?=$row['id']?>" value="<?=$row['price']?>" />
          <label for="price_list<?=$row['id']?>">Pilih Paket</label>
        </div>
      </div>
    </div>
  <?php $i++; endforeach ?>
    <div class="cb"></div>
    <div id="kupon">
      Anda dapat menyaksikan secara gratis paket ini dengan memasukan kode diskon:<br><br><span style="color: #009900">AYOONOBAR</span><br>
      <input type="text" class="code" id="discount_code" name="discount_code" />
      <input type="button" id="btn_discount_code" name="submitcode" value="Apply" onclick="check_discount_code()" />
    </div>

    <div class="cb"></div>
    <div id="total">TOTAL PAKET : Rp <span id="total_amount"></span></div>
    <input class="bayar" type="button" value="NEXT" id="next1">
    <div class="cb"></div>
  </div>

</div>

<div id="tab2" style="display:none">
  <div id="paket-livestreaming">
  <?php
      $sess_profile = $this->session->userdata('kmk_member_profile');

      $name_arr = explode(' ', $sess['full_name']);
      if (count($name_arr) > 0) {
        $first_name = $name_arr[0];
        $last_name  = isset($name_arr[1])?$name_arr[1]:'';
      } else {
        $first_name = $sess['full_name'];
        $last_name  = '';
      }

      $email = (isset($sess['email'])) ? $sess['email'] : '';
  ?>
    <div class="form">
      <table width="800" border="0" cellspacing="5" cellpadding="5">
          <tr>
              <td width="179">Nama</td>
              <td width="9">:</td>
              <td width="362"><input type="text" id="first_name" name="first_name" value="<?=$sess['full_name']?>" class="required text-1"></td>
          </tr>
          <tr>
              <td>Handphone</td>
              <td>:</td>
              <td><input type="text" name="phone" id="phone" maxlength="12" class="required number text-1" value="<?=isset($sess_profile['phone'])?$sess_profile['phone']:''?>"/></td>
          </tr>
          <tr>
              <td valign="top">Alamat</td>
              <td valign="top">:</td>
              <td><textarea id="address" name="address" class="required text-1" cols="45" rows="5"><?=isset($sess_profile['address'])?$sess_profile['address']:''?></textarea></td>
          </tr>
          <tr>
              <td>Email</td>
              <td>:</td>
              <td>
                <?php if ($sess['source'] == 'twitter') : ?>
                <input type="text" name="email" id="email" class="required text-1" value="<?=$email?>" />
                <?php else : ?>
                  <?=$email?>
                  <input type="hidden" name="email" id="email" class="required text-1" value="<?=$email?>" />
                <?php endif ?>
              </td>
          </tr>
      </table>
    </div>
    <div class="cb"></div>
    <input class="bayar" type="button" value="NEXT" id="next2">
    <div class="cb"></div>
  </div>
</div>

<div id="tab3" style="display:none">
  <div id="paket-livestreaming">
    <div class="form">
          <table cellpadding="0" cellspacing="0" class="payment">
            <tr>
              <td valign="top" style="width:400px">
                <h3>Pembayaran VISA/MASTER</h3>
                <input id="visa" class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="01" checked />
                <label for="visa"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-visa.jpg" width="56" height="34" alt="" /><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-mastercard.gif" width="53" height="34" alt="" /></label>
              </td>

              <!--td valign="top">
               <h3>Bank Transfer (ATM, Internet, Mobile Transfer)</h3>
                <input id="bca" class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="bca">
                <label for="bca"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bca.png"></label>
                <input id="mandiri" class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="mandiri">
                <label for="mandiri"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/mandiri.png"></label>
                <input id="bni" class="payment_channel" type="radio" name="PAYMENTCHANNEL" value="bni">
                <label for="bni"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bni.png"></label>
              </td-->

            </tr>

            </table>
      <br/>
      <input id="accept_terms_and_conditions" type="checkbox" class="setuju" /><label for="accept_terms_and_conditions">Saya sudah membaca dan setuju mengenai <a href="<?=site_url('terms-and-condition')?>" target="_blank">Terms & Conditions</a></label>
    </div>
    <div class="cb"></div>
    <input class="bayar" type="submit" value="BAYAR">
    <div class="cb"></div>
  </div>
</div>

<div id="tab4" style="display:none">
  <div id="paket-livestreaming">
    <span style="font-size:20px; color:#FF0000; font-weight:bold; padding-left:130px">Thank you, we will process your request</span>
    <div class="cb"></div>
    <input class="bayar" type="button" value="FINISH" id="finish">
    <div class="cb"></div>
  </div>
</div>

    <input type="hidden" id="disc_type" name="disc_type" />
    <input type="hidden" id="disc_value" name="disc_value" />
    <input type="hidden" id="disc_global" name="disc_global" />
    <input type="hidden" id="campaign_id" name="campaign_id" value="<?=$campaign_id?>" />

    <input type="hidden" id="unic_code" name="unic_code" />

</form>



    <script type="text/javascript">
    $(function() {
        $("#frmProfile").validate({
          rules: {
            email: {required: true, email: true},
            code: { required: true },
            first_name: { required: true },
            address: { required: true },
            phone: { required: true }
          },
          messages: {
            first_name: "* Nama tidak boleh kosong",
            phone: {
              required : "* No telpon tidak boleh kosong",
              number : "* No telpon harus diisi dengan angka"
            },
            email: "* Masukan email dengan valid",
            address: "* Alamat tidak boleh kosong"
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
                        if (obj.message == 'Choose One Package') {
                          $('#button1').click();
                        }
                }
            });
          }
        });

        $('#next1, #button2').click(function(){
          if ($("#frmProfile").valid()) {
            $('#tab1').hide(); $('#tab2').show(); $('#tab3').hide(); $('#tab4').hide();
            clearClass();
            $('#button2 .step1').addClass('cart-step-active').removeClass("cart-step-inactive");
            $('#button2 .step2').addClass('cart-step-text-active').removeClass("cart-step-text-inactive");
          }
          return false;
        });
        $('#next2, #button3').click(function(){
          if ($("#frmProfile").valid()) {
            $('#tab1').hide(); $('#tab2').hide(); $('#tab3').show(); $('#tab4').hide();
            clearClass();
            $('#button3 .step1').addClass('cart-step-active').removeClass("cart-step-inactive");
            $('#button3 .step2').addClass('cart-step-text-active').removeClass("cart-step-text-inactive");
          }
          return false;
        });
        $('#button4').click(function(){
          if ($("#frmProfile").valid()) {
            $('#tab1').hide(); $('#tab2').hide(); $('#tab3').hide(); $('#tab4').show();
            clearClass();
            $('#button4 .step1').addClass('cart-step-active').removeClass("cart-step-inactive");
            $('#button4 .step2').addClass('cart-step-text-active').removeClass("cart-step-text-inactive");
          }
          return false;
        });

        $('#button1').click(function(){
          $('#tab1').show(); $('#tab2').hide(); $('#tab3').hide(); $('#tab4').hide();
          clearClass();
          $('#button1 .step1').addClass('cart-step-active').removeClass("cart-step-inactive");
          $('#button1 .step2').addClass('cart-step-text-active').removeClass("cart-step-text-inactive");
          return false;
        });

        $('#finish').click(function(){
          window.location.href="<?=site_url('pertandingan')?>";
        });
    });

    function clearClass(){
      $(".step1").each(function() {
        $(this).removeClass("cart-step-active");
        $(this).addClass("cart-step-inactive");
      });
      $(".step2").each(function() {
        $(this).removeClass("cart-step-text-active");
        $(this).addClass("cart-step-text-inactive");
      });
    }

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
        //console.log("The coookie price = ", cookie_price);

        $.cookie('cookie_price', cookie_price, { expires: 1, path: '/' });

        var diskon_value = $("#disc_value").val();
        if (total_price > 0 && diskon_value != '') {
            diskon_price = (diskon_value/100) * total_price;
            total_price  = total_price - diskon_price;
        }
        //console.log("Discon price = ", diskon_value);
        //console.log("Total price = ", total_price);

        $("#total_amount").html(total_price.formatMoney(2,',','.'));
        $("#detail_paket").html('Rp. '+total_price.formatMoney(2,',','.'));

        if(parseFloat(total_price) > 0){
            $(".payment").show();
        }else{
            $(".payment").hide();
        }

        $.get("<?=site_url('campaign/unic_code')?>", function( data ) {
          $("#unic_code").val( data );
          $("#detail_unic").html( data );
          var temp = total_price + parseInt(data);
          $("#detail_total").html('Rp. '+temp.formatMoney(2,',','.'));
        });

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

