<?php 
/* Template Name: Feedback Page */

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

<section class="section breadcrumb_wrap bg_gray">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section feedback_wrapper bg_gray">
    <div class="container">
        
        <div class="row">
				<?php 
	$args = array( 'post_type' => 'marucanna-reviews', 'posts_per_page' => '-1','meta_key' => 'meta-checkbox','meta_value' => ' ');
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
?>
            <div class="col-md-6 col-12 mb-3">
                <div class="feedback-inner">
					<?php if ( get_field( 'before_marucanna') ) { ?>
                    <div class="feedback-quote before-feedback">
                        <h4>Before Marucanna</h4>
                        <div class="quote">
							<?php the_field( 'before_marucanna' ); ?>
                           
                        </div>
                    </div>
					<?php } ?>
					<?php if ( get_field( 'after_marucanna') ) { ?>
                    <div class="feedback-quote after-feedback">
                        <h4>After Marucanna</h4>
                        <div class="quote">
							<?php the_field( 'after_marucanna' ); ?>
                         
                        </div>
                    </div>
					<?php } ?>
                    <div class="feedback-item">
                        <h3><?php the_title(); ?></h3>
						<?php the_field( 'patient_profile' ); ?>

                        
                    </div>
                </div>
            </div>
<?php
endwhile;
wp_reset_query();

?>

			
            
			
        </div>

    </div>
</section>

<section class="section eligibility_wrap partnership_wrap">
    <div class="container">

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3><?php the_field( 'pt_form_box_title' ); ?></h3>
                    <?php the_field( 'pt_form_box_content' ); ?>
					
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper"><?php echo do_shortcode('[gravityform id="3" title="false"]'); ?></div>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>