<?php get_header(); ?>

<div id="container">   
<div id="content" > 
  <!-- This sets the $curauth & $authid variables -->
  <?php
if (isset($_GET['author_name'])){
	$curauth = get_userdatabylogin($author_name);
	$authid = $author_name;
} else {
	$curauth = get_userdata(intval($author));
	$authid = intval($author);
}

?>

  <!-- <h2>Posts by <?php //echo $curauth->nickname; ?>:</h2> -->


<!-- The Loop -->
<?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?>

<!--      
	  <h3>
    <a href="<?php //the_permalink() ?>"><?php //the_title(); ?></a></h3>
      <div class="tab"><?php //the_time('F jS, Y') ?> </div>	
    <?php //the_content('Read the rest of this entry "'); ?>
      <p>
<?php //comments_popup_link('No Comments "', '1 Comment "', '% Comments "'); ?>
</p>
-->

<div class="tab"><?php the_date('','<h2>','</h2>'); ?></div>

<div class="post" id="post-<?php the_ID(); ?>">
			<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="meta"><?php _e("Filed under:"); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This')); ?></div>
	
			<div class="storycontent">
				<?php the_content(__('(more...)')); ?>
			</div>
	
			<div class="feedback">
		            <?php wp_link_pages(); ?>
				<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>		            
			</div>

			<div class="divider"></div>

		</div>



   <?php endwhile; ?>

   <?php else : ?>
      <p>No posts by this author</p>
   <?php endif; ?>
<!-- End Loop -->


<div class="pagenavigation">
			<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
		</div>

</div>

<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>

	<div class="clear"></div>


</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>