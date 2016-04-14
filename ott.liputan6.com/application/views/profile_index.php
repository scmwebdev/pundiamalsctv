
<?php
    echo "Hello ".$sess['full_name'];
?>
    <br/>Silakan update profile anda di bawah ini :
    <form name="frmProfile" id="frmProfile" action="<?=site_url('profile/submit')?>" method="post">
    <table>
        <tr>
            <td>First name : *</td>
            <td><input type="text" name="first_name" value="<?=$sess_profile['first_name']?>" class="required" /></td>
        </tr>
        <tr>
            <td>Last name : *</td>
            <td><input type="text" name="last_name" value="<?=$sess_profile['last_name']?>" class="required" /></td>
        </tr>
        <tr>
            <td>Sex : *</td>
            <td>
                <input type="radio" name="sex" value="MALE"<?=($sess_profile['sex'] == 'MALE') ? ' checked' : ''?> /> Male &nbsp;&nbsp;&nbsp; 
                <input type="radio" name="sex" value="FEMALE"<?=($sess_profile['sex'] == 'FEMALE') ? ' checked' : ''?> /> Female
            </td>
        </tr>
        <tr>
            <td>Age : *</td>
            <td>
                <select name="age">
                    <?php
                    for($i=17; $i<=60; $i++) echo '<option value="'.$i.'"'.(($sess_profile['age'] == $i) ? ' selected' : '').'>'.$i.'</option>';
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Email : *</td>
            <td><input type="text" name="email" id="email" class="required" value="<?=$sess_profile['email']?>" /></td>
        </tr>
        <tr>
            <td>Mobile Number : *</td>
            <td><input type="text" name="phone" class="required number" value="<?=$sess_profile['phone']?>" /></td>
        </tr>
        <tr>
            <td valign="top">Address : *</td>
            <td><textarea name="address" class="required" cols="60" rows="3"><?=$sess_profile['address']?></textarea></td>
        </tr>
        <tr>
            <td>Province : *</td>
            <td>
                <select name="id_propinsi" id="id_propinsi" class="required" onchange="get_kabupaten_kota(this.value, '')">
                    <option value="">-- Choose One -- </option>
                    <?php
                    foreach($mst_propinsi as $row) echo '<option value="'.$row['id_propinsi'].'"'.(($sess_profile['id_propinsi'] == $row['id_propinsi']) ? ' selected' : '').'>'.$row['nama_propinsi'].'</option>';
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>City : *</td>
            <td>
                <select name="id_kabupaten_kota" id="id_kabupaten_kota" class="required">
                    <option value="">-- Choose One -- </option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Postal Code : *</td>
            <td><input type="text" name="postal_code" maxlength="5" value="<?=$sess_profile['postal_code']?>" class="required number" /></td>
        </tr>
        <tr>
            <td valign="top">Teams Preferences : *</td>
            <td>
                <?php
                foreach ($mst_teams as $row) echo '<input type="checkbox" name="team[]" value="'.$row['id_team'].'"'.((in_array($row['id_team'], $sess_profile['teams'])) ? ' checked' : '').' /> '.$row['team_name'].'<br/>';
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value=" Update Profile " /></td>
        </tr>
    </table>
    </form>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.validate.1.10.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/facelift/js/jquery.form.min.js"></script>
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