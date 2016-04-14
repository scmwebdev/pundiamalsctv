<?php
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
    <table width="400" cellpadding="0" cellspacing="0" class="ml-50 mt-20 left info">
        <tr>
            <td width="120">Nama Depan : *</td>
            <td><input type="text" name="first_name" value="<?=$first_name?>" class="required text-1" /></td>
        </tr>
        <tr>
            <td>Nama Belakang : *</td>
            <td><input type="text" name="last_name" value="<?=$last_name?>" class="required text-1" /></td>
        </tr>
        <tr>
            <td>Jenis Kelamin : *</td>
            <td>
                <input type="radio" name="sex" value="MALE" checked /> Laki-laki &nbsp;&nbsp;&nbsp; 
                <input type="radio" name="sex" value="FEMALE" /> Perempuan
            </td>
        </tr>
        <tr>
            <td>Usia : *</td>
            <td>
                <select name="age">
                    <?php
                    for($i=17; $i<=60; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nomor Selular : *</td>
            <td><input type="text" name="phone" maxlength="12" class="required number text-1" /></td>
        </tr>
        <tr>
            <td>Email : *</td>
            <td>
                <?
                if ($sess['source'] == 'twitter') {
                ?>
                <input type="text" name="email" id="email" class="required text-1" value="<?=$email?>" />
                <?php
                } else {
                ?>
                    <?=$email?>
                <input type="hidden" name="email" id="email" class="required text-1" value="<?=$email?>" />
                <?php
                }
                ?> 
            </td>
        </tr>
        <tr>
            <td valign="top">Alamat : *</td>
            <td><textarea name="address" class="required text-1" cols="60" rows="3"></textarea></td>
        </tr>
        <tr>
            <td>Provinsi : *</td>
            <td>
                <select name="id_propinsi" id="id_propinsi" class="required" onchange="get_kabupaten_kota(this.value)">
                    <option value="">-- Choose One -- </option>
                    <?php
                    foreach($mst_propinsi as $row) echo '<option value="'.$row['id_propinsi'].'">'.$row['nama_propinsi'].'</option>';
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kota : *</td>
            <td>
                <select name="id_kabupaten_kota" id="id_kabupaten_kota" class="required">
                    <option value="">-- Choose One -- </option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kode Pos : *</td>
            <td><input type="text" name="postal_code" maxlength="5" value="" class="required number text-1" /></td>
        </tr>

         <tr>
            <td colspan="2"><input type="checkbox" name="send_email" value="1" checked /> Apakah Anda setuju jika kami mengirimkan email promo dan informasi pertandingan paket Kickoff ?</td>
        </tr>
    </table>
    <table width="400" cellpadding="0" cellspacing="0" class="ml-50 mt-20 left info">
        <tr>
            <td valign="top" width="140">Tim Favorit :</td>
            <td>
                <?php
                foreach ($mst_teams as $row) echo '<input type="checkbox" name="team[]" value="'.$row['team_id'].'" /> '.$row['club_name'].'<br/>';
                ?>
                
            </td>
        </tr>
    </table>
    <div class="clearit"></div>
    <style>.error{color:red}</style>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.validate.1.10.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.form.min.js"></script>
    <script type="text/javascript">    
    function get_kabupaten_kota(val) {
        if (val != '') {
            $("#id_kabupaten_kota").block();
            $.post("<?=site_url('register/get_kabupaten_kota')?>", { 'id': val }, function(data) {
                $("#id_kabupaten_kota").html(data);
                $("#id_kabupaten_kota").unblock();
            });
        } else {
            $("#id_kabupaten_kota").html('<option value="">-- Choose One -- </option>');
        }
    }
    </script>