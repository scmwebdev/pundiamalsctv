<div id="content-area-rounded">

<table width="1000" border="0" cellspacing="3" cellpadding="3">
    <tbody><tr>
        <td><table width="100%" border="0" cellspacing="4" cellpadding="4">

            <tbody><tr>
                <td bgcolor="#FFFFFF"><span style="font-weight:bold">CATATAN TRANSAKSI</span></td>
            </tr>
            <?php foreach($rows as $row) : ?>
            <tr>
                <td bgcolor="#e5e5e5"><table width="100%" border="0" cellspacing="3" cellpadding="3">
                    <tbody>
                    <tr>
                        <td width="20%">Nomer Transaksi</td>
                        <td width="80%"><?=$row->no_invoice?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Transaksi</td>
                        <td><?=$row->tanggal_invoice?></td>
                    </tr>
                    <tr>
                        <td>Paket</td>
                        <td>
                            <?php
                                $detail_paket = $this->payment_model->findDetailInvoiceById($row->id_invoice);
                                foreach($detail_paket as $k2 => $v2):
                            ?>
                            <?=$v2['name']?><br/>
                            <?php endforeach;?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                          <?php if ($row->total_transfer == 0) : ?>
                            <a href="<?=site_url('payment/confirm/'.$row->no_invoice)?>" class="fancybox">Konfirmasi Pembayaran</a>
                          <?php else : ?>
                            <a href="<?=site_url('profil/history/'.$row->no_invoice)?>" class="fancybox fanci">Detail</a>
                          <?php endif ?>
                        </td>
                    </tr>
                </tbody></table></td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          <?php endforeach ?>

        </tbody></table></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</tbody></table>


</div>

<script type="text/javascript" src="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
    $(document).ready(function() {
        $(".fanci").fancybox({
            'width'             : 690,
            'height'            : 420,
            'autoScale'         : false,
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'type'              : 'iframe'
        });
    });
</script>
