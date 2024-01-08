<?php get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
        <h1>Meet the team</h1>
    </div>
</section>

<section class="section breadcrumb_wrap">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section doctor_details">
    <div class="container">
        <div class="row">
            <?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'full');
?>
         <?php if ( has_post_thumbnail() ) {?>
            <div class="col-12 col-md-6 image">
                <div class="img_wrap">
                    <img src="<?php echo $thumb_url[0]; ?>"/>
                </div>
            </div>
            	<?php } ?>
            <div class="col-12 col-md-6 content_wrap">
                <h2 class="dr_name"><?php the_title(); ?></h2>
                <div class="position"><?php the_field( 'specialization' ); ?></div>
               <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
<?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>