<?php echo isset($header)?$header : "";  ?>

<body>
<div class="bg-watch">
<!-- S: BG BLACK -->
<div class="outer_bpl">
		<a class="logo-bpl mt-5 ml-25" href="<?php echo site_url(); ?>"></a>
		<!-- s: header -->
		<div class="top-bpl">
        
        		<!-- s: welcome user -->
                <div class="welcome">                		
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
                		Welcome, <span>Stephen S.</span>
                        <input class="logout" type="submit" value="Logout" />
                </div>
        		<!-- e: welcome user -->
                

                <!-- s: nav -->
                <div class="menu">
                        <a <?php if($link_active == "home") { echo "class = 'active'"; } ?>href="<?php echo site_url('home');?>">HOME</a>
                        <a <?php if($link_active == "jadwal") { echo "class = 'active'"; } ?> href="<?php echo site_url('jadwal');?>">JADWAL</a>
                        <a <?php if($link_active == "pertandingan") { echo "class = 'active'"; } ?>href="<?php echo site_url('pertandingan');?>">PERTANDINGAN LIVE</a>
                        <a <?php if($link_active == "profil") { echo "class = 'active'"; } ?>href="<?php echo site_url('profil');?>">PROFIL</a>
                        
                        <div class="clearit"></div>
                </div>
                <!-- e: nav -->
                
                <!-- s: team playing -->
                    <!-- s: match day -->
                    <div class="match">Pekan 2</div>
                    <!-- e: match day -->
                    
                    <!-- s: match day -->
                    <div class="players">
                    		<h2>Liverpool<span>VS</span>Stoke City</h2>
                            <span>1</span>-<span>0</span>
                    </div>
                    <!-- e: match day -->
                    
                    <!-- s: other games -->
                    <div class="other">
                    		<div class="styled-select">
                    		<select>
                            	<option>Pertandingan Lain</option>
                            	<option>Liverpool vs Stoke City</option>
                            	<option>Arsenal vs Aston Villa</option>
                            	<option>Norwich City vs Everton</option>
                            	<option>West Bromwich Albion vs Southampton</option>
                            	<option>Sunderland vs Fullham</option>
                            	<option>West Ham United vs Cardiff City</option>
                            </select>
                            </div>
                    </div>
                    <!-- e: other games -->
                <!-- e: team playing  -->
        </div>
        <!-- e: header -->
        
        <!-- s: VIDEO -->
        <div class="video-bpl">
        		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/video-bpl.jpg" />
        </div>
        <!-- e: VIDEO -->
        
        <!-- s: sosmed -->
        <div class="sosmed">
                <!-- s: sosmed -->
                <div class="sosmed right">
                        <div class="share">
                                <a class="share-g" href="#"></a>
                                <a class="share-tw" href="#"></a>
                                <a class="share-fb" href="#"></a>
                                <span>Share:</span>
                        </div>
                        <div class="clearit"></div>
                </div>
                <!-- e: sosmed -->
                <div class="like right">
                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/like.gif" />
                </div>
                <div class="clearit"></div>
        </div>
        <!-- e: sosmed -->
        
        
        <!-- s: leaderboard -->
        <div class="leaderboard"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/leaderboard.jpg" width="720" height="98" alt="" /></div>
        <!-- e: leaderboard -->
        
        <!-- s: other games -->
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-663" title="LIVERPOOL"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-690" title="STOKE CITY"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play-on" value="MULAI" />
        </div>
        
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-660" title="ARSENAL"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-665" title="ASTON VILLA"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play" value="MULAI" />
        </div>
        
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-677" title="NORWICH CITY"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-674" title="EVERTON"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play" value="MULAI" />
        </div>
        
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-678" title="WEST BROMWICH ALBION"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-670" title="SOUTHAMPTON"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play" value="MULAI" />
        </div>
        
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-683" title="SUNDERLAND"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-667" title="FULHAM"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play" value="MULAI" />
        </div>
        
        <div class="other-games">
        		<table width="150" cellpadding="0" cellspacing="0">
                		<tr>
                                <td width="50"><a class="team-684" title="WEST HAM UNITED"></a></td>
                                <td width="50">vs</td>
                                <td><a class="team-691" title="CARDIFF CITY"></a></td>
                        </tr>
                </table>
                <input type="button" class="btn-play" value="MULAI" />
        </div>
        <div class="clearit"></div>
        <!-- e: other games -->
</div>
<!-- E: BG BLACK -->

