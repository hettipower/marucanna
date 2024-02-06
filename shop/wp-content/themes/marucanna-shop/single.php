<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
	<?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
        <h1>Blog</h1>
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

<?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
<section class="section blog_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 order-md-2 blog_content_wrap">
                <div class="blog-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php echo $thumb_url[0]; ?>" class="rounded img-fluid" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </div>
                <div class="blog_content">
                    <div class="date"><?php echo get_the_date('Y'); ?> <?php echo get_the_date('F'); ?> <?php echo get_the_date('j'); ?></div>
                    <h2 class="title"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
            
            <?php get_template_part( 'template-part/blog', 'sidebar' ); ?>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>