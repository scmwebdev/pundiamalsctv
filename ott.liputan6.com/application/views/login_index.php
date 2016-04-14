
<?php
if (empty($sess)) {
?>

<p align="center">
    <a href="<?=site_url('fbconnect/login')?>"><img src="http://assets.liputan6.com/facelift/images/facebook-connect.png" /></a>
    <a href="<?=site_url('twitter/connect')?>?location=<?php echo $this->uri->uri_string(); ?>"><img src="http://assets.liputan6.com/facelift/images/twitter-connect.png" /></a>
	<a href="<?php echo site_url('google/connect');?>?location=<?php echo $this->uri->uri_string(); ?>">Google</a>
</p>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/js/fb.js?v1"></script>

<?php
} else {
    echo "Hello ".$sess['full_name'];
}
?>

<p>&nbsp;</p>
