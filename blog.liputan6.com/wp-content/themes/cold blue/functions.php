<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div class="nav">',
        'after_widget' => '</div>',
    ));
?>