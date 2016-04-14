<?php
$uri = $this->uri->uri_string();
!empty($uri)?$loc = $uri : $loc = 'home';
?>
<div id="konfirmasi">
    <p>Anda Harus Login Sebelum Membeli</p>
    <div id="login-confirm">
        <div id="login-arrow2" class="fl">
            <img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/login.png">
        </div>
        <div class="fl" id="login3">
            <ul>
                <li><a href="javascript:;" onclick="login_fb()"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/fb.png"></a></li>
                <li><a href="<?=site_url('twitter/connect')?>?location=<?php echo $loc; ?>"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/twitter.png"></a></li>
                <li><a href="<?php echo site_url('google/connect');?>?location=<?php echo $loc; ?>"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/gplus.png"></a></li>
            </ul>
        </div>
       <div class="cb"></div>
    </div>

</div>