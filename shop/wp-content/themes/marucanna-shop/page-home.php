<?php 
/* Template Name: Home Page */

get_header(); ?>

<section class="section main_banner">
    <?php 
        $main_banners = get_field( 'main_banners' );
        if ( $main_banners ) { 
    ?>
        <img src="<?php echo $main_banners['url']; ?>" alt="<?php echo $main_banners['alt']; ?>" />
    <?php } ?>
</section>

<section class="section featured_products">
    <div class="container">
        <div class="title_wrap">
            <h2>FEATURED PRODUCTS</h2>
        </div>
        <div class="grid" style="--bs-gap: 1rem 0.5rem;">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => 'featured',
                            'value' => true,
                            'compare' => '=',
                        )
                    )
                );
                $items = new WP_Query($args);
                while ( $items->have_posts() ) : $items->the_post();
                    wc_get_template_part( 'content', 'product' );
            ?>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>