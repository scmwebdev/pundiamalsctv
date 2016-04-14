
<ul>
<?php
foreach($packages as $row) {
    echo '<li>'.$row['name'].' - IDR '.$row['value'].' - <a href="'.site_url('payment/add/'.$row['id']).'">BUY NOW</a></li>';
}
?>
</ul>

<p>&nbsp;</p>
