<?php get_header(); ?>

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