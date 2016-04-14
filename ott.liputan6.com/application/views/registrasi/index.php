 <div class="regis">
        		<h1 class="t-regis">registrasi</h1>
                <p class="intro">Lengkapi data diri Anda:</p>
                
                <!-- s: register step -->
                <div class="box-register bg-grad-1">
                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-regis-1.png" width="940" height="6" alt="" />
                		<h2><span>1</span> registrasi</h2>
                        <div class="clearit"></div>
                        <table width="900" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td width="280">
                                		<h3>Login Facebook</h3>
                                        <p>Connect your account to Facebook</p>
                                        <a class="login-fb" href="#"></a>
                                </td>
                            	<td width="30"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-or.png" width="20" height="97" alt="" /></td>
                            	<td width="280">
                                		<h3>Login Twitter</h3>
                                        <p>Connect your account to Facebook</p>
                                        <a class="login-tw" href="#"></a>
                                </td>
                            	<td width="30"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-or.png" width="20" height="97" alt="" /></td>
                            	<td width="280">
                                		<h3>Login Google+</h3>
                                        <p>Connect your account to Facebook</p>
                                        <a class="login-g" href="#"></a>
                                </td>
                            </tr>
                        </table>
                </div>
                <!-- e: register step -->
                
                <!-- s: information step -->
                <div class="box-info bg-grad-1">
                		<h2><span>2</span> Informasi Pelanggan</h2>
                        <div class="clearit"></div>
                        <table width="400" cellpadding="0" cellspacing="0" class="ml-50 mt-20 left info">
                        	<tr>
                            	<td width="120">Nama Depan</td>
                                <td>
                                		<input type="text" class="text-1" />
                                        <!-- error --><h5>* Nama Depan harus diisi</h5>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Nama Belakang</td>
                                <td><input type="text" class="text-1" /></td>
                            </tr>
                        	<tr>
                            	<td>Email</td>
                                <td><input type="text" class="text-1" /></td>
                            </tr>
                        	<tr>
                            	<td>Nomor Handphone</td>
                                <td><input type="text" class="text-1" /></td>
                            </tr>
                        	<tr>
                            	<td>Alamat</td>
                                <td><textarea></textarea></td>
                            </tr>
                        	<tr>
                            	<td>Propinsi</td>
                                <td>
                                		<div class="styled-select-city">
                                        <select>
                                            <option>Province</option>
                                            <option>DKI Jakarta</option>
                                            <option>Sumatera Utara</option>
                                            <option>Jawa Barat</option>
                                            <option>Riau</option>
                                        </select>
                                        </div>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Kota</td>
                                <td>
                                		<div class="styled-select-city">
                                        <select>
                                            <option>City</option>
                                            <option>Jakarta Barat</option>
                                            <option>Medan</option>
                                            <option>Bandung</option>
                                            <option>Padang</option>
                                        </select>
                                        </div>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Kode Pos</td>
                                <td><input type="text" class="text-1" /></td>
                            </tr>
                        </table>
                        
                        <table width="400" cellpadding="0" cellspacing="0" class="ml-50 mt-20 left info">
                        	<tr>
                            	<td width="90">Jenis Kelamin</td>
                                <td>
                                        <input type="radio" name="gender" value="gender" /> <label>Male</label>
                                        <input type="radio" name="gender" value="gender" /> <label>Female</label>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Umur</td>
                                <td>
                                		<div class="styled-select-city">
                                        <select>
                                            <option>Age</option>
                                            <option>18</option>
                                            <option>19</option>
                                            <option>23</option>
                                            <option>27</option>
                                        </select>
                                        </div>
                                </td>
                            </tr>
                        	<tr>
                            	<td>Tim Favorit</td>
                                <td>
                                		<!-- s: team -->
                                        <table cellpadding="0" cellspacing="0" class="team">
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Arsenal</label></td>
                                                		<td><input type="checkbox" /> <label>Manchester United</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Aston Villa</label></td>
                                                		<td><input type="checkbox" /> <label>Newcastle United</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Cardiff City</label></td>
                                                		<td><input type="checkbox" /> <label>Norwich City</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Chelsea</label></td>
                                                		<td><input type="checkbox" /> <label>Southampton</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Crystal Palace</label></td>
                                                		<td><input type="checkbox" /> <label>Stoke City</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Everton</label></td>
                                                		<td><input type="checkbox" /> <label>Sunderland</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Fulham</label></td>
                                                		<td><input type="checkbox" /> <label>Swansea City</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Hull City</label></td>
                                                		<td><input type="checkbox" /> <label>Tottenham Hotspur</label></td>
                                                </tr>

                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Liverpool</label></td>
                                                		<td><input type="checkbox" /> <label>West Bromwich Albion</label></td>
                                                </tr>
                                        		<tr>
                                                		<td><input type="checkbox" /> <label>Manchester City</label></td>
                                                		<td><input type="checkbox" /> <label>West Ham United</label></td>
                                                </tr>
                                        </table>
                                		<!-- e: team -->
                                </td>
                            </tr>
                        </table>
                        <div class="clearit"></div>
                        
                        <!-- s: reminder -->
                        <h4>Apakah anda setuju jika dikirim paket BPL yang sudah dibeli dan paket  pertandingan yang akan datang?</h4>
                        <table cellpadding="0" cellspacing="0" class="remind">
                        	<tr>
                            	<td><input type="checkbox" /> <label>Melalui SMS</label></td>
                            	<td><input type="checkbox" /> <label>Melalui Email</label></td>
                            </tr>
                        </table>
                        <!-- e: reminder -->
                </div>
                <!-- e: information step -->
                
                <!-- s: package step -->
                <div class="box-package bg-grad-1">
                		<h2><span>3</span> registrasi</h2>
                        <div class="clearit"></div>
                        
                        <!-- s: saturday package -->
                        <div class="wrap-pack">
                                <div class="title">Saturday Kick Off</div>
                                <div class="box-kickoff">
                                        <!-- s: scroll -->
                                        <div class="scroll">
                                                <table width="235" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                                <td width="50"><a class="team-663" title="LIVERPOOL"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">LIV <span>vs</span> STK</div>
                                                                </td>
                                                                <td width="50"><a class="team-690" title="STOKE CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-660" title="ARSENAL"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>21:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">ARS <span>vs</span> AVL</div>
                                                                </td>
                                                                <td width="50"><a class="team-665" title="ASTON VILLA"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-677" title="NORWICH CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>21:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">NOR <span>vs</span> EVE</div>
                                                                </td>
                                                                <td width="50"><a class="team-674" title="EVERTON"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-683" title="SUNDERLAND"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>21:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">SUN <span>vs</span> FUL</div>
                                                                </td>
                                                                <td width="50"><a class="team-667" title="FULHAM"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-678" title="WEST BROMWICH ALBION"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>21:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">WBA <span>vs</span> SOU</div>
                                                                </td>
                                                                <td width="50"><a class="team-670" title="SOUTHAMPTON"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-684" title="WEST HAM UNITED"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>21:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">WHU <span>vs</span> CAR</div>
                                                                </td>
                                                                <td width="50"><a class="team-691" title="CARDIFF CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                </table>
                                        </div>
                                        <!-- e: scroll -->
                                        <h3>20,000 IDR</h3>
                                        <div class="pilih"><input type="checkbox" /><label>Pilih Paket</label></div>
                                </div>
                        </div>
                        <!-- e: saturday package -->
                        
                        <!-- s: sunday package -->
                        <div class="wrap-pack">
                                <div class="title">Saturday Kick Off</div>
                                <div class="box-kickoff">
                                        <!-- s: scroll -->
                                        <div class="scroll">
                                                <table width="235" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                                <td width="50"><a class="team-738" title="SWANSEA CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>23:30</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">SWA <span>vs</span> MUN</div>
                                                                </td>
                                                                <td width="50"><a class="team-662" title="MANCHESTER UNITED"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-679" title="CRYSTAL PALACE"></a></td>
                                                                <td width="135">
                                                                        <h4>18/08/13</h4>
                                                                        <h5>19:30</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">CRY <span>vs</span> TOT</div>
                                                                </td>
                                                                <td width="50"><a class="team-675" title="TOTTENHAM HOTSPUR"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-661" title="CHELSEA"></a></td>
                                                                <td width="135">
                                                                        <h4>18/08/13</h4>
                                                                        <h5>22:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">CHE <span>vs</span> HUL</div>
                                                                </td>
                                                                <td width="50"><a class="team-725" title="HULL CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-676" title="MANCHESTER CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>20/08/13</h4>
                                                                        <h5>02:00</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">MCI <span>vs</span> NEW</div>
                                                                </td>
                                                                <td width="50"><a class="team-664" title="NEWCASTLE UNITED"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                </table>
                                        </div>
                                        <!-- e: scroll -->
                                        <h3>15,000 IDR</h3>
                                        <div class="pilih"><input type="checkbox" /><label>Pilih Paket</label></div>
                                </div>
                        </div>
                        <!-- e: sunday package -->
                        
                        <!-- s: weekend package -->
                        <div class="wrap-pack">
                                <div class="title">Weekend Kick Off</div>
                                <div class="box-kickoff">
                                        <!-- s: scroll -->
                                        <div class="scroll">
                                                <table width="235" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                                <td width="50"><a class="team-663" title="LIVERPOOL"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">LIV <span>vs</span> STK</div>
                                                                </td>
                                                                <td width="50"><a class="team-690" title="STOKE CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-660" title="ARSENAL"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">ARS <span>vs</span> AVL</div>
                                                                </td>
                                                                <td width="50"><a class="team-665" title="ASTON VILLA"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-677" title="NORWICH CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">NOR <span>vs</span> EVE</div>
                                                                </td>
                                                                <td width="50"><a class="team-674" title="EVERTON"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-683" title="SUNDERLAND"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">SUN <span>vs</span> FUL</div>
                                                                </td>
                                                                <td width="50"><a class="team-667" title="FULHAM"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-678" title="WEST BROMWICH ALBION"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">WBA <span>vs</span> SOU</div>
                                                                </td>
                                                                <td width="50"><a class="team-670" title="SOUTHAMPTON"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-684" title="WEST HAM UNITED"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">WHU <span>vs</span> CAR</div>
                                                                </td>
                                                                <td width="50"><a class="team-691" title="CARDIFF CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-738" title="SWANSEA CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>23:30</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">SWA <span>vs</span> MUN</div>
                                                                </td>
                                                                <td width="50"><a class="team-662" title="MANCHESTER UNITED"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-679" title="CRYSTAL PALACE"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">CRY <span>vs</span> TOT</div>
                                                                </td>
                                                                <td width="50"><a class="team-675" title="TOTTENHAM HOTSPUR"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-661" title="CHELSEA"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">CHE <span>vs</span> HUL</div>
                                                                </td>
                                                                <td width="50"><a class="team-725" title="HULL CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                        <tr>
                                                                <td width="50"><a class="team-676" title="MANCHESTER CITY"></a></td>
                                                                <td width="135">
                                                                        <h4>17/08/13</h4>
                                                                        <h5>18:45</h5>
                                                                        <div class="clearit"></div>
                                                                        <div class="match">MCI <span>vs</span> NEW</div>
                                                                </td>
                                                                <td width="50"><a class="team-664" title="NEWCASTLE CITY"></a></td>
                                                        </tr>
                                                        <tr><td colspan="4"><div class="bb-1"></div></td></tr>
                                                </table>
                                        </div>
                                        <!-- e: scroll -->
                                        <h3>25,000 IDR</h3>
                                        <div class="pilih"><input type="checkbox" /><label>Pilih Paket</label></div>
                                </div>
                        </div>
                        <!-- e: weekend package -->
                        
                        <div class="clearit"></div>
                        
                        <!-- s: total -->
                        <table class="total" cellpadding="0" cellspacing="0">
                        		<thead style="background:#010042;">
                                		<tr>
                                        		<th align="left">Paket</th>
                                        		<th width="100" align="center">Price</th>
                                        </tr>
                                </thead>
                                <tbody style="background:#fff;">
                                		<tr>
                                        		<td align="left">Kick Off Sabtu</td>
                                                <td align="center">Rp. 20.000,-</td>
                                        </tr>
                                		<tr>
                                        		<td align="left">Kick Off Minggu</td>
                                                <td align="center">Rp. 15.000,-</td>
                                        </tr>
                                </tbody>
                                <tfoot style="background:#d8dfec;">
                                		<tr>
                                        		<td align="left">Total</td>
                                        		<td align="center">Rp. 35.000,-</td>
                                        </tr>
                                </tfoot>
                        </table>
                        <!-- e: total -->
                        
                        <table width="300" cellpadding="0" cellspacing="0" class="coupon">
                        		<tr>
                                		<td align="left">
                                       			<div class="teks">Apply Coupon</div>
                                                <input type="text" class="code" />
                                                <input type="submit" class="submit" value="SUBMIT" />
                                        </td>
                                		<td></td>
                                </tr>
                        </table>
                        
                        <div class="clearit"></div>
                        
                </div>
                <!-- e: package step -->
                
                <!-- s: payment step -->
                <div class="box-payment bg-grad-1">
                		<h2><span>4</span> pembayaran</h2>
                        <div class="clearit"></div>
                        <p>Silakan pilih cara pembayaran Anda</p>
                        <div class="metode">
                        		<table cellpadding="0" cellspacing="0" class="payment">
                                		<tr>
                                        		<td width="40"><input type="radio" name="payment" value="payment" /></td>
                                        		<td>
                                                		<h3>Pembayaran melalui DOKU e-wallet</h3>
                                                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-doku.gif" width="129" height="32" alt="" />
                                                </td>
                                        </tr>
                                		<tr>
                                        		<td colspan="2"><div class="bb-1"></div></td>
                                        </tr>
                                		<tr>
                                        		<td width="40"><input type="radio" name="payment" value="payment" /></td>
                                        		<td>
                                                		<h3>Pembayaran VISA</h3>
                                                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-visa.jpg" width="56" height="34" alt="" />
                                                </td>
                                        </tr>
                                		<tr>
                                        		<td colspan="2"><div class="bb-1"></div></td>
                                        </tr>
                                		<tr>
                                        		<td width="40"><input type="radio" name="payment" value="payment" /></td>
                                        		<td>
                                                		<h3>Pembayaran MasterCard</h3>
                                                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-mastercard.gif" width="53" height="34" alt="" />
                                                </td>
                                        </tr>
                                		<tr>
                                        		<td colspan="2"><div class="bb-1"></div></td>
                                        </tr>
                                		<tr>
                                        		<td width="40"><input type="radio" name="payment" value="payment" /></td>
                                        		<td>
                                                		<h3>Pembayaran melalui e-Pay BRI</h3>
                                                		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-bripayment.jpg" width="50" height="14" alt="" />
                                                </td>
                                        </tr>
                                </table>
                                
                                <table cellpadding="0" cellspacing="0" class="buy2">
                                		<tr>
                                        		<td width="450"><input type="checkbox" /><label>Saya sudah membaca dan setuju mengenai <a href="terms.html">Terms & Conditions</a></label></td>
                                                <td width="300"><input class="bayar" type="submit" value="BAYAR" /></td></td>
                                                <td><a class="home" href="index.html">HOME</a></td>
                                        </tr>
                                </table>
                        </div>
                </div>
                <!-- e: payment step -->
        </div>
        <!-- e: content register -->
