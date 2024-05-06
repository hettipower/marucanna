<?php get_header(); ?><section class="section main-title-section">
    <div class="container">
        <h1>Category - <?php single_cat_title(); ?></h1>
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

                <?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>  
                    <?php get_template_part( 'template-part/blog', 'item' ); ?>
	            <?php endwhile; ?><?php endif; ?><?php wp_reset_query(); ?>

                <div class="pagination_wrap">
                    <nav>
                        <?php kriesi_pagination(); ?>
                    </nav>
                </div>
                
            </div>
            
            <?php get_template_part( 'template-part/blog', 'sidebar' ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>