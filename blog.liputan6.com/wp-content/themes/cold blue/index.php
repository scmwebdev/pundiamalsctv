<?php get_header(); ?>

<?php include(TEMPLATEPATH . "/leftsidebar.php"); ?>

<div id="main">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<h3><a class="link" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>


<h5>Posted by <strong><?php the_author() ?></strong> on <?php the_time('M') ?> <?php the_time('j') ?>, <?php echo the_time('Y'); ?></h5>

<?php the_content('Read the rest of this entry &raquo;'); ?>

<br />

<div class="com">Posted in <?php the_category(', ') ?> || <?php comments_popup_link('No Comments &raquo;', '1 Comment &raquo;', '% Comments &raquo;'); ?></div>

<?php endwhile; ?>

<div class="entries">

<div class="left"><?php next_posts_link('&laquo; Previous Entries') ?></div>
<div class="right"><?php previous_posts_link('Next Entries &raquo;') ?></div>

</div>

<?php else : ?>

<h3>Not Found</h3>

Sorry, but you are looking for something that isn't here. Please, go <a href="javascript:history.go(-1)">back</a> or try another search.

<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>