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
				<?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
<div class="blog_item mb-5">
	 <a href="<?php the_permalink(); ?>">
    <div class="blog-img">
        <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo $thumb_url[0]; ?>" class="rounded img-fluid" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>">
        <?php endif; ?>
    </div>
		 </a>
    <div class="blog_content">
        <div class="date"><?php echo get_the_date('Y'); ?> <?php echo get_the_date('F'); ?> <?php echo get_the_date('j'); ?></div>
       <a href="<?php the_permalink(); ?>"> <h3><?php the_title(); ?></h3> </a>
        <?php my_excerpt(17); ?>
        <div class="btn_wrap">
            <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
        </div>
    </div>
</div>
			
				
                    <?php //get_template_part( 'template-part/blog', 'item' ); ?>
		        <?php  endwhile;?>
				<?php else: ?>
				 <?php echo '<div class="blog_content"><h2 class="title">No posts found.</h2></div>';?>
				 <?php  endif; ?>

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