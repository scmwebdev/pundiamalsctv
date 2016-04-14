<?php get_header(); ?>


<div id="content">

<!-------------------------- SLIDER ------------------------------->
 <?php include (TEMPLATEPATH . '/glide.php'); ?>
 <div class="stor"> </div> 
<!-------------------------- END SLIDER ------------------------------->

<?php if (have_posts()) : ?>
<?php $aCounter = 1; ?>
<?php while (have_posts()) : the_post(); ?>
<?php if ($aCounter>$glidecount) : ?>

<div class="box" id="post-<?php the_ID(); ?>">

<div class="cover">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>


<div class="sentry">
<?php $preview = get_post_meta($post->ID, 'preview', $single = true); ?>

<? /* ga dipake dulu <img class="ethumb" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $preview; ?>&amp;h=80&amp;w=120&amp;zc=1" alt=""/> */ ?>


	<?php the_excerpt () ?>

					<div class="clear"></div>
</div>


</div>

<div class="sinfo">
	
<div class="rmore"><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>"> SELENGKAPNYA.. </a></div>
<div class="scomm"><?php comments_popup_link('TAMBAH KOMENTAR', '1 KOMENTAR', '% KOMENTAR'); ?></div>
</div>


</div>
		<?php endif; ?>
		<?php $aCounter++; ?>
		<?php endwhile; ?>
		
 <div id="navigation">
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  
</div>

	<?php else : ?>

		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>



</div>
<?php get_sidebar(); ?>


<?php get_footer(); ?>
