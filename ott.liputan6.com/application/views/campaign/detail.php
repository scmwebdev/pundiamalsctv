<!-- s: content left -->
<script type="text/javascript">
mixpanel.track("Access homepage");
</script>
<div class="w450 left mt-35 pb-30">
  <!-- s: video -->
  <div class="vid-free">
    <!--<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/vid-450x344.jpg" /> -->
    <?php
    if($campaign[0]['enable_home_livestream']){
      $this->load->view('pertandingan/player');
    } else { ?>
      <iframe
        frameborder="0"
        webkitallowfullscreen="webkitallowfullscreen"
        mozallowfullscreen="mozallowfullscreen"
        allowfullscreen="allowfullscreen"
        scrolling="no"
        src="http://publish.viostream.com/embed/player/o9dzaktzdemx/?video=o9dzaktzdemx&amp;playerKey=default&amp;width=450&amp;height=253&amp;start=0&amp;end=0&amp;flash=true&amp;hls=false"
        width="450"
        height="253">
      </iframe>
    <?php } ?>
  </div>
  <!-- e: video -->

  <?php if($campaign[0]['enable_home_livestream']){ ?>
    <img src="<?=base_url().'assets/images/banner-supercup.png'?>" >
  <?php } else { ?>

  <div class="w100 left freebanner">
    <div class="big"><img src="assets/images/banner-kickoff-v2.png"></div>
  </div>

  <a class="saksikan" href="<?php echo site_url('campaign/'.$campaign[0]['key'].'/buy')?>"></a>
  <? } ?>

</div>
<!-- e: content left -->

<!-- s: content right -->
<div class="w500 right mt-35 pb-30">
    <!-- s: schedule -->
        <h1 class="sched">PACKAGE</h1>
        <?php foreach ($campaign as $key => $cp) { ?>

        <h2 class="pack"><?php echo $cp['package_name']; ?> - <span><?php echo format_rupiah($cp['price']); ?></span></h2>
        <div class="scroll-pack">
            <table class="pack" cellpadding="0" cellspacing="0">
                    <?php foreach ($cp['matches'] as $key => $match) { ?>
                      <?php $localDateTime = local_from_utc($match['date_utc'], $match['time_utc']); ?>
                    <tr>
                            <td width="120"><h4><?= tgl_indo($localDateTime->format('Y-m-d'), true) ?></h4></td>
                            <td width="60" class="time"><?= $localDateTime->format('H:i:s') ?></td>
                            <td width="50"><a class="team-<?php echo $match['team_A_id'] ?>" title="<?php echo $match['team_A_name'];?>"></a></td>
                            <td width="120"><h3><?php echo substr($match['team_A_name'],0,3) ?> <span>vs</span> <?php echo substr($match['team_B_name'],0,3) ?></h3></td>
                            <td width="60"><a class="team-<?php echo $match['team_B_id'] ?>" title="<?php echo $match['team_B_name'];?>"></a></td>
                    </tr>
                    <? } ?>

            </table>
        </div>
        <div class="harga"><div class="clearit"></div></div>
        <? } ?>
    <!-- e: schedule -->

</div>
<!-- e: content right -->

<div class="clearit"></div>

<br /><br /><br /><br /><br /><br />

<div class="clearit"></div>
