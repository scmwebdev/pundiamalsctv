<?php if (!empty($campaign)) : ?>
<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/stylenivo.css" type="text/css" media="screen" />

<div class="<?=isset($small) ? 'slider-wrapper-inside fl mt20 mb20' : 'slider-wrapper'?> theme-default">
    <div id="slider" class="nivoSlider">
      <?php foreach($campaign as $k=>$v) : ?>
        <a href="<?=site_url('campaign/'.$v['key'].'/buy')?>" title="Buy Campaign <?=$v['name']?>"><img src="<?=base_url().$v['filename']?>" alt="Buy Campaign <?=$v['name']?>" /></a>
      <?php endforeach; ?>
    </div>
</div>


<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/js/jquery.nivo.slider.js"></script>
<script type="text/javascript">
  $('#slider').nivoSlider();
</script>
<?php endif ?>
