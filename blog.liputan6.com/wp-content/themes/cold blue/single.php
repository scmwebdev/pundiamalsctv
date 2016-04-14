<?php get_header(); ?>

<?php include(TEMPLATEPATH . "/leftsidebar.php"); ?>

	<div id="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div style="float: left;"><?php previous_post_link('&laquo; %link') ?></div>
			<div style="float: right;"><?php next_post_link('%link &raquo;') ?></div>
		    <br /><br />

		<div class="post" id="post-<?php the_ID(); ?>">
			<h3><a class="link" href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h3>
         
            <h5>Posted by <strong><?php the_author() ?></strong> on <?php the_time('M') ?> <?php the_time('j') ?>, <?php echo the_time('Y'); ?></h5>

		<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>


<?php get_footer(); ?>