<!-- S: BG WHITE -->
<div class="bg-white">
<div class="outer_bpl pt-20 pb-30">
		<!-- s: content left -->
		<div class="w490 left">
        		<!-- s: LIVE RESULTS -->
                <span class="title">HASIL AKHIR</span>
                <div class="box-results ">
                		<table width="430" cellpadding="0" cellspacing="0">
                        		<tr>
                                		<td width="180">Aston Villa</td>
                                		<td width="50" align="center"><span>1</span>-<span>2</span></td>
                                		<td width="190">Chelsea</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Everton</td>
                                		<td width="50" align="center"><span>0</span>-<span>2</span></td>
                                		<td width="190">West Ham United</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Aston Villa</td>
                                		<td width="50" align="center"><span>1</span>-<span>3</span></td>
                                		<td width="190">Chelsea</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Everton</td>
                                		<td width="50" align="center"><span>2</span>-<span>2</span></td>
                                		<td width="190">West Ham United</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Aston Villa</td>
                                		<td width="50" align="center"><span>1</span>-<span>2</span></td>
                                		<td width="190">Chelsea</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Everton</td>
                                		<td width="50" align="center"><span>1</span>-<span>2</span></td>
                                		<td width="190">West Ham United</td>
                                </tr>
                                <tr><td colspan="3"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td width="180">Aston Villa</td>
                                		<td width="50" align="center"><span>1</span>-<span>2</span></td>
                                		<td width="190">Chelsea</td>
                                </tr>
                        </table>
                </div>
        		<!-- e: LIVE RESULTS -->
                
        		<!-- s: KLASEMEN -->
                <span class="title-2">KLASEMEN</span>
                <div class="box-klasemen ">
                		<table width="430" cellpadding="0" cellspacing="0">
                        		<tr>
                                		<td align="center" class="bg-lightblue" width="35"><b>No.</b></td>
                                		<td class="bg-lightblue"><b>Team</b></td>
                                		<td align="center" class="bg-lightblue" width="35"><b>GP</b></td>
                                		<td align="center" class="bg-lightblue" width="35"><b>W</b></td>
                                		<td align="center" class="bg-lightblue" width="35"><b>L</b></td>
                                		<td align="center" class="bg-lightblue" width="35"><b>D</b></td>
                                		<td align="center" class="bg-lightblue" width="35"><b>P</b></td>
                                </tr>
                        		<tr>
                                		<td align="center">1.</td>
                                		<td>Aston Villa </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">2.</td>
                                		<td>Aston Villa </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">3.</td>
                                		<td>West Bromwich Albion</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">4.</td>
                                		<td>Aston Villa </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">5.</td>
                                		<td>Aston Villa </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">6.</td>
                                		<td>West Bromwich Albion</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">7.</td>
                                		<td>Aston Villa </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">8.</td>
                                		<td>Manchester City	</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">9.</td>
                                		<td>Tottenham Hotspur</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                                
                        		<tr>
                                		<td align="center">10.</td>
                                		<td>Wigan Athletic </td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                		<td align="center">0</td>
                                </tr>
                        </table>
                </div>
        		<!-- e: KLASEMEN -->
        </div>
		<!-- e: content left -->
        
		<!-- s: content RIGHT -->
		<div class="w490 right">
        		<!-- s: LIVE REPORT -->
                <span class="title">LAPORAN PERTANDINGAN</span>
                <div class="box-report" align="right">
                    <div class="styled-select-2">
                        <select>
                            <option>Pertandingan Lain</option>
                            <option>Liverpool vs Stoke City</option>
                            <option>Arsenal vs Aston Villa</option>
                            <option>Norwich City vs Everton</option>
                            <option>West Bromwich Albion vs Southampton</option>
                            <option>Sunderland vs Fullham</option>
                            <option>West Ham United vs Cardiff City</option>
                        </select>
                        </div>
                		<table width="430" cellpadding="0" cellspacing="0">
                        		<tr>
                                		<td width="160">MATCH DAY 1</td>
                                		<td align="center">Aston Villa</td>
                                		<td align="center" width="50">1 - 2</td>
                                		<td align="right">Chelsea</td>
                                </tr>
                        </table>
                		<table width="430" cellpadding="0" cellspacing="0">
                        		<tr>
                                		<td align="center" class="bg-lightblue" width="40"><b>Sec</b></td>
                                		<td class="bg-lightblue" width="60" align="center"><b>Score</b></td>
                                		<td align="center" class="bg-lightblue" width="40"><b>Team</b></td>
                                		<td align="center" class="bg-lightblue" width="50"><b>Act</b></td>
                                		<td class="bg-lightblue"><b>Player</b></td>
                                </tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-goal.png" width="16" height="15" alt="" title="Goal" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-out.png" width="17" height="10" alt="" title="Player Out" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-in.png" width="17" height="10" alt="" title="Player In" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-penalti.png" width="12" height="14" alt="" title="Penalty"</td></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-assist.png" width="16" height="12" alt="" title="Assist" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-yellowcard.png" width="12" height="14" alt="" title="Yellow Card" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-penalti.png" width="12" height="14" alt="" title="Penalty"</td></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-assist.png" width="16" height="12" alt="" title="Assist" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-yellowcard.png" width="12" height="14" alt="" title="Yellow Card" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-out.png" width="17" height="10" alt="" title="Player Out" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-in.png" width="17" height="10" alt="" title="Player In" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-penalti.png" width="12" height="14" alt="" title="Penalty"</td></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-assist.png" width="16" height="12" alt="" title="Assist" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">7'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">AVL</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-yellowcard.png" width="12" height="14" alt="" title="Yellow Card" /></td>
                                		<td>Patrice Nzekou Nguenheu</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-penalti.png" width="12" height="14" alt="" title="Penalty"</td></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                                <tr><td colspan="7"><div class="bb-1"></div></td></tr>
                        		<tr>
                                		<td align="center">10'</td>
                                		<td align="center">0 - 0 </td>
                                		<td align="center">CHE</td>
                                		<td align="center"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/ott/images/ico-redcard.png" width="12" height="14" alt="" title="Red Card" /></td>
                                		<td>Christopher Gomes</td>
                                </tr>
                        </table>
                </div>
        		<!-- e: LIVE REPORT -->        
        </div>
		<!-- e: content RIGHT -->
        <div class="clearit"></div>
</div>
</div>
<!-- E: BG WHITE -->

<?php echo isset($footer)?$footer : "";  ?>
</div>
</body>
</html>
