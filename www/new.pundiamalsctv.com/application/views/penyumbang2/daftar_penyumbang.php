
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        	
             
            
             <div id="title-insidepage">
             	<div class="judul">DAFTAR PENYUMBANG</div>
          </div>
             <div id="insidepage-content">
             
             <div id="search-right">  <form id="searchForm" name="searchForm" method="post" action="">
<table border="0" cellspacing="2" cellpadding="0">
<tr><td class="g"  align="right"><span style="font-size:11px; color:#666666">(date format: dd/mm/yyyy)</span></td><td></td></tr>
<tr>
<td><b>Search</b>: <input type="text" name="keysearch" id="keysearch" /></td>
<td>

<select name="fldsearch" id="fldsearch">
<option value="">-- select field --</option>
<option value="nama">Nama</option><option value="tanggal">Tanggal</option></select>
</td>
<td><input name="spotlight" type="image" id="spotlight" src="<?php echo base_url();?>images/search.png" /></td>
</tr>
</table>
</form></div>
               	<div id="insidepage-inside">
                 
                 <table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>No</strong></div></td>
    <td width="271" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>Nama</strong></div></td>
     <td width="223" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>Kota</strong></div></td>
    <td width="167" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>Jumlah</strong> (Rp)</div></td>
  </tr>
</table>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" bgcolor="#9c9c9c"><table width="700" border="0" cellspacing="1" cellpadding="4">
      <?php $nourut =$page; $counter = 1;?>
		<?php foreach($penyumbang as $k => $v ):?>
        <?php $nourut++; ?>
        <?php
        if ($counter % 2 == 0) $warna = "#e9e9e9";
        else $warna ="#FFFFFF";
		
        ?>
          <tr>
          
           <td width="39" align="center" bgcolor="<?php echo $warna;?>"><?php echo $nourut;?></td>
            <td width="271" bgcolor="<?php echo $warna;?>"><?php echo ucfirst(strtolower($v['nama']));?></td>
            <td width="167" bgcolor="<?php echo $warna;?>"><?php echo number_format($v['jumlah'],2,",",".") ;?></td>
          </tr>
          <?php $counter++; ?>
          <?php endforeach;?>
         </table></td>
  </tr>
</table>
                 
           <ul id="paging" class="fr">
 <?php echo $this->pagination->create_links();?></ul>
                      
          </div>
          
         
                 
				<div class="cb"></div>
               </div>
                
                
                	</div>
    
        <div id="rightbar-container">
          <div id="title-yellow">
             	<div class="judul">TERBARU</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
        <?php foreach($terbaru as $k => $v):?>
    <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span><br />
          <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/penyumbang/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>  
       <?php endforeach; ?>      
      </ul>
      
       
      </div>
      <div class="selengkapnya"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></div><br><br>
      </div>
      
      
       <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">INFO KEGIATAN</a></div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
     <?php foreach($info_kegiatan as $v=>$k):?>
                <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($k['dates']));
				echo $tanggal;?></span>
        <br>
        <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/penyumbang/view/'.$k['id']).'/'.$slug;?>"><?php echo $k['title'];?></a>. </li>
        <?php endforeach;?>
           
      </ul>
     
       
      </div>
       <div class="selengkapnya"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></div><br><br>
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

