<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kick Off</title>
<link href="<?=base_url()?>assets/css/streaming.css" rel="stylesheet" type="text/css" />
</head>

<body style="background:#fff;">
<?php
#print_r($invoice);
#print_r($jadwal);
?>
<div class="history-pack">
    <h2 class="hist">PAKET BPL</h2>
        <table width="400" cellpadding="0" cellspacing="0" class="paket" bgcolor="#FCFCFC">
            <tr class="bg-green c-white">
              <td colspan="2"><strong>TRANSAKSI : #<?=$no_trans?></strong></td>
            </tr>
            <?php foreach($paket as $p => $r): ?>
            <tr>
              <td><?=$r['name']?></td>
              <td align="right"><?=format_duit($r['amount'], 1)?></td>
            </tr>
            <?php endforeach;?>
            <tr><td colspan="2" class="p-0"><div class="bb-1"></div></td></tr>
            <?php if (!empty($invoice->bank_name)) : ?>
            <tr>
                <td><b>Nama Bank</b></td>
                <td align="right"><?=strtoupper($invoice->bank_name)?></td>
            </tr>
            <?php endif ?>
            <?php if (!empty($invoice->unic_code)) : ?>
            <tr>
                <td><b>Kode Unik</b></td>
                <td align="right"><?=strtoupper($invoice->unic_code)?></td>
            </tr>
            <?php endif ?>
            <tr>
                <td><b>Diskon</b></td>
                <td align="right"><?=format_duit($invoice->discount, 1)?></td>
            </tr>
            <tr><td colspan="2" class="p-0"><div class="bb-1"></div></td></tr>

            <tr class="jlh">
              <td>TOTAL</td>
              <td align="right"><?=format_duit($invoice->total_amount+$invoice->unic_code, 1)?></td>
            </tr>
        </table>
        <?php if ($invoice->is_paid=='NO') : ?>
        <br/>
            <span style="color: #FF0000; font-weight:normal; font-size:11px">
            * Paket Anda akan diaktifkan oleh Customer Service kami maksimum 2 jam setelah konfirmasi pada waktu jam kerja<br>
            * Customer Service beroperasi Pukul 09.00-18.00 WIB dan setiap 1 jam sebelum maupun sesudah pertandingan.<br>
            * Call Center (021) 27935550</span></td>
        <?php endif ?>

        <table width="600" cellpadding="0" cellspacing="0" class="paket mt-30" bgcolor="#FCFCFC">
            <tr class="bg-green c-white"><td colspan="5"><strong>JADWAL PERTANDINGAN</strong></td></tr>
            <?php foreach($jadwal as $k => $v): ?>
              <?php $localTime = local_from_utc($v['date_utc'], $v['time_utc']); ?>
              <tr data-match_id='<?=$v['match_id']?>'>
                <td width="180"><?= $localTime->format("d-M-Y") ?></td>
                <td width="50"><?= $localTime->format('H:i') ?></td>
                <td width="30"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                <td align="center"><?=$v['team_A_tla']?> <span>vs</span> <?=$v['team_B_tla']?></td>
                <td width="30"><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
              </tr>
              <tr><td colspan="5" class="p-0"><div class="bb-1"></div></td></tr>
            <?php endforeach;?>

        </table>
</div>
</body>
</html>
