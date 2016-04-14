<ul>
<?php
foreach($campaigns as $row) {
    echo '<li><a href="'.site_url('campaign/'.$row['key']).'">'.$row['name'].'</a></li>';
}
?>
</ul>

<p>&nbsp;</p>
