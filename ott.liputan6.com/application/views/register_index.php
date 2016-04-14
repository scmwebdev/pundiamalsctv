
<?php
if (empty($sess)) {
?>

<p align="center">
    <a href="<?=site_url('fbconnect/login')?>"><img src="http://assets.liputan6.com/facelift/images/facebook-connect.png" /></a>
    <a href="<?=site_url('twitter/connect')?>?location=<?php echo $this->uri->uri_string(); ?>"><img src="http://assets.liputan6.com/facelift/images/twitter-connect.png" /></a>
    <a href="<?php echo site_url('google/connect');?>?location=<?php echo $this->uri->uri_string(); ?>">Google</a>
</p>

<?php
} else {
    echo "Hello ".$sess['full_name'];
    
    if ($sess['id_profile'] == '0') {
?>
        <form name="frmProfile" id="frmProfile" action="<?=site_url('register/submit')?>" method="post">
        
<?php      
        $this->load->view('register_form');
?>   
     
        <p align="center"><input type="submit" name="submit" value=" Register " /></p>
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
            		jQuery(form).ajaxSubmit({
                		success : function(data) {
                			var obj = jQuery.parseJSON(data);
                            if (obj.status == 'error') {
                                alert(obj.message);
                            } else {
                                alert(obj.message);
                                if (obj.valid == '1') 
                                    location.reload();
                                else
                                    window.location.href = '<?=base_url()?>';
                            }
                            $("#frmProfile").unblock();
                		}
            		});
            	}
            });
        });
        <script type="text/javascript">
        
<?php
    } else {
        
        echo '<p>Profile Anda sudah terdaftar</p>';
        echo '<p>Klik <a href="'.site_url('profile').'">di sini</a> untuk mengubah profile anda.</p>';
        
        //echo '<pre>';print_r($sess_profile);echo '</pre>';
    }
    
    echo '<pre>';print_r($sess);echo '</pre>';
}
?>
<p>&nbsp;</p>
