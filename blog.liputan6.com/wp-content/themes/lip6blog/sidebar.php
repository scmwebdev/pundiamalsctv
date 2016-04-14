<!-- begin sidebar -->

	<ul>

		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
     
        

				<?php get_links_list(); ?>


        
		<?php endif; ?>

	</ul>				
<!-- end sidebar -->