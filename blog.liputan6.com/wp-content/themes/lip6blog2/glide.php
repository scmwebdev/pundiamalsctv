<script type="text/javascript">
stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:true, moveby:1, pause:3000},
	panelbehavior: {speed:500, wraparound:true, persist:true},
	defaultbuttons: {enable: true, moveby: 1, leftnav: ['<?php bloginfo('template_url'); ?>/images/eps2.png', 5, 100], rightnav: ['<?php bloginfo('template_url'); ?>/images/eps1.png', -25, 100]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['external', 'path_to_external_file']
})


</script>


<div id="slider">
<div id="mygallery" class="stepcarousel">
<div class="belt">
	<?php 
	$glidecat = get_option('yes_gldcat'); 
	$glidecount = get_option('yes_gldct'); 
	//$my_query = new WP_Query('category_name= '. $glidecat .'&showposts= '. $glidecount . '');
	$my_query = new WP_Query('is_year='.date('Y').'&is_month='.date('n').'&showposts= '. $glidecount . '');
	
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>

<div class="panel">

<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<?php $preview = get_post_meta($post->ID, 'preview', $single = true); ?>
<? /* <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $preview; ?>&amp;h=120&amp;w=200&amp;zc=1" alt=""/> */?>

<?php the_excerpt(); ?>
			

					
</div>
	<?php endwhile; ?>
			

</div>

</div>
</div>

	<div class="clear"></div>