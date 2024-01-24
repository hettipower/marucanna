<?php 
/* Template Name: Pricing Page */

get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
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

<section class="section text-block-section">
    <div class="container">
        <div class="description">
            <?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>  
<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>
           
        </div>
    </div>
</section>

<section class="section mc-image-text-block">
    <div class="container">
        <div class="row">
		
            <div class="col-md-6 col-sm-12 image_wrapper">
                <?php if ( get_field( 'pr_sec1_main_image' ) ) { ?>
                	<img src="<?php the_field( 'pr_sec1_main_image' ); ?>"/>
                <?php } else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/pricing.webp"/>
				 <?php }  ?>
            </div>
			
            <div class="col-md-6 col-sm-12 content_wrapper">
                <h2><?php echo do_shortcode(get_field('pr_sec1_title')); ?></h2>
                
                <div class="numbered_list">
                    <?php

// check if the repeater field has rows of data
if( have_rows('pr_sec1_list_rep') ):
$i=0;
 	// loop through the rows of data
    while ( have_rows('pr_sec1_list_rep') ) : the_row(); $i++;
?>
                    <div class="item">
                        <span class="number"><?php echo $i; ?></span>
                        <div class="text"><?php the_sub_field( 'title' ); ?></div>
                    </div>
 <?php

    endwhile;

else :

    // no rows found

endif;

?>                   
                    

                </div>

                <div class="btn-wrapper">
                    <a href="<?php the_field( 'pr_sec1_button_link' ); ?>" class="btn style_4"><?php the_field( 'pr_sec1_button_text' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section pricing_section_wrap">
    <div class="container">
        <div class="title_wrap text-center">
            <h3><?php echo do_shortcode(get_field('pr_sec2_title')); ?></h3>
            <div class="description">
                <?php the_field( 'pr_sec2_content' ); ?>

            </div>
        </div>

        <div class="row g-3 pricing">

            <?php if ( have_rows( 'pricing_table_fc' ) ): ?>
	<?php while ( have_rows( 'pricing_table_fc' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'single_table_lo' ) : ?>
            
            <div class=" col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title"><?php the_sub_field( 'table_heading' ); ?></h4>
                        <h5 class="subtitle"><?php the_sub_field( 'heading_2' ); ?></h5>
                        <div class="price_wrap">
                            <a href="<?php the_sub_field( 'booking_button_link' ); ?>" class="btn style_5"><?php the_sub_field( 'booking_button_text' ); ?></a>
                            <div class="price"><?php the_sub_field( 'price' ); ?></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php if ( have_rows( 'features_rep' ) ) : ?>
				<?php while ( have_rows( 'features_rep' ) ) : the_row(); ?>
                            <li class="list-group-item"><?php the_sub_field( 'feature' ); ?></li>
                            	<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
                            
                        </ul>
                        <div class="btn_wrap text-center mt-4">
                            <a href="<?php the_sub_field( 'contact_button_link' ); ?>" class="btn style_2"><?php the_sub_field( 'contact_button_text' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php

  endif;

    endwhile;

else :

    // no layouts found

endif;

?>
            
           

        </div>

    </div>
</section>

<section class="section timeline_wrap">
    <div class="container">
        <div class="title_wrap text-center">
            <h3><?php echo do_shortcode(get_field('pr_sec3_title')); ?></h3>
        </div>
        <div class="timeline">
            <?php if ( get_field( 'pr_sec3_main_image' ) ) { ?>
            <img src="<?php the_field( 'pr_sec3_main_image' ); ?>" />
            <?php } else { ?>
            <img src="<?php bloginfo( 'template_url' ); ?>/img/pricing-timeline.webp" class="img-fluid"/>
             <?php }  ?>
        </div>
        <div class="btn_wrap mt-3 text-center">
            <a href="<?php the_field( 'pr_sec3_button_link' ); ?>" class="btn style_4"><?php the_field( 'pr_sec3_button_text' ); ?></a>
        </div>
    </div>
</section>

<section class="section text-block-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h3><?php echo do_shortcode(get_field('pr_sec3_title_2')); ?></h3>
            <div class="description">
                <?php the_field( 'pr_sec3_content' ); ?>

                
            </div>
        </div>
    </div>
</section>

<section class="section faq-section">
    <div class="container">
        <div class="title_wrap text-center">
            <h2><?php the_field( 'faq_title' ); ?></h2>
        </div>

        <div class="faqs row g-3">
			<?php if ( have_rows( 'faq_rep' ) ) : ?>
	<?php while ( have_rows( 'faq_rep' ) ) : the_row(); ?>
            <div class="faq-item">
                <h3><?php the_sub_field( 'question' ); ?></h3>
                <div class="content"><?php the_sub_field( 'answer' ); ?> </div>
            </div>
<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
          

        
        </div>

    </div>
</section>

<?php get_footer(); ?>