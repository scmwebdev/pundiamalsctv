<!--
<?php
if (empty($sess)) {
?>

<p align="center">
    <a href="javascript:;" onclick="login_fb()"><img src="http://assets.liputan6.com/facelift/images/facebook-connect.png" /></a>
    <a href="<?=site_url('twitter/connect')?>"><img src="http://assets.liputan6.com/facelift/images/twitter-connect.png" /></a>
</p>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/js/fb.js?v1"></script>

<?php
} else {
    echo "Hello ".$sess['fullname'];
    
    if ($sess['id_profile'] == '0') {
        $name_arr = explode(' ', $sess['fullname']);
        if (count($name_arr) > 0) {
            $first_name = $name_arr[0];
            $last_name  = $name_arr[1];
        } else {
            $first_name = $sess['fullname'];
            $last_name  = '';
        }
        
        $email = (isset($sess['email'])) ? $sess['email'] : '';
?>
    <br/>Anda Belum terdaftar, silakan isi profile anda di bawah ini :
    <form name="frmProfile" id="frmProfile" action="<?=site_url('register/submit')?>" method="post">
    <table>
        <tr>
            <td>First name : *</td>
            <td><input type="text" name="first_name" value="<?=$first_name?>" class="required" /></td>
        </tr>
        <tr>
            <td>Last name : *</td>
            <td><input type="text" name="last_name" value="<?=$last_name?>" class="required" /></td>
        </tr>
        <tr>
            <td>Email : *</td>
            <td><input type="text" name="email" id="email" class="required" value="<?=$email?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value=" Submit " /></td>
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
                            
                        }
                        $("#frmProfile").unblock();
            		}
        		});
        	}
        });
    });
    </script>

<?php
    } else {
        echo '<pre>';print_r($sess_profile);echo '</pre>';
    }
    
    echo '<pre>';print_r($sess);echo '</pre>';
}
?>
-->