<script type="text/javascript" language="javascript">
mixpanel.track("Confirm page");
</script>

<div id="paket-livestreaming">
  <div class="form">

  <link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/validation.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.validate.1.10.min.js"></script>
  <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.blockUI.min.js"></script>
  <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.form.min.js"></script>
  <form id="fConfirm" name="fConfirm" action="" method="post">

    <table width="600" border="0" cellspacing="5" cellpadding="5"  class="box-pro">
        <tr>
            <td colspan="3" style="color:#FF0000; font-weight:bold; font-size:16px">Info Pembayaran</td>
            </tr>
        <tr>
            <td>Nomer Rekening <?=strtoupper($row->bank_name)?></td>
            <td>:</td>
            <td>xxxx</td>
        </tr>
        <tr>
            <td>Nomer Transaksi</td>
            <td>:</td>
            <td><?=$row->no_invoice?></td>
        </tr>
        <tr valign="top">
            <td width="179">Paket yang dipilih</td>
            <td width="9">:</td>
            <td width="362">
              <?php foreach ($packages as $package) : ?>
                <?=$package->name.' ('.format_duit($package->amount).')'?><br/>
              <?php endforeach ?>
        </tr>
        <tr>
            <td>Unik Code</td>
            <td>:</td>
            <td><?=$row->unic_code?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td><?=format_duit($row->total_amount+$row->unic_code, 1)?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td valign="top"></td>
        </tr>
        <tr>
            <td colspan="3"><hr size="1" noshade></td>
            </tr>
        <tr>
            <td colspan="3" style="color:#FF0000; font-weight:bold; font-size:16px">Konfirmasi Pembayaran</td>
            </tr>
        <tr>
            <td>Nama Pemilik Rekening</td>
            <td>:</td>
            <td><input type="text" name="account_bank_name" id="account_bank_name" class="required" style="width:300px"></td>
        </tr>
        <tr>
            <td>Nama Bank</td>
            <td>&nbsp;</td>
            <td><?=strtoupper($row->bank_name)?></td>
        </tr>
        <tr>
            <td>Jumlah Transfer</td>
            <td>:</td>
            <td><input type="text" name="total_transfer" id="total_transfer" class="required" style="width:300px"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td valign="top"><span style="color:#FF0000">* Silahkan isi konfirmasi pembayaran jika sudah melakukan transfer klik &lt;SUBMIT&gt;<br>
                * Klik &lt;SUBMIT&gt; untuk menyimpan paket yang anda beli jika belum melakukan pembayaran.<br>
                * Lakukan konfirmasi setelah transfer dihalaman &quot;konfimasi pembayaran&quot; (pojok kanan atas)</span><br></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="checkbox" name="agree" id="agree" class="agree">
            <label for="agree">Saya sudah membaca dan setuju mengenai</label> <a href="<?= site_url('syarat-dan-ketentuan') ?>">Terms & Conditions</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input class="bayar" type="submit" value="SUBMIT"></td>
        </tr>
    </table>
    <input type="hidden" name="id_invoice" id="id_invoice" value="<?=$row->id_invoice?>" />
    <input type="hidden" name="no_invoice" id="no_invoice" value="<?=$row->no_invoice?>" />
  </form>
  </div>
  <div class="cb"></div>
</div>
<div style="display:none;">
<a href="<?=site_url('profil/history/')?>" id="hidden_link" class='fanci'></a>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
  $(function() {
    $("#fConfirm").validate({
      rules: {
        account_bank_name: {required: true},
        total_transfer: { required: true, number:true }
      },
      submitHandler: function(form) {
        $("#fConfirm").block();
        var lastSubmitFormData = null;
        jQuery(form).ajaxSubmit({
            beforeSubmit: function (formData, jqForm, options) {
              lastSubmitFormData = formData;
              var ok = '';
              $('input:checkbox.agree').each(function () {
                  if (this.checked) ok = $(this).val();
              });

              if (ok == '') {
                  alert('Anda belum menyetujui Term Conditions');
                  $("#fConfirm").unblock();
                  return false;
              }

              return true;
            },

            success : function(data) {
              var obj = jQuery.parseJSON(data);
              if (obj.status == 'error') {
                alert(obj.message);
              } else {
                //mixpanel.track('Proceed to payment confirm', lastSubmitFormData);
                $('#hidden_link').attr('href', '<?=site_url('profil/history')?>/'+$('#no_invoice').val());
                $("#hidden_link").fancybox({
                    'width'             : 690,
                    'height'            : 420,
                    'autoScale'         : false,
                    'transitionIn'      : 'none',
                    'transitionOut'     : 'none',
                    'type'              : 'iframe',
                    onClosed: function() {
                      window.location.href = '<?=site_url('profil/confirm')?>';
                    },
                }).trigger('click');

              }
              $("#fConfirm").unblock();
            }
        });
      }
    });

  });
</script>

