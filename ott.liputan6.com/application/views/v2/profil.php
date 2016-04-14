<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/validation.css" rel="stylesheet" type="text/css" />

<div id="content-area-rounded">
<form name="frmProfile" id="frmProfile" action="<?=site_url('profil/submit')?>" method="post">
  <table width="1000" border="0" cellspacing="8" cellpadding="8" class="box-pro">
    <tr>
        <td><span style="color:#FF0000; font-weight:bold; font-size:18px">PROFIL</span></td>
        <td>&nbsp;</td>
        <td width="399" rowspan="13" valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="4">
            <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF"><span style="font-weight:bold">CATATAN TRANSAKSI</span></td>
            </tr>

            <tr>
                <td bgcolor="#e5e5e5">
                  <div style="width:350px; height:600px; overflow:auto">
                  <table width="100%" border="0" cellspacing="3" cellpadding="3">
                    <?php
                        $i = 1;
                        foreach($history as $k => $v): if ($i>5) break;
                    ?>
                        <tr>
                                <td width="42%"><strong>Nomor Transaksi</strong></td>
                                <td width="58%"><?=$v['no_invoice']?></td>
                        </tr>
                        <tr>
                                <td><strong>Tanggal Transaksi</strong></td>
                                <td><?=date('d-M-Y', strtotime($v['tanggal_invoice']))?></td>
                        </tr>
                        <tr>
                                <td valign="top"><strong>Paket</strong></td>
                                <td>
                                <?php
                                    $detail_paket = $this->payment_model->findDetailInvoiceById($v['id_invoice']);
                                    foreach($detail_paket as $k2 => $v2):
                                ?>
                                <?=$v2['name']?><br/>
                                <?php endforeach;?>
                                </td>

                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td><a  class="fancybox" href="<?=site_url('profil/history/'.$v['no_invoice'])?>">Detail</a></td>
                        </tr>

                        <tr><td colspan="2"><div style="border-bottom:1px dashed;"></div></td></tr>
                    <?php $i++; endforeach;?>

                  </table>
                  </div>
                </td>
            </tr>

        </table></td>
    </tr>

    <tr>
        <td width="200">Nama Depan</td>
        <td><input type="text" name="first_name" class="text-1 required" value="<?=$sess_profile['first_name']?>" /></td>
    </tr>
    <tr>
        <td>Nama Belakang</td>
        <td><input type="text" name="last_name" class="text-1 required" value="<?=$sess_profile['last_name']?>" /></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email" class="text-1" value="<?=$sess_profile['email']?>" /></td>
    </tr>
    <tr>
        <td>Nomor Handphone</td>
        <td><input type="text" name="phone" maxlength="12" class="text-1 required number" value="<?=$sess_profile['phone']?>" /></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><textarea name="address" class="required"><?=$sess_profile['address']?></textarea></td>
    </tr>
    <tr>
        <td>Propinsi</td>
        <td>
                <div class="styled-select-city">
                <select name="id_propinsi" id="id_propinsi" class="required" onchange="get_kabupaten_kota(this.value, '')">
                    <option value="">-- Choose One -- </option>
                    <?php
                    foreach($mst_propinsi as $row) echo '<option value="'.$row['id_propinsi'].'"'.(($sess_profile['id_propinsi'] == $row['id_propinsi']) ? ' selected' : '').'>'.$row['nama_propinsi'].'</option>';
                    ?>
                </select>
                </div>
        </td>
    </tr>
    <tr>
        <td>Kota</td>
        <td>
                <div class="styled-select-city">
                <select name="id_kabupaten_kota" id="id_kabupaten_kota" class="required">
                    <option value="">-- Choose One -- </option>
                </select>
                </div>
        </td>
    </tr>
    <tr>
        <td>Kode Pos</td>
        <td><input type="text" name="postal_code" maxlength="5" class="text-1 required number" value="<?=$sess_profile['postal_code']?>" /></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>
            <input type="radio" name="sex" value="MALE"<?=($sess_profile['sex'] == 'MALE') ? ' checked' : ''?> /> <label>Male</label>
            <input type="radio" name="sex" value="FEMALE"<?=($sess_profile['sex'] == 'FEMALE') ? ' checked' : ''?> /> <label>Female</label>
        </td>
    </tr>
    <tr>
        <td>Umur</td>
        <td>
                <div class="styled-select-city">
                <select name="age">
                    <?php
                    for($i=17; $i<=60; $i++) echo '<option value="'.$i.'"'.(($sess_profile['age'] == $i) ? ' selected' : '').'>'.$i.'</option>';
                    ?>
                </select>
                </div>
        </td>
    </tr>

    <tr>
        <td colspan="2"><input type="checkbox" name="send_email" value="1" <?php echo ($sess_profile['send_email'] == '1')? 'checked' : ''; ?> /> Apakah Anda setuju jika kami mengirimkan email promo dan informasi pertandingan paket Kickoff ?</td>
    </tr>
<? /*
    <tr>
        <td>Team Preferance</td>
        <td>
                <!-- s: team -->
                <table cellpadding="0" cellspacing="0" class="team">
                <tr>

                <?php
                $i = 1;
                foreach ($mst_teams as $key => $row) {
                    echo '<td><input type="checkbox" name="team[]" value="'.$row['team_id'].'"'.((in_array($row['team_id'], $sess_profile['teams'])) ? ' checked' : '').' /> '.$row['club_name'].'</td>';
                    if($i++%2)
                        echo "</tr>";
                }
                ?>

                </table>

        </td>
    </tr>
*/ ?>

    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="Update Profile"></td>
        </tr>
</table>
</form>

</div>




<div class="cb">
</div>


    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.validate.1.10.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.form.min.js"></script>

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
                jQuery(form).ajaxSubmit({
                    success : function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj.status == 'error') {
                            alert(obj.message);
                        } else {
                            alert(obj.message);
                            location.reload();
                        }
                        $("#frmProfile").unblock();
                    }
                });
            }
        });
    });

    function get_kabupaten_kota(val,idx) {
        if (val != '') {
            $("#id_kabupaten_kota").block();
            $.post("<?=site_url('register/get_kabupaten_kota')?>", { 'id': val, 'id_kota': idx }, function(data) {
                $("#id_kabupaten_kota").html(data);
                $("#id_kabupaten_kota").unblock();
            });
        } else {
            $("#id_kabupaten_kota").html('<option value="">-- Choose One -- </option>');
        }
    }

    get_kabupaten_kota(<?=$sess_profile['id_propinsi']?>, <?=$sess_profile['id_kabupaten_kota']?>);
    </script>
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
            $("a[rel=example_group]").fancybox({
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'titlePosition'     : 'over',
            'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                return '' + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
        });

        $("#various1").fancybox({
            'titlePosition'     : 'inside',
            'transitionIn'      : 'none',
            'transitionOut'     : 'none'
        });

        $("#various2").fancybox();

        $(".fancybox").fancybox({
            'width'             : 690,
            'height'            : 420,
            'autoScale'         : false,
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'type'              : 'iframe'
        });
    });
</script>
