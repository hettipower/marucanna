<?php get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
	<?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
        <h1>Search</h1>
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
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                    <?php get_template_part( 'template-part/blog', 'item' ); ?>
		        <?php endwhile; endif; ?>

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