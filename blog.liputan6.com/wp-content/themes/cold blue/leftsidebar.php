<div id="leftnav">

<div class="nav">

<h2>Archives</h2>

<ul class="nav">
<?php wp_get_archives('type=monthly'); ?>
</ul>

</div>

<div class="nav">

<h2>Categories</h2>

<ul class="nav">
<?php wp_list_categories('title_li=0'); ?>
</ul>

</div>

<div class="ad">

<?php include(TEMPLATEPATH . "/adsense.php"); ?>

</div>


</div>