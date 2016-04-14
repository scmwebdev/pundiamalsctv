<?php get_header(); ?>

<div id="content"> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="entry">
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time('F jS, Y') ?> | by <?php the_author() ?> | <?php if(function_exists('the_views')) { the_views(); } ?></small>
		
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				

			</div>
		</div>

<div class="entry">
	<?php comments_template(); ?>
	</div>

	<?php endwhile; else: ?>
<div class="entry">
		<p>Sorry, no posts matched your criteria.</p>
</div>
<?php endif; ?>

	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
