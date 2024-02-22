<?php get_header(); ?>

<section class="section mc-title-section style_1" style=" <?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
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

<section class="section single-content-wrap">
    <div class="container">

        <div class="single_content clearfix">
            <?php if( get_field('show_sidebar') == 'Yes' ): ?>
            
            <div id="single_sidebar" class="col-md-5 col-sm-12 float-md-end sidebar_wrap">
			    <?php 
                    $sidebar_image = get_field( 'sidebar_image' );
                    if ( $sidebar_image ) { 
                ?>
                    <div class="img_wrap">
                    <?php echo wp_get_attachment_image( $sidebar_image, 'siderbar-thumb' ); ?>
                    </div>
				<?php } ?>
				<?php if ( have_rows( 'sidebar_content_box_rep' ) ) : while ( have_rows( 'sidebar_content_box_rep' ) ) : the_row(); ?>
                    <div class="box_content text-center">
                        <h3><?php the_sub_field( 'title' ); ?></h3>
                        <div class="description">
                            <?php the_sub_field( 'content' ); ?>
                        </div>
                        <?php if ( get_sub_field( 'button_text') ) : ?>
                            <div class="btn_wrap">
                                <a href="<?php the_sub_field( 'button_link' ); ?>" class="btn style_1"><?php the_sub_field( 'button_text' ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
				<?php endwhile; endif; ?>
            </div>
<?php endif; ?>
            
            <?php 
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content(); 
                endwhile; endif; 
            ?>

          

        </div>

       

    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>