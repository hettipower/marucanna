<?php 
/* Template Name: FAQ */
get_header();
 ?>

<section class="section mc-title-section style_1" style=" <?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
       <?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
		<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
        <h1><?php the_title(); ?></h1>
		<?php endwhile; ?>
<?php endif; ?>
		<?php }  ?>
    </div>
</section>

<section class="section breadcrumb_wrap">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
           <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section single-content-wrap">
    <div class="container">

        <div class="single_content clearfix">
           
            
            <div id="single_sidebar" class="col-md-5 col-sm-12 float-md-end sidebar_wrap">
	
				
                    <div class="box_content">
                        <h3 class="text-center"><?php the_field( 'toc_title' ); ?></h3>
						<?php

// check if the repeater field has rows of data
if( have_rows('faq_rep') ):
$i=0;
 	// loop through the rows of data
    while ( have_rows('faq_rep') ) : the_row(); $i++;
?>
                        <div class="description faq-link">
                            <?php echo $i; ?>. <a href="#faq<?php echo $i; ?>"><?php the_sub_field( 'question' ); ?></a>
                        </div>
                       <?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>   
                    </div>
				
            </div>

    						<?php

// check if the repeater field has rows of data
if( have_rows('faq_rep') ):
$i=0;
 	// loop through the rows of data
    while ( have_rows('faq_rep') ) : the_row(); $i++;
?>
 <span id="faq<?php echo $i; ?>"></span> 
<br/> 
<h3><?php the_sub_field( 'question' ); ?></h3>
   <?php the_sub_field( 'answer' ); ?>
<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>   

        </div>

       

    </div>
</section>



<?php get_footer(); ?>