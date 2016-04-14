<!-- e: liputan 6 -->
        <div class="outer_bpl">
                <ul class="nav-lip6">
                    <li>
                    <a><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/logo-liputan6.png" width="107" height="29" alt="" /></a>
                        <div class="sub-nav-wrapper2">
                            <ul class="sub-nav">
                                <li><a href="http://news.liputan6.com" target="_blank">News</a></li>
                                <li><a href="http://bisnis.liputan6.com" target="_blank">Bisnis</a></li>
                                <li><a href="http://bola.liputan6.com" target="_blank">Bola</a></li>
                                <li><a href="http://showbiz.liputan6.com" target="_blank">Showbiz</a></li>
                                <li><a href="http://tekno.liputan6.com" target="_blank">Tekno</a></li>
                                <li><a href="http://health.liputan6.com" target="_blank">Health</a></li>
                                <li><a href="http://foto.liputan6.com" target="_blank">Foto</a></li>
                                <li><a href="http://video.liputan6.com" target="_blank">Video</a></li>
                                <li><a href="http://video.liputan6.com/streaming" target="_blank">Streaming</a></li>
                                <li><a href="http://deal.liputan6.com" target="_blank">Deal</a></li>
                                <li><a href="http://liputan6.com/indeks/terkini" target="_blank">Index</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
        </div>
        <!-- e: liputan 6 -->
		<!-- s: menu -->
        <div class="menu-bpl-out">
        		<div class="menu-bpl">
                        <a <?php if($link_active == "home") { echo "class = 'active'"; } ?>href="<?php echo site_url('home');?>">HOME</a>
                        <a <?php if($link_active == "jadwal") { echo "class = 'active'"; } ?> href="<?php echo site_url('jadwal');?>">JADWAL</a>
                        <a <?php if($link_active == "pertandingan") { echo "class = 'active'"; } ?>href="<?php echo site_url('pertandingan');?>">PERTANDINGAN LIVE</a>
                        <a <?php if($link_active == "profil") { echo "class = 'active'"; } ?>href="<?php echo site_url('profil');?>">PROFIL</a>
                       
                </div>
        </div>
		<!-- e: menu -->