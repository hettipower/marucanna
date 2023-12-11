<?php
register_sidebar(array('name'=>'Sidebar Widgets',
'before_widget' => '<div class="">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',

));


/*
Usage:
 	  
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar('Sidebar Widgets') ) : ?>
<?php endif; ?> 

 */