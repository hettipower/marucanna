<?php 
/* Template Name: Feedback Survey Page */

get_header(); 

$patient = isset($_GET['patient']) ? $_GET['patient'] : false;
if( !$patient ) {
    wp_redirect(home_url());
    exit;
}
?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
        <?php if ( get_field( 'page_title' ) ) { ?>
            <h1><?php the_field( 'page_title' ); ?></h1>
        <?php } else { ?>
            <h1><?php the_title(); ?></h1>
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

        <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content(); 
            endwhile; endif; 
        ?>

    </div>
</section>


<?php get_footer(); ?>