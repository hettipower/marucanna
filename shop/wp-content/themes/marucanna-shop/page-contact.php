<?php 
/* Template Name: Contact Page */

get_header(); ?>

<section class="section main-title-section">
    <div class="container">
        <h1><?php the_title(); ?></h1>
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
            <div class="col-md-6 col-12 form_wrap">
                <?php echo do_shortcode( '[gravityform id="1" title="false"]' ); ?>
            </div>
            <div class="col-md-6 col-12 image_wrap">
                <?php 
                    $contact_image = get_field( 'contact_image' );
                    if ( $contact_image ) { 
                ?>
                    <img src="<?php echo $contact_image['url']; ?>" alt="<?php echo $contact_image['alt']; ?>" />
                <?php } ?>
            </div>
            <div class="col-12 mt-3 map_wrap">
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
        </div>
    </div>
</section>

<?php get_footer(); ?>