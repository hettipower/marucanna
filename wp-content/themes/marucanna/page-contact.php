<?php 
/* Template Name: Contact Page */

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

<section class="section contact_wrap">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 into_text">
                <?php the_field( 'intro_text' ); ?>
            </div>
            <div class="col-md-6 col-12 form_wrap">
                <?php echo do_shortcode( '[gravityform id="12" title="false"]' ); ?>
            </div>
            <div class="col-md-6 col-12 map_wrap">
                <?php 
                    $google_map = get_field( 'google_map' ); 
                    if( $google_map ): 
                ?>
                    <div class="acf-map" data-zoom="16">
                        <div class="marker" data-lat="<?php echo esc_attr($google_map['lat']); ?>" data-lng="<?php echo esc_attr($google_map['lng']); ?>">
                            <p><?php echo esc_html( $google_map['address'] ); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 mt-5 contact_details_wrap">
                <div class="row">
                    <div class="col-md-6 col-12 contact_details">
                        <div class="inner">
                            <?php the_field( 'contact_details' ); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 contact_details">
                        <div class="inner">
                            <?php the_field( 'opening_times' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>