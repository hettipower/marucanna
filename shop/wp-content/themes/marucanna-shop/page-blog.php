<?php 
/* Template Name: Blog Page */

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

<section class="section blog_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 order-md-2 blog_listing">

                <?php
                    $blog_query = new WP_Query(array(
                        'post_type' => 'post',
                        'paged' => $paged
                    ));
                    if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
                ?>
                    <?php get_template_part( 'template-part/blog', 'item' ); ?>
	            <?php endwhile; wp_reset_postdata(); endif; ?>

                <div class="pagination_wrap">
                    <nav>
                        <?php kriesi_pagination($blog_query->max_num_pages); ?>
                    </nav>
                </div>
                
            </div>
            
            <?php get_template_part( 'template-part/blog', 'sidebar' ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>