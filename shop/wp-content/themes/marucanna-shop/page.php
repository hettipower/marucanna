<?php get_header(); ?>

<?php if( !is_woocommerce_page() ): ?>
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
<?php endif; ?>

<section class="section woo-page-wrap">
    <div class="container">
        <?php 
            while ( have_posts() ) : the_post();
                the_content();
            endwhile; wp_reset_query();
        ?>
    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>