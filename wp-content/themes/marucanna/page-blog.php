<?php 
/* Template Name: Blog Page */

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

<section class="section blog_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 order-md-2 blog_listing">

                <?php
                    $the_query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => -1
                    ));
                    if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                ?>
                    <?php get_template_part( 'template-part/blog', 'item' ); ?>
	            <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            
            <?php get_template_part( 'template-part/blog', 'sidebar' ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>