<?php get_header(); ?>


	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
<div class="top">
						<div class="tleft"><div class="topcal"><?php the_time('M'); ?></div><div class="bottomcal"><?php the_time('j'); ?></div></div>
						<div class="tright"><div class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div><div class="info">Posted by <a href="#"><?php the_author(); ?></a> Filed Under <?php the_category(', ') ?> </div></div>
						<div class="clear"></div>
					</div>
					<div class="post"><?php the_content('More...'); ?><br /><?php comments_template(); ?></div>
					<div class="comments"><div style="float:left"><img src="<?php bloginfo('template_url'); ?>/comment.jpg" alt="comment" /><?php comments_popup_link('Comments (0)', 'Comments (1)', 'Comments (%)'); ?></div><div class="right"><img src="<?php bloginfo('template_url'); ?>/post.jpg" alt="post" /><?php comments_popup_link('Post Comment', 'Post Comment', 'Post Comment'); ?></div><div class="clear"></div></div>

		<?php endwhile; ?>



	<?php else : ?>

		<h2 class="center">Not Found</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

